<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\App;

class AppController extends Controller
{
    // 应用列表
    public function index()
    {
        $apps = App::paginate(10);
        return view('app.index', compact('apps'));
    }

    // 创建应用
    public function create()
    {
        return view('app.create');
    }

    // 保存应用
    public function store()
    {
        $this->validate(request(),[
            'name' => 'required|string|min:2|max:20|unique:apps',
            'info' => 'required|min:2|max:191',
            'url' => 'required|string|min:3|max:191',
        ]);

        $newApp = [
            'name' => request('name'),
            'info' => request('info'),
            'url' => request('url'),
        ];
        
        if ( request()->hasFile('logo') )
        {
            $path = request()->file('logo')->store(date('Ymd'), 'uploads');
            $newApp['logo'] = asset('uploads/'.$path);
        } else {
            $newApp['logo'] = 'https://ww3.sinaimg.cn/thumb180/0073ob6Pgy1foxl9fg5odg305s06ix4j.gif';
        }

        App::create($newApp);
        return redirect(route('apps.index'));
    }

    // 编辑应用
    public function edit(App $app)
    {
        return view('app.edit', compact('app'));
    }

    // 更新评论
    public function update(App $app)
    {
        $this->validate(request(), [
            'name' => 'required|string|min:2|max:20',
            'info' => 'required|min:2|max:191',
            'url' => 'required|string|min:3|max:191',
        ]);
        $app->name = request('name');
        $app->info = request('info');
        
        if ( request()->hasFile('logo') )
        {
            $path = request()->file('logo')->store(date('Ymd'), 'uploads');
            $app->logo = asset('uploads/'.$path);
        }

        $app->url = request('url');
        $app->save();
        return redirect(route('apps.index'));
    }

    public function destroy(App $app)
    {
        $app->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }
}
