<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Products;
use Session;
use Hash;
use Auth;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        $qtdUsers =  Users::all()->count();
        $qtdProducts =  Products::all()->count();

        return view('report')->with(compact('user', 'qtdUsers', 'qtdProducts'));

    }
}
