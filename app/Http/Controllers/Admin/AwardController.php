<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Award;
use Illuminate\Support\Facades\Session;  

class AwardController extends Controller
{
    // 创建抽奖项目
    public function create()
    {
        return view('award.create');
    }

    // 保存抽奖项目
    public function store()
    {
        $this->validate(request(),[
            'name'  => 'required|string|min:3|max:50|unique:award',
            'info'  => 'max:50',
            'score' => 'integer',
            'rank'  => 'integer'
        ]);

        $name = request('name');
        $info = request('info');
        $score = request('score');
        $rank = request('rank');
        $lottery_id = Session::get('lottery_id');
        Award::create(compact('name', 'info', 'score', 'rank', 'lottery_id'));
        return redirect('/lottery/'.$lottery_id.'/award');
    }

    // 编辑奖项
    public function edit(Award $award)
    {
        return view('award.edit', compact('award'));
    }

    // 更新奖项
    public function update(Award $award)
    {
        $this->validate(request(), [
            'name' => [
                    'string',
                    'min:3',
                    'max:10',
                    Rule::unique('award')->ignore($award->id)
                    ],
            'info' => 'max:50',
            'score' => 'integer',
            'rank'  => 'integer',
        ]);
        $award->name = request('name');
        $award->info = request('info');
        $award->score = request('score');
        $award->rank = request('rank');
        $award->save();
        return redirect('/lottery/'.$award->lottery_id.'/award');
    }

    // 删除奖项
    public function destroy(Award $award)
    {
        $award->delete();
        return [
            'error' => 0,
            'msg'   => ''
        ];
    }
}
