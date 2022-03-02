<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\User;
use Redirect;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderByRaw('name ASC', 'lastname ASC')->paginate(1000000);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc|min:8|max:50|unique:users,email,NULL,id,deleted_at,NULL',
            'document' => 'required|string|regex:/[0-9]{8}/',
            'telephone' => 'nullable|string|regex:/9[0-9]{8}/',
            'company' => 'nullable|string|max:50',
        ], $this->validationErrorMessages());
        User::create($request->all());
        return Redirect::route('users.index')->with('success','Usuario creado satisfactoriamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc|min:8|max:50|unique:users,email,'.$id.',id,deleted_at,NULL',
            'document' => 'required|string|regex:/[0-9]{8}/',
            'telephone' => 'nullable|string|regex:/9[0-9]{8}/',
            'company' => 'nullable|string|max:50',
        ], $this->validationErrorMessages());
        User::find($id)->update($request->all());
        return Redirect::route('users.index')->with('success','Usuario actualizado satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return Redirect::route('users.index')->with('success','Usuario eliminado satisfactoriamente.');
    }
    
    public function activate($code)
    {
        $users = User::where('confirmation_code',$code);
        $exist = $users->count();
        $user = $users->first();
        if ($exist == 1 and $user->email_verified_at == NULL) {
            $id = $user->id;
            $email = $user->email;
            return view('auth.date_complete',compact('id', 'email'));
        }
        else
            return Redirect::route('login');
    }

    public function complete(UserRequest $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|max:50|different:email|regex:/^(?=\w*\d)(?=\w*[A-Za-z])\S{8,50}$/',
            'password_confirmation' => 'same:password'
        ], $this->validationErrorMessages());
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        return Redirect::route('login')->with('status','Su cuenta fue activada con éxito.');
    }

    public function updateAccount(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[\pL\s\-]+$/u',
            'document' => 'required|string|regex:/[0-9]{8}/',
            'telephone' => 'nullable|string|regex:/9[0-9]{8}/',
            'company' => 'nullable|string|max:50',
        ], $this->validationErrorMessages());
        Auth::user()->update($request->all());
        return Redirect::back()->with('success','Sus datos se actualizaron satisfactoriamente.');
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    public static function validationErrorMessages()
    {
        return [
            'name.required' => 'Debe ingresar obligatoriamente un nombre.',
            'name.regex' => 'El nombre debe incluir únicamente letras y espacios en blanco entre palabras.',
            'name.max' => 'El nombre debe contener como máximo cincuenta (50) caracteres.',
            'lastname.required' => 'Debe ingresar obligatoriamente un apellido.',
            'lastname.regex' => 'El apellido debe incluir únicamente letras y espacios en blanco entre palabras.',
            'lastname.max' => 'El apellido debe contener como máximo cincuenta (50) caracteres.',
            'email.required' => 'Debe ingresar obligatoriamente un correo electrónico.',
            'email.unique' => 'El correo electrónico ingresado ya existe en el sistema.',
            'email.email' => 'El correo electrónico ingresado no tiene un formato válido.',
            'email.min' => 'El correo electrónico debe contener entre ocho (8) y cincuenta (50) caracteres.',
            'email.max' => 'El correo electrónico debe contener entre ocho (8) y cincuenta (50) caracteres.',
            'document.required' => 'Debe ingresar obligatoriamente un documento de identidad.',
            'document.regex' => 'El documento de identidad debe estar compuesto por ocho (8) dígitos.',
            'telephone.regex' => 'El celular debe estar compuesto por un nueve (9) seguido de ocho (8) dígitos.',
            'company.max' => 'La empresa debe contener como máximo cincuenta (50) caracteres.',
            'is_blocked.required' => 'Debe seleccionar obligatoriamente un estado.',
            'password.different' => 'La contraseña no puede ser igual a su correo electrónico.',
            'password.regex' => 'La contraseña debe contener entre ocho (8) y cincuenta (50) caracteres con, al menos, una letra y un dígito.',
            'password_confirmation.same' => 'Las contraseñas ingresadas no coinciden.',
        ];
    }
}