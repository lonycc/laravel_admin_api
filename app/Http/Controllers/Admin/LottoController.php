<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lotto;
use App\Models\LottoData;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Storage;
use Excel;

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
        $create_user = Auth::id();
        Lotto::create(compact('name', 'info', 'create_user'));
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
        $lotto->name = request('name');
        $lotto->info = request('info');
        $lotto->create_user = Auth::id();
        $lotto->save();
        return redirect('/lotto');
    }

    // 删除项目
    public function destroy(Lotto $lotto)
    {
        $lotto->datas()->delete();
        $lotto->delete();
        
        return [
            'error' => 0,
            'msg'   => '删除成功'
        ];
    }

    // 关联数据列表
    public function data(Lotto $lotto)
    {
        $datas = $lotto->datas()->paginate(2);
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
        // $request->hasFile('xls'); 也可判断
        if ( $file->isValid() )
        {
            //$path = $file->path(); //临时路径
            //$ext = $file->extension();  //真实扩展名, 就算改了也能识别
            $ext = $file->getClientOriginalExtension();  //根据文件名获得的扩展名, 可能被窜改
            $realPath = $file->getRealPath();  //临时路径
            $originalName = $file->getClientOriginalName();
            //$mimetype = $file->getClientMimeType(); //mimetype, 根据文件名后缀判断, 不准       
            $size = $file->getClientSize(); //单位字节
            $filename = uniqid() . '.' . $ext;  //重命名文件
            //$bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath)); //指定驱动

            if ( $size > 1024 * 1024 * 5 )
            {
                $msg = '文件不能超过5MB';
            } else if ( ! in_array($ext, ['xls', 'xlsx', 'csv', 'txt'], true) ) {
                $msg = '文件类型不是excel';
            } else {
                $msg = '';
            }
            if ( $msg != '' )
            {
                return back()->withErrors($msg)->withInput();
            }
            $start = $request->start; //开始行
            $mainColumn = $request->main;  //抽奖列

            // $file->store('uploads'); 文件保存到storage/app/uploads路径下, 文件名是随机的
            // $file->storeAs('uploads', 'filename', 'public');  文件保存到public/uploads路径下, 文件名为filename
            $path = storage_path('app/') . $file->storeAs('uploads', $filename);
            Excel::load($path, function($reader) {
                // $reader->all();
                // $reader->getSheet(0); //excel第一张sheet
                // $reader->takeRows(5);
                // $reader->skipColumns(1);
                $results = $reader->limitRows(5);
                dd($reader);
                /*
                if ( $results ) {
                    foreach ($results as $key => $value ) {
                        $data = [];
                        $data['main'] = $value[0];
                        $data['other'] = $value[1];
                        $data['lotto_id'] = $lotto->id;
                    }
                }
                */
                
            });
            

        } else {
            return back()->withErrors($msg);
        }
        // return redirect('/lotto')->with('message', '上传成功');
        // return back()->with('errors', '上传成功')->withInput();
    }

}
