<?php

namespace App\Models;

use App\Models\Model;

class App extends Model
{
    protected $table = 'apps';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'url', 'info', 'logo'];

    public function users()
    {
        return $this->belongsToMany(Client::class, 'user_app', 'app_id', 'user_id')->withPivot(['app_id', 'user_id']);        
    }

    public function assignUser($user)
    {
        $this->users()->save($user);
    }
}
