<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LottoData;
use App\Models\Lotto;

class DataController extends Controller
{
    // 删除项目
    public function destroy(Lotto $lotto)
    {
        return 'no';
    }
}
