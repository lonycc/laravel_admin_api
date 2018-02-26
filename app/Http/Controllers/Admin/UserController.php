<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPermission;
use App\Models\AdminRole;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = AdminUser::paginate(10);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        $this->validate(request(),[
            'name'      => 'required|string|min:3|max:10|unique:users',
            'password'  => 'required|min:8|max:20',
            'email'     => 'required|email|unique:users'
        ]);

        $name = request('name');
        $password = bcrypt(request('password'));
        $email = request('email');
        AdminUser::create(compact('name','password','email'));
        return redirect(route('users.index'));
    }

    public function edit(AdminUser $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(AdminUser $user)
    {
        $this->validate(request(), [
            'name' => [
                'string',
                'min:3',
                'max:10',
                Rule::unique('users')->ignore($user->id)
            ],
            'email' => 'email'
        ]);
        $user->name = request('name');
        $user->email = request('email');
        if ( request('password') ) {
            $this->validate(request(), [
                'password'  => 'min:5|max:10'
            ]);
            $user->password = bcrypt(request('password'));
        }
        $user->save();
        return redirect(route('users.index'));
    }

    public function role(AdminUser $user)
    {
        $roles = AdminRole::all();
        $myRoles = $user->roles;
        return view('user.role',compact('user','roles','myRoles'));
    }

    public function storeRole(AdminUser $user)
    {
        $this->validate(request(),[
            'roles' =>'array'
        ]);
        $roles = AdminRole::findMany(request('roles'));
        $myRoles = $user->roles;

        //要增加的角色
        $addRoles = $roles->diff($myRoles);
        foreach($addRoles as $role) {
            $user->assignRole($role);
        }

        //要删除的
        $deleteRoles = $myRoles->diff($roles);
        foreach($deleteRoles as $role) {
            $user->deleteRole($role);
        }
        return back();
    }


    public function destroy(AdminUser $user)
    {
        $roles = $user->roles;
        foreach($roles as $role){
            $user->deleteRole($role);
        }
        $user->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }
}
