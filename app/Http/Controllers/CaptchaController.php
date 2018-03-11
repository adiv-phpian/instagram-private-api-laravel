<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use \Session;
use \Auth;

class CaptchaController extends Controller
{
    //
    public function index(Request $request){
      \Session::put('request_count', 0);
      \Session::put('captcha', false);
      \Session::put('last_request', strtotime("now"));

      return view('auth.captcha');
    }

    public function verify(Request $request){

        $validate = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        if ($validate->fails()) {
            return Redirect::back()
                ->withErrors($validate) // send back all errors to the login form
                ->withInput();

        } else {
          \Session::put('captcha', true);
          \Session::put('last_captcha', strtotime("now"));

          if(!Auth::check()){
            return redirect('/');
          }else{
            return redirect('/alogin');
          }
        }
    }
}
