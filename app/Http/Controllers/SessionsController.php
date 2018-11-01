<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View显示登录页面
     */
    public function create(){
        return view('sessions.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse用户登录操作
     */
    public function store(Request $request){
        
        //验证用户输入信息
        $credentials=$this->validate($request,[
           'email'=>'required|email|max:255',
           'password'=>'required' 
        ]);
        
        //判断数据库里面是否存在
        if (Auth::attempt($credentials,$request->has('remenber'))){
            session()->flash('success','欢迎回来');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }
        
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector退出登录操作
     */
    public function destroy(){
        Auth::logout();
        session()->flash('success','您也成功退出');
        return redirect('login');
    }
}
