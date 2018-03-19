<?php

namespace App\Models;

use App\Models\Model;

class EventLog extends Model
{
    protected $table = 'event_logs';
    protected $guarded = ['id'];
    protected $fillable = ['user_name', 'user_id', 'url', 'event', 'method', 'table', 'description'];
}
