<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\OperationLog;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login()
    {
        $this->validate(request(), [
            'name' => 'required|string',
            'password' => 'required',
            'verify' => 'required|captcha',
            'is_remember' => 'integer'
        ]);

        $user = request(['name','password']);
        $is_remember = boolval(request('is_remember'));
        if ( Auth::attempt($user, $is_remember) )
        {
            /* 记录登录日志 */
            $log = new OperationLog();
            $log->path = request()->path();
            $log->ip = request()->ip();
            $log->user = request('name');
            $log->input = '[]';
            $log->method = request()->method();
            $log->save();
            /* 记录登录日志 */
            
            return redirect(route('admin.home'));
        } else {
            return Redirect::back()->withErrors('账号密码不匹配');
        }
    }

    public function logout()
    {
        $user = Auth::user();
        Auth::logout();
        
        /* 记录退出日志 */
        $log = new OperationLog();
        $log->path = request()->path();
        $log->ip = request()->ip();
        $log->user = $user->name;
        $log->input = '[]';
        $log->method = request()->method();
        $log->save();
        /* 记录退出日志 */
        return redirect(route('admin.login'));
    }

    public function captcha()
    {
        return captcha();
        //return Captcha::create();
        //return captcha_src();
        //return captcha_img();
    }
}
