<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenancyByCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tenantId = $request->cookie('tenant_id');

        if ($tenantId) {
            $tenant = \App\Models\Tenant::find($tenantId);

            if ($tenant) {
                tenancy()->initialize($tenant);
            } else {
                // Handle case where tenant is not found
                // You might want to redirect to a default tenant or show an error
            }
        } else {
            $tenant = \App\Models\Tenant::find('default');
            tenancy()->initialize($tenant);
        }

        return $next($request);
    }
}
