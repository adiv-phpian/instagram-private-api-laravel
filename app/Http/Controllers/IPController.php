<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request,
    \Instagram\Instagram,
    App\IPModel,
    App\ip_list,
    Session;
use Illuminate\Support\Facades\Hash;

use \MetzWeb\Instagram\Instagram as InstaAPI;

class IPController extends Controller
{
    public function login(){
      return view('auth.ig_login');
    }

    public function login_confirm(Request $request){

      $user = IPModel::where("username", $request->username)->with('ip')->get();

      if (count($user)  == 1 && Hash::check($request->password, $user[0]->password) && $user[0]->active < date("Y-m-d H:i:s")) {
          // The passwords match...
          if($this->check_login_and_set_session($user, $request) == true){
             return redirect("/");
          }
      }

      if(!Session::has('proxy')){

         if(count($user) == 1){
           Session::put("proxy", $user[0]->ip);

         }else{
           $ip = $this->get_random_proxy();

           Session::put("proxy", $ip);
         }
      }

        $instagram = new \Instagram\Instagram();
        $instagram->setProxy(Session('proxy'));
        //$instagram->setVerifyPeer(false);

        try {

            $response = $instagram->login($request->username, $request->password);

            if(!is_object($response) && isset($response['code']) && $response['code'] == 201){

              $url = $response['url'];

              $res = $instagram->ChallengeCode($response['url']);

              $pattern = '/window._sharedData = (.*);/';
              preg_match($pattern, $res, $matches);

              //$res = $instagram->GetChallengeMethods($response['url']);

              $json = json_decode($matches[1]);

              $method = $json->entry_data->Challenge[0]->extraData->content[3]->fields[0]->values[0];

              $response = $instagram->sendVerificationCode($response['url'], $method->value);

              $insta = $instagram->saveSession();

              $pass = Hash::make($request->password);

              return view("auth.challenge", compact('response', 'insta', 'url', 'pass', 'method'));

            }

            $savedSession = $instagram->saveSession();

        } catch(\Exception $e){

            $msg = $e->getMessage();

            if(strpos($msg, 'Instagram Request failed') !== false){
              Session::put("proxy", $this->get_random_proxy());
            }

            return view("auth.ig_login", ['error' => $msg]);
        }

        $userId = json_decode($savedSession)->loggedInUser->pk;

        $userInfo = $instagram->getUserInfo($userId);

        $pass = Hash::make($request->password);

        $this->set_session_for_user($userId, $pass, $userInfo, $savedSession);

        return redirect("/");
    }

    private function set_session_for_user($userId, $pass, $userInfo, $savedSession){

      Session::put("pk", $userId);

      $user = array('instagram_user_id' => $userId,
                    'username' => $userInfo->user->username,
                    'user_info' => json_encode($userInfo));

      if($pass != false){
         $user['password'] = $pass;
         $user['user_session'] = $savedSession;
         $user['proxy'] = Session('proxy')->id;
         $user['active'] = date("Y-m-d H:i:s", strtotime("now"));
       }

      IPModel::updateOrCreate(['instagram_user_id' => $userId], $user);
    }

    private function check_login_and_set_session($user, $request){
      $user = $user[0];

      try{

          $instagram = new \Instagram\Instagram();
          $instagram->setProxy($user->ip);
          $instagram->initFromSavedSession($user->user_session);

          $userInfo = $instagram->getUserInfo($user->instagram_user_id);

          if(!isset($userInfo->user)) return false;

          $this->set_session_for_user($user->instagram_user_id, false, $userInfo, false);

          return true;

        }catch(\Exception $e){
            return false;
        }
    }

