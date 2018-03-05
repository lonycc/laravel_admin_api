<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Award;
use App\Models\Lottery;
//use Illuminate\Support\Facades\Session;  

class AwardController extends Controller
{
    // 创建抽奖项目
    public function create()
    {
        $lotterys = Lottery::all();
        return view('award.create', compact('lotterys'));
    }

    // 保存抽奖项目
    public function store()
    {
        $this->validate(request(), [
            'name'  => 'required|string|min:3|max:50',
            'info'  => 'max:50',
            'score' => 'integer',
            'rank'  => 'integer',
            'lottery_id' => 'integer'
        ], ['lottery_id.integer'=>'项目必选']);
        $name = request('name');
        $info = request('info');
        $score = request('score');
        $rank = request('rank');
        $lottery_id = request('lottery_id');
        
        if ( request()->hasFile('img') )
        {
            $path = request()->file('img')->store(date('Ymd'), 'uploads');
            $img = asset('uploads/'.$path);
        } else {
            $img = 'https://ww3.sinaimg.cn/thumb180/0073ob6Pgy1foxl9fg5odg305s06ix4j.gif';
        }

        Award::create(compact('name', 'info', 'score', 'rank', 'lottery_id', 'img'));
        return redirect(route('lotterys.award', ['lottery'=>$lottery_id]));
    }

    // 编辑奖项
    public function edit(Award $award)
    {
        $lotterys = Lottery::all();
        return view('award.edit', compact('award', 'lotterys'));
    }

    // 更新奖项
    public function update(Award $award)
    {
        $this->validate(request(), [
            'name' => [
                'string',
                'min:3',
                'max:10',
            ],
            'info' => 'max:50',
            'score' => 'integer',
            'rank'  => 'integer',
            'lottery_id' => 'integer'
        ], ['lottery_id.integer'=>'项目必选']);
        $award->name = request('name');
        $award->info = request('info');
        $award->score = request('score');
        $award->rank = request('rank');
        $award->lottery_id = request('lottery_id');

        if ( request()->hasFile('img') )
        {
            $path = request()->file('img')->store(date('Ymd'), 'uploads');
            $award->img = asset('uploads/'.$path);
        }

        $award->save();
        return redirect(route('lotterys.award', ['lottery'=>$award->lottery_id]));
    }

    // 删除奖项
    public function destroy(Award $award)
    {
        $award->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }
}
