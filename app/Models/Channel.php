<?php

namespace App\Models;

use App\Models\Model;

class Channel extends Model
{
    protected $table = 'channel';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'pid', 'update_user', 'create_user'];

    public function news()
    {
        return $this->hasMany('App\Models\News', 'channel_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(get_class($this), $this->getKeyName(), 'pid');
    }

}
