<?php

namespace App\Models;

use App\Models\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $guarded = ['id'];
    protected $hidden = ['updated_at'];
    protected $fillable = ['content', 'status', 'news_id', 'create_user', 'created_at', 'updated_at'];

    public function news()
    {
        return $this->belongsTo('App\Models\News', 'news_id', 'id');
    }
}
