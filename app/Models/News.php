<?php

namespace App\Models;

use App\Models\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = ['id'];
    protected $hidden = ['create_user', 'update_user', 'updated_at'];
    protected $fillable = ['title', 'keywords', 'description', 'content', 'channel_id', 'hits', 'hot', 'status', 'update_user', 'create_user'];

    public function channel()
    {
        return $this->belongsTo('App\Models\Channel', 'channel_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'news_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(Client::class, 'user_news', 'news_id', 'user_id')->withPivot(['news_id', 'user_id']);        
    }

    // 增加点击记录
    public function assignUser($user)
    {
        $this->users()->save($user);
    }
    
}
