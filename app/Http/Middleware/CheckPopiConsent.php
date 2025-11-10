<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPopiConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->popi_consent) {

            // Exclude the POPI consent page and logout route to avoid redirect loops
            $excludedRoutes = ['popi', 'terms','privacy','logout'];

            if (!in_array($request->route()->getName(), $excludedRoutes)) {
                return redirect()->route('popi');
            }
        }

        return $next($request);
    }

}
