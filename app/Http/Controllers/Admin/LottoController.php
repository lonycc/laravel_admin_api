<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LottoData;

class LottoController extends Controller
{
    // 抽奖数据源列表
    public function index()
    {
        $datas = LottoData::paginate(10);
        return view('lottodata.index', compact('datas'));
    }

    // 创建抽奖项目
    public function create()
    {
        return view('lottodata.create');
    }
}
