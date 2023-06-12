<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        // return $request->expectsJson() ? null : route('login');
        $api = new ApiController;
        abort($api->error([],'veuillez vous connecté',403));
        // return $request->expectsJson() ? null : $api->error([],'accès interdit',401);
    }
}
