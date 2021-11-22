<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Products;
use Session;
use Hash;
use Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = Users::all();

        // if(!Auth::user()){
        //     return redirect('/logout');
        // }
    

        $user = Session::get('user');
        $qtdUsers =  Users::all()->count();
        $qtdProducts =  Products::all()->count();
        $products = Products::all();

        return view('layout.list-users')->with(compact('user', 'users','qtdUsers', 'qtdProducts', 'products'));


    }

    public function edit($id)
    {
        $user = Users::find($id);
        return view('layout.user-edit', compact('user'));
    }

    public function delete($id){

        $user = Users::find($id);

        if(isset($user)){
            $user->delete();
            Session::flash('message', 'Usuário deletado com sucesso!');
            Session::flash('alert-class', 'alert-danger');
            return redirect('list-users');
        }

    }

    public function confirmUser(Request $request)
    {

       

        $user = Users::where('email', request('email'))->count();

      

        if ($user == 1) {
            Session::flash('message', 'Login já existe!');
            Session::flash('alert-class', 'alert-warning');
            return redirect('user-add');
        }

        $message = [
            'required' => 'Campo Obrigatório',
            'same' => 'As senhas precisam serem iguais!',
            'email' => 'Digite um e-mail válido!',
            'password.min' => 'A senha deve conter no mínimo 6 dígitos',
        ];
        $request->validate([
            'name' => 'required',
            'email' => 'email:rfc,dns|unique:users,email|required',
            'password' => 'required|min:6|max:30',
            'passwordConfirm' => 'required|same:password'
        ], $message);

        $user = new Users;

        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make((request('password')));
        $user->remember_token = Str::random(10);
        $user->save();

        Session::flash('message', 'Usuário adicionado com sucesso!');
        Session::flash('alert-class', 'alert-success');

        return redirect('list-users');
    }

    public function alter(Request $request)
    {

        $user = Users::find(request('id'));

        
        $message = [
            'required' => 'Campo Obrigatório',
            'same' => 'As senhas precisam serem iguais!',
            'newpassword.min' => 'A senha deve conter no mínimo 6 dígitos',
        ];
        $request->validate([
            'name' => 'required',
            'newpassword' => 'required|min:6|max:30|same:passwordConfirm',
            'passwordConfirm' => 'required|same:newpassword'
        ], $message);


        if (!empty($user)) {
            $user->name = request('name');
            $user->password = \Hash::make((request('newpassword')));
            $user->save();

            Session::flash('message', 'Usuário atualizado com sucesso!');
            Session::flash('alert-class', 'alert-success');

            return redirect('list-users');
        }
    }

}
