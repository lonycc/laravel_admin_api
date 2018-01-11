<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    private $admin;
    private $test;
    private $role;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sidebar = $this->sidebar();
        $this->user();
        $this->role();
        $this->user_role();
        $this->permission_seed($sidebar);
    }

    private function role()
    {
        \App\Models\AdminRole::insert([
            'name'          => '超级管理员',
            'description'   => '最高权限管理员'
        ]);
        $this->role = \App\Models\adminRole::create([
            'name'          => '测试员',
            'description'   => '测试模块'
        ]);
    }

    private function user_role()
    {
        $role = \App\Models\AdminRole::find(1);
        $this->admin->assignRole($role);
    }

    private function user()
    {
        $this->admin = \App\Models\User::create([
            'name'      => 'admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt('123456')
        ]);
        $this->test = \App\Models\User::create([
            'name'      => 'test',
            'email'     => 'test@test.com',
            'password'  => bcrypt('123456')
        ]);
    }


    private function permission_seed($left_bar, $parent_id = 0)
    {
        foreach ($left_bar as $val) {
            $model = \App\Models\AdminPermission::create([
                'id'            => $val['id'],
                'name'          => $val['name'],
                'parent_id'     => $val['parent_id'],
                'action'        => $val['action'],
                'namespace'     => $val['namespace'],
                'controller'    => $val['controller'],
                'class'         => $val['class'],
                'description'   => $val['description'],

            ]);
            if (isset($val['children']) && $val['children']) {
                $this->permission_seed($val['children'], $model->id);
            }
            /*if ($val['action_class'] == 'Test1Controller' || $val['action_name'] == '测试模块1') {
                $this->role1->actions()->save($model);
            }
            if ($val['action_class'] == 'Test2Controller' || $val['action_name'] == '测试模块2') {
                $this->role2->actions()->save($model);
            }
            if ($val['action_class'] == 'HomeController') {
                $this->role1->actions()->save($model);
                $this->role2->actions()->save($model);
            }*/
        }
    }

    private function sidebar()
    {
        return [
            0 =>
                [
                    'id' => 1,
                    'name' => '欢迎',
                    'description' => '',
                    'parent_id' => 0,
                    'class' => 'fa-dashboard',
                    'namespace' => 'App\\Http\\Controllers\\Admin',
                    'controller' => 'HomeController',
                    'action' => 'index',
                    'children' => [],
                ],
            1 =>
                [
                    'id' => 2,
                    'name' => '权限管理',
                    'description' => '',
                    'parent_id' => 0,
                    'class' => 'fa-gears',
                    'namespace' => '',
                    'controller' => '',
                    'action' => '',
                    'children' => [],
                ],
            2 =>
                [
                    'id' => 3,
                    'name' => '用户管理',
                    'description' => '',
                    'parent_id' => 2,
                    'class' => 'fa-users',
                    'namespace' => 'App\\Http\\Controllers\\Admin',
                    'controller' => 'UserController',
                    'action' => 'index',
                    'children' =>
                        [
                            0 =>
                                [
                                    'id' => 10,
                                    'name' => '添加用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'UserController',
                                    'action' => 'create',
                                ],
                            1 =>
                                [
                                    'id' => 11,
                                    'name' => '保存用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'UserController',
                                    'action' => 'store',
                                ],
                            2 =>
                                [
                                    'id' => 12,
                                    'name' => '编辑用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'UserController',
                                    'action' => 'edit',
                                ],
                            3 =>
                                [
                                    'id' => 13,
                                    'name' => '更新用户',
                                    'description' => '',
                                    'parent_id' => 3,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'UserController',
                                    'action' => 'update',
                                ],
	               4 =>
		        [
			'id' => 18,
			'name' => '删除用户',
			'description' => '',
			'parent_id' => 3,
			'class' => NULL,
			'namespace' => 'App\\Http\\Controllers\\Admin',
			'controller' => 'UserController',
			'action' => 'destroy',
		        ],
                        ],
                ],
            3 =>
                [
                    'id' => 4,
                    'name' => '角色管理',
                    'description' => '',
                    'parent_id' => 2,
                    'class' => 'fa-user-plus',
                    'namespace' => 'App\\Http\\Controllers\\Admin',
                    'controller' => 'RoleController',
                    'action' => 'index',
                    'children' =>
                        [
                            0 =>
                                [
                                    'id' => 14,
                                    'name' => '添加角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'RoleController',
                                    'action' => 'create',
                                ],
                            1 =>
                                [
                                    'id' => 16,
                                    'name' => '编辑角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'RoleController',
                                    'action' => 'edit',
                                ],
                            2 =>
                                [
                                    'id' => 17,
                                    'name' => '更新角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'RoleController',
                                    'action' => 'update',
                                ],
                            3 =>
                                [
                                    'id' => 15,
                                    'name' => '保存角色',
                                    'description' => '',
                                    'parent_id' => 4,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'RoleController',
                                    'action' => 'store',
                                ],
	                4 =>
		        [
			'id' => 19,
			'name' => '删除角色',
			'description' => '',
			'parent_id' => 4,
			'class' => NULL,
			'namespace' => 'App\\Http\\Controllers\\Admin',
			'controller' => 'RoleController',
			'action' => 'destroy',
		        ],
                        ],
                ],
            4 =>
                [
                    'id' => 5,
                    'name' => '操作管理',
                    'description' => '',
                    'parent_id' => 2,
                    'class' => 'fa-cogs',
                    'namespace' => 'App\\Http\\Controllers\\Admin',
                    'controller' => 'PermissionController',
                    'action' => 'index',
                    'children' =>
                        [
                            0 =>
                                [
                                    'id' => 6,
                                    'name' => '添加操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'PermissionController',
                                    'action' => 'create',
                                ],
                            1 =>
                                [
                                    'id' => 7,
                                    'name' => '保存操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'PermissionController',
                                    'action' => 'store',
                                ],
                            2 =>
                                [
                                    'id' => 8,
                                    'name' => '编辑操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'PermissionController',
                                    'action' => 'edit',
                                ],
                            3 =>
                                [
                                    'id' => 9,
                                    'name' => '更新操作',
                                    'description' => '',
                                    'parent_id' => 5,
                                    'class' => NULL,
                                    'namespace' => 'App\\Http\\Controllers\\Admin',
                                    'controller' => 'PermissionController',
                                    'action' => 'update',
                                ],
	                4 =>
		        [
			'id' => 20,
			'name' => '删除操作',
			'description' => '',
			'parent_id' => 5,
			'class' => NULL,
			'namespace' => 'App\\Http\\Controllers\\Admin',
			'controller' => 'PermissionController',
			'action' => 'destroy',
		        ],
                        ],
                ],
        ];
    }
}
