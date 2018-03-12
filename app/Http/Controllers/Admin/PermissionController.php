<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPermission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = AdminPermission::paginate(20);
        return view('permission.index', compact('permissions'));
    }

    public function create()
    {
        $parents = AdminPermission::where('parent_id', 0)->orWhere('action','index')->get();
        return view('permission.create', compact('parents'));
    }

    public function store()
    {
		$this->validate(request(),[
			'name'          => 'required|string|min:2|max:10',
			'parent_id'     => 'required|integer',
			'namespace'     => 'nullable|string',
			'controller'    => 'nullable|string',
			'action'        => 'nullable|string',
			'class'         => 'nullable|string',
			'description'   => 'nullable|string'
		]);
		$name           = request('name');
		$parent_id      = request('parent_id');
		$namespace      = request('namespace')?request('namespace'):'';
		$controller     = request('controller')?request('controller'):'';
		$action         = request('action')?request('action'):'';
		$class          = request('class');
		$description    = request('description')?request('description'):'';
		AdminPermission::create(compact('name','parent_id','namespace','controller','action','class','description'));

		return redirect(route('permissions.index'));
    }

    public function edit(AdminPermission $permission)
    {
        $parents = AdminPermission::where('parent_id', 0)->orWhere('action', 'index')->get();
        return view('permission.edit', compact('permission','parents'));
    }

    public function update(AdminPermission $permission)
    {
		$this->validate(request(),[
			'name'          => 'required|string|min:2|max:10',
			'parent_id'     => 'required|integer',
			'namespace'     => 'nullable|string',
			'controller'    => 'nullable|string',
			'action'        => 'nullable|string',
			'class'         => 'nullable|string',
			'description'   => 'nullable|string'
		]);
		$permission->name           = request('name');
		$permission->parent_id      = request('parent_id');
		$permission->namespace      = request('namespace')?request('namespace'):'';
		$permission->controller     = request('controller')?request('controller'):'';
		$permission->action         = request('action')?request('action'):'';
		$permission->class          = request('class');
		$permission->description    = request('description')?request('description'):'';
		$permission->save();
		return redirect(route('permissions.index'));
    }

    public function destroy(AdminPermission $permission)
    {
        $childrens = $permission->children;
        foreach($childrens as $children)
        {
            $children->delete();
        }
        $permission->delete();
        return [
            'error' => 0,
            'msg'   => ''
        ];
    }

}
