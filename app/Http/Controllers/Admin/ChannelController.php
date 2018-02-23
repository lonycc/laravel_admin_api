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
        $channels = Channel::paginate(10);
        return view('channel.index', compact('channels'));
    }

    // 创建栏目
    public function create()
    {
        return view('channel.create');
    }

    // 删除栏目
    public function destroy(Channel $channel)
    {
        $channel->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }

}
