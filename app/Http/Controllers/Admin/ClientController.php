<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\App;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // 用户列表
    public function index()
    {
        $clients = Client::orderByDesc('id')->paginate(10);
        return view('client.index', compact('clients'));
    }

    // 创建用户
    public function create()
    {
        return view('client.create');
    }

    // 保存用户
    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|string|min:3|max:20|unique:clients',
            'email' => 'required|email|max:50',
            'realname' => 'max:10',
            'password' => 'required|string|min:8|max:20',
            'check_ip' => 'required|integer',
            'ip' => 'required|string|max:100',
            'status' => 'required|integer',
        ]);

        $newClient = [
            'create_user' => Auth::id(),
            'name' => request('name'),
            'realname' => request('realname'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'check_ip' => request('check_ip'),
            'ip' => request('ip'),
            'status' => request('status'),
        ];
        Client::create($newClient);
        return redirect(route('clients.index'));
    }

    // 编辑用户
    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    // 更新用户
    public function update(Client $client)
    {
        $this->validate(request(), [
            'email' => 'required|email|max:50',
            'realname' => 'max:10',
            'check_ip' => 'required|integer',
            'ip'  => 'required|string|max:100',
            'status' => 'required|integer',
        ]);
        $client->email = request('email');
        $client->realname = request('realname');
        $client->check_ip = request('check_ip');
        $client->status = request('status');
        $client->ip = request('ip');
        if ( request('password') ) {
            $this->validate(request(), [
                'password' => 'min:8|max:20'
            ]);
            $client->password = bcrypt(request('password'));
        }
        $client->save();
        return redirect(route('clients.index'));
    }

    // 应用列表
    public function app(Client $client)
    {
        $apps = App::all();
        $myApps = $client->apps;
        return view('client.app', compact('client','apps','myApps'));
    }

    public function storeApp(Client $client)
    {
        $this->validate(request(),[
            'apps' =>'array'
        ]);
        $apps = App::findMany(request('apps'));
        $myApps = $client->apps;
        
        //要增加的应用
        $addApps = $apps->diff($myApps);
        
        foreach($addApps as $app) {
            $client->assignApp($app);
        }

        //要删除的应用
        $deleteApps = $myApps->diff($apps);
        foreach($deleteApps as $app) {
            $client->deleteApp($app);
        }
        return back();
    }

    // 删除用户
    public function destroy(Client $client)
    {
        $apps = $client->apps;
        foreach($apps as $app){
            $client->deleteApp($app);
        }
        $client->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }

}
