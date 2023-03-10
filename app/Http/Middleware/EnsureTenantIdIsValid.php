<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureTenantIdIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param  \Closure(Request): (Response|RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->header('X-TenantID')){
            if($request->user()->tenant_id !== $request->header('X-TenantID')){
                $request->headers->set('X-TenantID', $request->user()->tenant_id);
            }
        }
        return $next($request);
    }
}