    public function confirm_code(Request $request){

      $time = date("Y-m-d H:i:s", strtotime("now"));

     try{

      $instagram = new \Instagram\Instagram();
      $instagram->setProxy(Session('proxy'));
      $session = $request->insta;
      $method = json_decode($request->method_obj);

      $instagram->initFromSavedSession($session);
      $response = $instagram->ConfirmVerificationCode($request->url, $request->code);

      if($response->status == "ok"){

        $savedSession = json_decode($instagram->saveSession());
        $userId  = $savedSession->cookies->ds_user_id;
        $savedSession->loggedInUser['pk'] = $userId;

        $instagram->initFromSavedSession(json_encode($savedSession));

        $userInfo = $instagram->getUserInfo($userId);

        Session::put("pk", $userId);

        $user = array('instagram_user_id' => $userId,
                      'username' => $userInfo->user->username,
                      'password' => $request->pass,
                      'user_session' => json_encode($savedSession),
                      'user_info' => json_encode($userInfo),
                      'proxy' => Session('proxy')->id,
                      'updated_at' => $time,
                      'active' => $time);

        IPModel::updateOrCreate(['instagram_user_id' => $userId], $user);

        return redirect("/");

      }else{
        $insta = $session;
        $url = $request->url;
        $response = json_decode($request->url_obj);
        $method = json_decode($request->method_obj);
        $pass = $request->pass;
        $error = "Check the verification code.";
        return view("auth.challenge", compact('response', 'insta', 'url', 'error', 'method', 'pass'));
      }

     }catch(\Exception $e){
        \Log::error('Confirmation code --- '.json_encode($e->getMessage()).'___'.json_encode($savedSession));
        return redirect("/");
    }
  }

    public function resend_code(Request $request){

      try{
        $instagram = new \Instagram\Instagram();
        $instagram->setProxy(Session('proxy'));
        $insta = $request->insta;
        $url = $request->url;
        $method = json_decode($request->method_obj);

        $instagram->initFromSavedSession($insta);

        $response = json_decode($request->url_obj);

        $replay_url = 'https://i.instagram.com'.$response->navigation->replay;

        $response = $instagram->SendVerificationCodeAgain($request->url, $replay_url);
        $pass = $request->pass;

        $sucess = "Verification code sent successfully";

        if($response->status == "ok"){
           return view("auth.challenge", compact('response', 'insta', 'url', 'sucess', 'pass', 'method'));
        }else{
          return redirect('/login');
        }

      }catch(\Exception $e){

          $msg = $e->getMessage();

          if(strpos($msg, 'Instagram Request failed') !== false){
            Session::put("proxy", $this->get_random_proxy());
          }

          return view("auth.ig_login", ['error' => $msg]);
      }
    }


    public function facebook(){
      return view('auth/facebook_login');
    }

    public function facebook_token(Request $request){

      $token = $request->access_token;

      $instagram = new InstaAPI(array(
      	'apiKey'      => '3245325dsfrdsfds',
      	'apiSecret'   => 'dsfdsfr5345r',
      	'apiCallback' => 'http://fsdfdsfsdf.com'
      ));

      $instagram->setAccessToken($token);

      $user = $instagram->getUser();

      return view('auth/facebook_login');
    }

    public function logout(){
      Session::forget("pk");
      Session::forget("proxy");
      return redirect("/");
    }

    public function instagram_logout(){

      $user = IPModel::where(['instagram_user_id' => \Session::get('pk')])->with('ip')->get()->first();

      $instagram = new \Instagram\Instagram();
      $instagram->setProxy($user->ip);
      $instagram->initFromSavedSession($user->user_session);

      $response = $instagram->logout();

      Session::forget("pk");
      Session::forget("proxy");
      return redirect("/");
    }

    public function get_random_proxy($id = 0){
      if($id > 0){
        $ip = ip_list::where('id', $id)->get();

        if(count($ip) == 0){
           return view("auth.ig_login", ['error' => "There's no proxy available to add your account, contact your admin"]);
        }

        $ip = $ip[0];

      }else{
        $ip = ip_list::orderBy('updated_at', 'ASC')->take(1)->get();

        if(count($ip) == 0){
           return view("auth.ig_login", ['error' => "There's no proxy available to add your account, contact your admin"]);
        }

        $ip = $ip[0];
        ip_list::where('id', $ip->id)->update(['updated_at' => date("Y-m-d H:i:s")]);
      }

      return $ip;
    }

}
