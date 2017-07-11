<?php 
// namespace App\Http\Middleware;

// use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

// class VerifyCsrfToken extends BaseVerifier
// {
//     /**
//      * The URIs that should be excluded from CSRF verification.
//      *
//      * @var array
//      */
//     protected $except = [
//         //
//     ];
// }
namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return parent::addCookieToResponse($request, $next($request));
    }

}
