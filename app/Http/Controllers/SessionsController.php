<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SessionsController extends Controller
{
   public function __construct(){
      $this->middleware('guest',[
         'only'=>['create']
      ]);
   }
   public function create(){
   	return view('sessions.create');
   }
   public function store(Request $request){
   		$v_res=$this->validate($request,[
   			'email'=>'required|email|max:255',
   			'password'=>'required',
   		]);
   		if(Auth::attempt($v_res,$request->has('remember'))){
   			//登陆成功的操作
   			session()->flash('success',"欢迎回来!");
            $fallback = route('users.show',Auth::user());
            return redirect()->intended($fallback);
   			
   		}else{
   			session()->flash('danger','抱歉，邮箱或密码不匹配');
   			return redirect()->back()->withInput();
   			//登陆失败的操作	
   		}
   		return;
   }
   public function destroy(){
   		Auth::logout();
   		session()->flash("success","您已成功退出！");
   		return redirect("login");
   }
}
