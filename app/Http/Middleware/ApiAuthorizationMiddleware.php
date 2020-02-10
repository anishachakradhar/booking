<?php

namespace App\Http\Middleware;

use Closure;
use App\ApiAuthorization;
use Illuminate\Support\Facades\Hash;

class ApiAuthorizationMiddleware
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
        $ielts = ApiAuthorization::where('username','ieltsbooking')->first();
        if($request->header('username') == $ielts->username && Hash::check('datebooking', $ielts->password))
        {
            return $next($request);
        }

        return response()->json([
            'error' => 'true',
            'message' => 'Unauthorized access'
        ],401);
        
    }
}
