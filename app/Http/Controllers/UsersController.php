<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View用户显示页面
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 用户注册页面
     */
    public function store(Request $request){
        
        //表单验证
        $this->validate($request,[
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|confirmed|min:6'
            ]);
        
        //执行数据添加操作
        $user=User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password), 
        ]);
        Auth::login($user);
        session()->flash('success','teaseZhang way of learning ');
        return redirect()->route('users.show',[$user]);
        
    }
    
}