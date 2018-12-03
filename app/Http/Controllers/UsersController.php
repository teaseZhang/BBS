<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    public function __construct()
    {
        //除了注册，未登录用户不能访问其他的方法
        $this->middleware('auth',[
            'except'=>['show','create','store','index']
            
        ]);
        $this->middleware('guest',[
            'only' => ['create']
            
        ]);
    }
    public function index(){
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

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
    public function edit(User $user){
        //调用用户授权方法
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
        
    }
    public function update(User $user,Request $request){
        $this->validate($request,[
            'name' => 'required|max:50',
            'password'=> 'required|confirmed|min:6'
            ]);
        $data=[];
        $data['name']=$request->name;
        if ($request->password){
            $data['password']=bcrypt($request->password);
            
        }
        $user->update($data);
        session()->flush('success','个人资料更新成功!');
        return redirect()->route('users.show',$user->id);
    }
    
    public function destroy(User $user){
        $user->delete();
        session()->flash('success','成功删除用户');
        return back();
    }
    
}