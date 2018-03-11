<?php

namespace App\Http\Middleware;

use Closure,
    \Session;

class CheckForBot
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

   if(strpos($request->url(), "login-challenge") !== false) return $next($request);

   \Session::put('request_count', session('request_count')+1);

    if(session('request_count') > 30){
       if(\Session::get('last_request') > strtotime("-30 seconds")){
         return redirect('/verifyme');
       }else{
         \Session::put('request_count', 0);
         \Session::put('last_request', strtotime("now"));
       }
    }

    if(\Session::has('captcha') &&
       \Session::get('last_captcha') > strtotime("-5 minute")
      ) {

        return $next($request);

     }

    return redirect('/verifyme');
  }

  private function check_captcha($request, $next){

  }

  private function check_activity(){

  }
}
