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
            /*
            if ($val['action_class'] == 'Test1Controller' || $val['action_name'] == '测试模块1') {
                $this->role1->actions()->save($model);
            }
            if ($val['action_class'] == 'Test2Controller' || $val['action_name'] == '测试模块2') {
                $this->role2->actions()->save($model);
            }
            if ($val['action_class'] == 'HomeController') {
                $this->role1->actions()->save($model);
                $this->role2->actions()->save($model);
            }
            */
        }
    }

    private function sidebar()
    {
        return [
            0 => [
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
            1 => [
                'id' => 2,
                'name' => '修改密码',
                'description' => '',
                'parent_id' => 1,
                'class' => 'fa-boom',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'HomeController',
                'action' => 'edit',
                'children' => [
                    0 => [
                        'id' => 3,
                        'name' => '编辑密码',
                        'description' => '编辑',
                        'parent_id' => 2,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'HomeController',
                        'action' => 'edit',                            
                    ],
                    1 => [
                        'id' => 4,
                        'name' => '更新密码',
                        'description' => '更新',
                        'parent_id' => 2,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'HomeController',
                        'action' => 'update',                            
                    ],                      
                ],
            ],                     
            2 => [
                'id' => 5,
                'name' => '权限管理',
                'description' => '',
                'parent_id' => 0,
                'class' => 'fa-gears',
                'namespace' => '',
                'controller' => '',
                'action' => '',
                'children' => [],
            ],
            3 => [
                'id' => 6,
                'name' => '用户管理',
                'description' => '',
                'parent_id' => 5,
                'class' => 'fa-users',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'UserController',
                'action' => 'index',
                'children' => [
                    0 => [
                        'id' => 7,
                        'name' => '添加用户',
                        'description' => '',
                        'parent_id' => 6,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'UserController',
                        'action' => 'create',
                    ],
                    1 => [
                        'id' => 8,
                        'name' => '保存用户',
                        'description' => '',
                        'parent_id' => 6,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'UserController',
                        'action' => 'store',
                    ],
                    2 => [
                        'id' => 9,
                        'name' => '编辑用户',
                        'description' => '',
                        'parent_id' => 6,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'UserController',
                        'action' => 'edit',
                    ],
                    3 => [
                        'id' => 10,
                        'name' => '更新用户',
                        'description' => '',
                        'parent_id' => 6,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'UserController',
                        'action' => 'update',
                    ],
                    4 => [
                        'id' => 11,
                        'name' => '删除用户',
                        'description' => '',
                        'parent_id' => 6,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'UserController',
                        'action' => 'destroy',
                    ],
                ],
            ],
            4 => [
                'id' => 12,
                'name' => '角色管理',
                'description' => '',
                'parent_id' => 5,
                'class' => 'fa-user-plus',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'RoleController',
                'action' => 'index',
                'children' => [
                    0 => [
                        'id' => 13,
                        'name' => '添加角色',
                        'description' => '',
                        'parent_id' => 12,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'RoleController',
                        'action' => 'create',
                    ],
                    1 => [
                        'id' => 14,
                        'name' => '编辑角色',
                        'description' => '',
                        'parent_id' => 12,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'RoleController',
                        'action' => 'edit',
                    ],
                    2 => [
                        'id' => 15,
                        'name' => '更新角色',
                        'description' => '',
                        'parent_id' => 12,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'RoleController',
                        'action' => 'update',
                    ],
                    3 => [
                        'id' => 16,
                        'name' => '保存角色',
                        'description' => '',
                        'parent_id' => 12,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'RoleController',
                        'action' => 'store',
                    ],
                    4 => [
                        'id' => 17,
                        'name' => '删除角色',
                        'description' => '',
                        'parent_id' => 12,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'RoleController',
                        'action' => 'destroy',
                    ],
                ],
            ],
            5 => [
                'id' => 18,
                'name' => '操作管理',
                'description' => '',
                'parent_id' => 5,
                'class' => 'fa-cogs',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'PermissionController',
                'action' => 'index',
                'children' => [
                    0 => [
                        'id' => 19,
                        'name' => '添加操作',
                        'description' => '',
                        'parent_id' => 18,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'PermissionController',
                        'action' => 'create',
                    ],
                    1 => [
                        'id' => 20,
                        'name' => '保存操作',
                        'description' => '',
                        'parent_id' => 18,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'PermissionController',
                        'action' => 'store',
                    ],
                    2 => [
                        'id' => 21,
                        'name' => '编辑操作',
                        'description' => '',
                        'parent_id' => 18,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'PermissionController',
                        'action' => 'edit',
                    ],
                    3 => [
                        'id' => 22,
                        'name' => '更新操作',
                        'description' => '',
                        'parent_id' => 18,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'PermissionController',
                        'action' => 'update',
                    ],
                    4 => [
                        'id' => 23,
                        'name' => '删除操作',
                        'description' => '',
                        'parent_id' => 18,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'PermissionController',
                        'action' => 'destroy',
                    ],
                ],
            ],
            6 => [
                'id' => 24,
                'name' => '授权管理',
                'description' => '',
                'parent_id' => 0,
                'class' => 'fa-digg',
                'namespace' => '',
                'controller' => '',
                'action' => '',
                'children' => [],
            ],
            7 => [
                'id' => 25,
                'name' => '用户',
                'description' => '授权用户',
                'parent_id' => 24,
                'class' => 'fa-child',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'ClientController',
                'action' => 'index',
                'children' => [
                    0 => [
                        'id' => 26,
                        'name' => '添加用户',
                        'description' => '',
                        'parent_id' => 25,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'ClientController',
                        'action' => 'create',
                    ],
                    1 => [
                        'id' => 27,
                        'name' => '编辑用户',
                        'description' => '',
                        'parent_id' => 25,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'ClientController',
                        'action' => 'edit',
                    ],
                    2 => [
                        'id' => 28,
                        'name' => '更新用户',
                        'description' => '',
                        'parent_id' => 25,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'ClientController',
                        'action' => 'update',
                    ],
                    3 => [
                        'id' => 29,
                        'name' => '保存用户',
                        'description' => '',
                        'parent_id' => 25,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'ClientController',
                        'action' => 'store',
                    ],
                    4 => [
                        'id' => 30,
                        'name' => '删除用户',
                        'description' => '',
                        'parent_id' => 25,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'ClientController',
                        'action' => 'destroy',
                    ],
                ],
            ],
            8 => [
                'id' => 31,
                'name' => '日志',
                'description' => '操作日志',
                'parent_id' => 24,
                'class' => 'fa-fax',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'LotteryController',
                'action' => 'index',
                'children' => [
                    0 => [
                        'id' => 32,
                        'name' => '删除用户',
                        'description' => '',
                        'parent_id' => 31,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'LogController',
                        'action' => 'destroy',
                    ],
                ],
            ],
            9 => [
                'id' => 33,
                'name' => '应用',
                'description' => '应用管理',
                'parent_id' => 24,
                'class' => 'fa-apple',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'AppController',
                'action' => 'index',
                'children' => [
                    0 => [
                        'id' => 34,
                        'name' => '添加应用',
                        'description' => '',
                        'parent_id' => 33,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'AppController',
                        'action' => 'create',
                    ],
                    1 => [
                        'id' => 35,
                        'name' => '编辑应用',
                        'description' => '',
                        'parent_id' => 33,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'AppController',
                        'action' => 'edit',
                    ],
                    2 => [
                        'id' => 36,
                        'name' => '更新应用',
                        'description' => '',
                        'parent_id' => 33,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'AppController',
                        'action' => 'update',
                    ],
                    3 => [
                        'id' => 37,
                        'name' => '保存应用',
                        'description' => '',
                        'parent_id' => 33,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'AppController',
                        'action' => 'store',
                    ],
                    4 => [
                        'id' => 38,
                        'name' => '删除应用',
                        'description' => '',
                        'parent_id' => 33,
                        'class' => NULL,
                        'namespace' => 'App\\Http\\Controllers\\Admin',
                        'controller' => 'AppController',
                        'action' => 'destroy',
                    ],             
                ],
            ],
            10 => [
                'id' => 39,
                'name' => '新闻',
                'description' => '新闻管理',
                'parent_id' => 0,
                'class' => 'fa-spinner',
                'namespace' => '',
                'controller' => '',
                'action' => '',
                'children' => [],
            ],
            11 => [
                'id' => 49,
                'name' => '稿件',
                'description' => '稿件管理',
                'parent_id' => 39,
                'class' => 'fa-chrome',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'NewsController',
                'action' => 'index',
                'children' => [],
            ], 
            12 => [
                'id' => 41,
                'name' => '栏目',
                'description' => '栏目管理',
                'parent_id' => 39,
                'class' => 'fa-cubes',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'ChannelController',
                'action' => 'index',
                'children' => [],
            ],
            13 => [
                'id' => 42,
                'name' => '评论',
                'description' => '评论管理',
                'parent_id' => 39,
                'class' => 'fa-comment',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'CommentController',
                'action' => 'index',
                'children' => [],
            ],
            14 => [
                'id' => 43,
                'name' => '抽奖',
                'description' => '抽奖管理',
                'parent_id' => 0,
                'class' => 'fa-th',
                'namespace' => '',
                'controller' => '',
                'action' => '',
                'children' => [],
            ],
            15 => [
                'id' => 44,
                'name' => '项目',
                'description' => '项目管理',
                'parent_id' => 43,
                'class' => 'fa-chrome',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'LotteryController',
                'action' => 'index',
                'children' => [],
            ], 
            16 => [
                'id' => 45,
                'name' => '数据集',
                'description' => '数据集管理',
                'parent_id' => 43,
                'class' => 'fa-cubes',
                'namespace' => 'App\\Http\\Controllers\\Admin',
                'controller' => 'LottoController',
                'action' => 'index',
                'children' => [],
            ],                                                                                     
        ];
    }

}
