<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    // 栏目列表
    public function index()
    {
        $channels = Channel::paginate(20);
        return view('channel.index', compact('channels'));
    }

    // 创建栏目
    public function create()
    {
        $channels = Channel::all();
        return view('channel.create', compact('channels'));
    }

    // 保存栏目
    public function store()
    {
        $this->validate(request(),[
            'name'  => 'required|string|max:10',
            'pid' => 'required|integer',
        ]);

        $channel = [
            'create_user' => Auth::id(),
            'update_user' => Auth::id(),
            'name' => request('name'),
            'pid' => request('pid'),
        ];
        Channel::create($channel);
        return redirect('/channel');
    }

    // 编辑栏目
    public function edit(Channel $channel)
    {
        $channels = Channel::all();
        return view('channel.edit', compact('channels', 'channel'));
    }

    // 更新栏目
    public function update(Channel $channel)
    {
        $this->validate(request(), [
            'name'  => 'required|string|max:10',
            'pid' => 'required|integer',
        ]);
        $channel->update_user = Auth::id();
        $channel->pid = request('pid');
        $channel->name = request('name');
        $channel->save();
        return redirect('/channel');
    }

    // 删除栏目
    public function destroy(Channel $channel)
    {
        $news = $channel->news;
        if ( $news != null )
        {
            return [
                'error' => '1',
                'msg' => '该栏目下有稿件, 不能删除'
            ];
        }
        $channel->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }

    // 指定栏目的稿件列表
    public function news(Channel $channel)
    {
        $news = $channel->news()->paginate(20);
        return view('channel.list', compact('news', 'channel'));
    }

}
