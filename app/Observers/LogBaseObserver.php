<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class LogBaseObserver
{
    protected $log = [];

    public function __construct()
    {
        $this->log['user_name'] = Auth::user()->name ?: 'cli';
        $this->log['user_id'] = Auth::id() ?: 'cli';
        $this->log['url'] = request()->fullUrl();
        $this->log['method'] = request()->method();
    }
}
