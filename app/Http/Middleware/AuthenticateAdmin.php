<?php
/**
 * Created by PhpStorm.
 * User: Gary.P.Dong
 * Date: 2016/6/2
 * Time: 9:19
 */

namespace App\Http\Middleware;

use Closure;
use Route,URL,Auth;

class AuthenticateAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if(!Auth::guard($guard)->check()){
            return redirect('admin/login');
        }

        if(Auth::guard($guard)->user()->is_super){
            return $next($request);
        }

        $previousUrl = URL::previous();
        $action = Route::currentRouteAction();
        $action = last(explode('@',$action));
        $scopeAuth = str_replace($action,'*',Route::currentRouteName());
        if(!Auth::guard($guard)->user()->can(Route::currentRouteName())&&!Auth::guard($guard)->user()->can($scopeAuth)) {
            if($request->ajax() && ($request->getMethod() != 'GET')) {
                return response()->json([
                    'status' => -1,
                    'code' => 403,
                    'msg' => '您没有权限执行此操作'
                ]);
            } else {
                return view('admin.errors.403', compact('previousUrl'));
            }
        }

        return $next($request);
    }
}