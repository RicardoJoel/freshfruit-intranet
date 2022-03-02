<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    protected const LONGITUD_CODIGO = 60;
    protected const PERMITTED_CHARS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    protected const EMAIL_ACT_ACCNT = 'Bienvenido a Fresh Fruit® Perú';
    protected const EMAIL_PSW_RESET = 'Notificación de restablecimiento de contraseña';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'document', 'telephone', 'company', 'email', 'is_blocked', 'password'
    ];

    /**
     * Default values for attributes
     * @var array an array with attribute as key and default as value
     */
    protected $attributes = [
        'is_admin' => false, 'is_blocked' => false
    ];

    /**
     * Protected attributes that CANNOT be mass assigned.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_code'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function products()
    {
    	return $this->belongsToMany(Product::class)->wherePivotNull('deleted_at');
    }

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(User $user) {
            $user->generateConfirmationCode();
            return true;
        });
    }

    /**
     * Generates the value for the User::confirmation_code field. Used to 
     * activate the user's account.
     * @return bool 
     */
    protected function generateConfirmationCode()
    {
        $length = strlen(self::PERMITTED_CHARS);
        $rndStr = '';

        for ($i=0; $i<self::LONGITUD_CODIGO; $i++) {
            $rndChr = self::PERMITTED_CHARS[mt_rand(0, $length - 1)];
            $rndStr .= $rndChr;
        }
        $this->attributes['confirmation_code'] = $rndStr;

        return !is_null($this->attributes['confirmation_code']);
    }

    public function sendEmailVerificationNotification()
    {
        $data = ['name' => $this->name, 'code' => $this->confirmation_code];

        Mail::send('emails.verify', $data, function($message) {
            $message->subject(self::EMAIL_ACT_ACCNT);
            $message->to($this->email);
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $data = ['name' => $this->name, 'code' => $token];

        Mail::send('emails.reset', $data, function($message) {
            $message->subject(self::EMAIL_PSW_RESET);
            $message->to($this->email);
        });
    }
}
