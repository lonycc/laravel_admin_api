<?php

namespace App\Models;

use App\Models\Model;

class AdminPermission extends Model
{
    public $timestamps = false;

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'admin_permission_role','permission_id','role_id')->withPivot(['permission_id','role_id']);
    }

    /*
    public function children()
    {
        return $this->hasMany($this,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo($this,'parent_id');
    }
    */

    public function parent()
    {
        return $this->hasOne(get_class($this), $this->getKeyName(), 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id', $this->getKeyName());
    }

}
