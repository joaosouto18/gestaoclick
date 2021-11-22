<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\Users;
use App\Models\Products;

class DashboardController extends Controller
{
    public function index(){

        

        // if(!Auth::user()){
        //     return redirect('/logout');
        // }
        
        $user = Session::get('user');
        $qtdUsers =  Users::all()->count();
        $qtdProducts =  Products::all()->count();
        
        return view('dashboard')->with(compact('user', 'qtdUsers', 'qtdProducts'));
    }
}
