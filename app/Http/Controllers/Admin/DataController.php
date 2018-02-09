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
        Excel::create('demo', function ($excel) use ($cellData) {
            $excel->sheet('score', function ($sheet) use ($cellData) {
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

    public function import()
    {
        $file = iconv('UTF-8', 'GBK', '帐号demo') . '.xls';
        Excel::load($file, function($reader) {
            $data = $reader->all();
            dd($data);
        });
    }
}
