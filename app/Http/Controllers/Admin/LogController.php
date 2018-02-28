<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OperationLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = OperationLog::orderByDesc('id')->paginate(20);
        return view('log.index', compact('logs'));
    }

    public function destroy(OperationLog $log)
    {
        $log->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }
}
