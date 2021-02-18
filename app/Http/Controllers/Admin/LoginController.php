<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function  getLogin(){

        return view('admin.auth.login');
    }


    public function save(){

        $admin = new Admin();
        $admin -> name ="Abdo Ali";
        $admin -> email ="abdoalielbaz@gmail.com";
        $admin -> password = bcrypt("Abdo Ali");
        $admin -> save();

    }

    public function login(LoginRequest $request){

        // dd(auth()->check());

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
           // notify()->success('تم الدخول بنجاح  ');
        //    dd($request);
            return redirect()->route('admin.dashboard');
            }
       // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->withErrors(['هناك خطا بالبيانات']);
    }
}






