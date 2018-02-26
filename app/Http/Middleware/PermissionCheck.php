<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ( ! Auth::check() ) {
            \Session::flash('msg', '请先登录');
            return redirect(route('admin.login'));
        }

        $user = Auth::user();
        $currentAction = \Route::currentRouteAction();
        $permissions = [];
        if ( $user->roles->contains(1) ) {
            $actions = \App\Models\AdminPermission::where('parent_id', 0)->with('children')->get();
        } else {
            $user->load('roles.permissions');
            foreach( $user->roles as $role ) {
                foreach( $role->permissions as $permission ) {
                    $permissions[] = $permission;
                }
            }
            $actions = $this->buildTree($permissions);

            if ( !$this->checkPermission($currentAction, $actions) ) {
                \Session::flash('msg', '对不起,你没有权限访问该资源');
                return redirect(route('admin.login'));
            }

        }
        \View::composer('layout.sidebar', function($view) use ($actions) {
            $view->with('actions', $actions);
        });
        return $next($request);
    }

    public function buildTree($actions ,$parent_id = 0){
        $returnValue = array();
        foreach ( $actions as $action ) {
            if ( $action->parent_id == $parent_id ) {
                $children = $this->buildTree($actions, $action->id);
                if ( $children ) {
                    $action->children = $children;
                }
                $returnValue[] = $action;
            }
        }
        return collect($returnValue);
    }

    private function checkPermission($currentAction, $actions, $level = 1)
    {
        $flag = false;
        foreach ( $actions as $action ) {

            $flag = $currentAction === $action->namespace . '\\' . $action->controller.'@'.$action->action;
            if ( !$flag && $action->children && !$action->children->isEmpty() ) {
                $flag = $this->checkPermission($currentAction, $action->children);
            }
            if ( $flag ) {
                break;
            }
        }
        return $flag;
    }

}
