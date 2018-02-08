<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lottery;
use App\Models\Lotto;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;  

class LotteryController extends Controller
{
    // 抽奖项目列表
    public function index()
    {
        $lotterys = Lottery::paginate(10);
        return view('lottery.index', compact('lotterys'));
    }

    // 创建抽奖项目
    public function create()
    {
        return view('lottery.create');
    }

    // 保存抽奖项目
    public function store()
    {
        $this->validate(request(),[
            'name'  => 'required|string|min:3|max:50|unique:lottery',
            'info'  => 'max:50'
        ]);

        $name = request('name');
        $info = request('info');
        Lottery::create(compact('name','info'));
        return redirect('/lottery');
    }

    // 编辑项目
    public function edit(Lottery $lottery)
    {
        return view('lottery.edit', compact('lottery'));
    }

    // 更新项目
    public function update(Lottery $lottery)
    {
        $this->validate(request(), [
            'name' => [
                                'string',
                                'min:3',
                                'max:50',
                                Rule::unique('lottery')->ignore($lottery->id)
                            ],
            'info' => 'max:50'
        ]);
        $lottery->name  = request('name');
        $lottery->info     = request('info');
        $lottery->save();
        return redirect('/lottery');
    }

    // 数据集列表
    public function lotto(Lottery $lottery)
    {
        $lottos = Lotto::all();
        return view('lottery.lotto', compact('lottery', 'lottos'));
    }

    // 保存项目-数据集关系
    public function storeLotto(Lottery $lottery)
    {
        $this->validate(request(), [
            'lotto' => 'integer'
        ], ['lotto.integer' => '数据集不能空']);
        $lottery->lotto_id = request('lotto');
        $lottery->save();
        return redirect('/lottery');
    }

    // 删除项目
    public function destroy(Lottery $lottery)
    {
        $lottery->delete();
        return [
            'error' => 0,
            'msg'   => ''
        ];
    }

    // 奖项列表
    public function award(Lottery $lottery)
    {
        $awards = $lottery->award;
        Session::put('lottery_id', $lottery->id);
        Session::put('lottery_name', $lottery->name);
        return view('award.index', compact('lottery', 'awards'));
    }

}