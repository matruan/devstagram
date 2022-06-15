<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        
        // dd($request->get('email'));

        // Modifying request to validate username properly
        $request->request->add(['username'=> Str::slug($request->username)]);
        // dd($request);

        $this->validate($request, [
          'name' => 'required|max:50',
          'username' => 'required|unique:users|min:3|max:20',
          'email' => 'required|unique:users|email|max:60',
          'password' => 'required|confirmed|min:6'
        ]);

        // dd('Creando usuario');


        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make( $request->password ) 
        ]);

        // Autenticar
        // auth()->attempt([
        //     'email' => $request->email,
        //    'password' => $request->password
        //]);

        // Otra forma de autenticar
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar
        return redirect()->route('posts.index');

    }
}
