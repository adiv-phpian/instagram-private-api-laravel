<?php

namespace App\Http\Middleware;

use Closure,
    \Session;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class CheckInstagramLogin extends Middleware
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
      if(\Session::has('pk')) return $next($request);

      return redirect('/login');

    }
}
