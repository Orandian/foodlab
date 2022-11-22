<?php

namespace App\Http\Middleware;

use App\Models\M_Site;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $mSite = new M_Site();
        $check = $mSite->maintenance();
        if ($check['maintenance'] == 0) {
            return $next($request);
        }
        return new Response(view('maintenance.maintenance'));
    }
}
