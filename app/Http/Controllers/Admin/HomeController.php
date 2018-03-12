<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    // 编辑密码
    public function edit()
    {
        $user = \Auth::user();
        return view('home.edit', ['user'=>$user]);
    }

    // 更新密码
    public function update()
    {
        $user = \Auth::user();

        $this->validate(request(), [
            'email' => [
                'email',
                'required',
                Rule::unique('users')->ignore($user->id)
            ],
            'opassword' => 'required',
            'password' => 'required|min:8|max:20',
            'repassword' => 'required|min:8|max:20',
        ]);
        $user->email = request('email');
        $res = AdminUser::select('id', $user->id)->select('password')->first();
        if ( ! \Hash::check(request('opassword'), $res->password) )
        {
            return back()->withErrors('原密码验证错误');
        } else if ( request('password') !== request('repassword') ) {
            return back()->withErrors('新密码两次输入不一致');
        }

        $user->password = bcrypt(request('password'));
        $user->save();
        return back()->withErrors('用户更新成功');
    }

}