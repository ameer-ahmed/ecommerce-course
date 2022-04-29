<?php

namespace EcommerceCourse\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $uri = removeFromString($request->path(), [app()->getLocale(), 'admin'], '/', false, true);
        if (! $request->expectsJson()) {
            if ($request->is([
                'admin',
                'admin/*',
                app()->getLocale().'/admin*'
            ]))
                return route('admin.login').(!empty($uri) ? '?goto='.$uri : '');
            return route('login');
        }
    }
}
