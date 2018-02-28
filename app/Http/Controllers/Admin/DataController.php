<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LottoData;
use App\Models\Lotto;
use Excel;

class DataController extends Controller
{
    // 导出excel
    public function export()
    {
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('demo.xls', function ($excel) use ($cellData) {
            $excel->sheet('sheet1', function ($sheet) use ($cellData) {
                $sheet->rows($cellData); //填充整行
                
                /* 填充每个单元格
                $sheet->cell('A1', function($cell) use ($test) {
                    $cell->setValue($test);
                });
                */
            });
            
        })->export('xls');
    }

    // 导入excel
    public function import()
    {
        $file = iconv('UTF-8', 'GBK', 'demo') . '.xls';
        Excel::load($file, function($reader) {
            $data = $reader->all();
            dd($data); // laravel自带的格式化输出方法

            /* 修改每个单元格的内容
            $reader->cell('A1', function($cell) {
                $cell->setValue('test');
            });
            */
        });
    }

    public function destroy(Lotto $lotto)
    {
        $datas = $lotto->datas();
        $datas->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }
}
