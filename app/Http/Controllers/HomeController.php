<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Models\Food;

use App\Models\t_order;


class HomeController extends Controller
{
    public function index(){

        $data = food::all();

        return view("welcome",compact("data"));
    }

    public function redirect(){
        $data = food::all();
        $usertype= Auth::user()->usertype;

        if($usertype=='1')
        {
            $order = t_order::all();
            return view('admin.adminhome',compact('order'));
        }
        else{

            
          return view('home',compact("data"));  
        }
    }
}
