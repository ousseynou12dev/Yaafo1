<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{  public function handle(Request $request, Closure $next)
{
    if (!Auth::check() || !Auth::user()->isAdmin()) {
        abort(403, 'Accès interdit');
    }

    return $next($request);
}

}
