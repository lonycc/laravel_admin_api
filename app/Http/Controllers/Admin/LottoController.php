<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lotto;
use App\Models\LottoData;
use Illuminate\Validation\Rule;

class LottoController extends Controller
{
    // 抽奖数据集列表
    public function index()
    {
        $lottos = Lotto::paginate(10);
        return view('lotto.index', compact('lottos'));
    }

    // 创建抽奖数据集
    public function create()
    {
        return view('lotto.create');
    }

    // 保存数据集
    public function store()
    {
        $this->validate(request(),[
            'name'  => 'required|string|min:3|max:50|unique:lotto',
            'info'  => 'max:50'
        ]);

        $name = request('name');
        $info = request('info');
        Lotto::create(compact('name', 'info'));
        return redirect('/lotto');
    }

    // 编辑项目
    public function edit(Lotto $lotto)
    {
        return view('lotto.edit', compact('lotto'));
    }

    // 更新项目
    public function update(Lotto $lotto)
    {
        $this->validate(request(), [
            'name' => [
                'string',
                'min:3',
                'max:50',
                Rule::unique('lotto')->ignore($lotto->id)
                ],
            'info' => 'max:50'
        ]);
        $lotto->name  = request('name');
        $lotto->info     = request('info');
        $lotto->save();
        return redirect('/lotto');
    }

    // 删除项目
    public function destroy(Lotto $lotto)
    {
        $lotto->delete();
        // 还要把绑定的数据删掉

        return [
            'error' => 0,
            'msg'   => '删除成功'
        ];
    }

    // 关联数据列表
    public function data(Lotto $lotto)
    {
        $datas = LottoData::where('lotto_id', $lotto->id)->paginate(20);
        return view('lotto.data', compact('lotto', 'datas'));
    }

    // 导入表单
    public function import(Lotto $lotto)
    {
        return view('lotto.import', compact('lotto', 'message'));
    }

    // 导入操作
    public function storeImport(Lotto $lotto, Request $request)
    {
        $file = $request->xls;
        $msg = '未选择文件';
        if ( $request->hasFile('xls') )
        {
            $path = $file->path();
            $ext = $file->extension();
            $size = $file->getClientSize();
            if ( $size > 1024 * 1024 * 5 )
            {
                $msg = '文件不能超过5MB';
            } else if ( ! in_array($ext, ['xls', 'xlsx', 'csv', 'html'], true) ) {
                $msg = '文件类型不是excel';
            } else {
                $msg = '';
            }
            if ( $msg != '' )
            {
                return back()->withErrors($msg);
            }
            return $new_path = $file->store('uploads');
        } else {
            return back()->withErrors($msg);
        }
    }

}
