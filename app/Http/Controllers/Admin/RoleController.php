<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPermission;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index()
    {
        $roles = AdminRole::paginate(10);
        return view('role.index',compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name'          => 'required|string|min:2|unique:admin_roles',
            'description'   => 'required|min:5'
        ]);
        AdminRole::create(request(['name','description']));
        return redirect('/roles');
    }

    public function edit(AdminRole $role)
    {
        return view('role.edit',compact('role'));
    }

    public function update(AdminRole $role)
    {
        $this->validate(request(),[
            'name'          => 'required|string|min:2',
            'description'   => 'required|min:5'
        ]);
        $role->name = request('name');
        $role->description = request('description');
        $role->save();
        return  redirect('/roles');
    }

    public function permission(AdminRole $role)
    {
        $permissions = AdminPermission::where('parent_id',0)->with('children')->get()->toArray();

        foreach($permissions as &$permission){
            if(empty($permission['children'])){
                continue;
            }
            foreach($permission['children'] as $key =>  $children){
                $sub_children = AdminPermission::where('parent_id',$children['id'])->get()->toArray();
                array_unshift($sub_children,$children);
                $permission['children'][$key] = $sub_children;
            }
        }

        $myPermissions = $role->permissions->toArray();
        $myPermissions = array_column($myPermissions,'id');

        return view('role.permission',compact('permissions','myPermissions','role'));
    }

    public function storePermission(AdminRole $role)
    {
        $this->validate(request(),[
            'permissions' => 'nullable|array'
        ]);
        $permissions = AdminPermission::findMany(request('permissions'));
        $myPermissions = $role->permissions;
        $addPermissions = $permissions->diff($myPermissions);
        foreach($addPermissions as $permission){
            $role->grantPermission($permission);
        }
        $delPermissions = $myPermissions->diff($permissions);
        foreach($delPermissions as $permission){
            $role->deletePermission($permission);
        }
        return back();
    }

    public function destroy(AdminRole $role)
    {
	    $permissions = $role->permissions;
	    foreach($permissions as $permission){
		    $role->deletePermission($permission);
	    }
        $role->delete();
        return [
            'error' => 0,
            'msg'   => ''
        ];
    }
}