<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
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
            'name'  => 'required|string|min:3|max:20|unique:clients',
            'email' => 'required|email|max:50',
            'realname' => 'max:10',
            'password' => 'required|string|min:8|max:20',
            'check_ip' => 'required|integer',
            'ip'  => 'required|string|max:100',
        ]);

        $newClient = [
            'create_user' => Auth::id(),
            'name' => request('name'),
            'realname' => request('realname'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'check_ip' => request('check_ip'),
            'ip' => request('ip'),
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
        ]);
        $client->email = request('email');
        $client->realname = request('realname');
        $client->check_ip = request('check_ip');
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

    // 删除用户
    public function destroy(Client $client)
    {
        $client->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }

}
