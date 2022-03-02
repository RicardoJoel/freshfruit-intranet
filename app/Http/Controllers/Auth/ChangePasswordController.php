<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\User;
use Redirect;
use Auth;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        $user = Auth::user();
        $user->password = Hash::make($request['new_password']);
        $user->save();
        return Redirect::back()->with('success','Su contraseña fue actualizada satisfactoriamente.');
    }
    
    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'email' => 'required|email|min:8|max:50',
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|string|min:8|max:50|different:email|regex:/^(?=\w*\d)(?=\w*[A-Za-z])\S{8,50}$/',
            'new_confirm_password' => ['same:new_password'],
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'new_password.different' => 'La nueva contraseña no puede ser igual a su correo electrónico.',
            'new_password.regex' => 'La nueva contraseña debe contener entre 8 y 50 caracteres con, al menos, una letra y un dígito.',
            'new_confirm_password.same' => 'Las contraseñas ingresadas no coinciden.',
        ];
    }
}