<?php
/**
 * Created by PhpStorm.
 * User: xunting
 * Date: 2019/5/14
 * Time: 1:37 PM
 */

namespace App\Http\Middleware;
use Closure;

class VerifyRpc
{
    public function handle($request, Closure $next)
    {
        // if ("判断条件") {
        return $next($request);
        // }

        // 返回跳转到网站首页
        // return redirect('/');
    }
}
