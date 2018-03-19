<?php

namespace App\Observers;
use App\Models\AdminUser;
use App\Models\EventLog;

class UserObserver extends LogBaseObserver
{
    public function __construct()
    {
        parent::__construct();
    }

    public function created(AdminUser $user)
    {
        $this->log['event'] = 'create';
        $this->log['description'] = "创建用户[{$user->name}], 用户id为[{$user->id}]";
    }

    public function updated(AdminUser $user)
    {
        $this->log['event'] = 'update';
        $this->log['description'] = "修改用户[{$user->name}], 用户id为[{$user->id}]";
    }

    public function deleted(AdminUser $user)
    {
        $this->log['event'] = 'delete';
        $this->log['description'] = "删除用户[{$user->name}], 用户id为[{$user->id}]";
    }

    public function __desctuct()
    {
        $this->log['table'] = 'users';
        $this->log['description'] = "[{$this->log['user_name']}]" . $this->log['description'];
        EventLog::create($this->log);
    }

}
