<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Users;
use Session;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Hash;

class LoginController extends Controller
{

    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        // if(Auth::user()){
        //     return redirect('logout');
        // }
        return view('login'); 
    }  

    public function checklogin(Request $request){
       
        $email = $request['email'];
        $password = $request['password'];

       

        $message = [
            'required' => 'Campo Obrigatório',
            'email' => 'Digite um e-mail válido!',
            'password.min' => 'A senha deve conter no mínimo 6 dígitos'
        ];
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], $message);


        $user = Users::where('email', $email)
                    ->first(); 
                   
                        if(password_verify($password, $user->password)) {
                            Session::put('user', $user);
                           return redirect('/dashboard');     
                       }
                       else
                       {
                           //senha inválida...
                           return back()->with('failed', 'Usuário ou Senha incorretos');
                       }
                    

        return back()->with('failed', 'Usuário ou Senha incorretos');

    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/');
    }

}
