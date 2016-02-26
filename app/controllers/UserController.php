<?php

class UserController  extends \BaseController {

	public function Login(){
		return View::make('login');
	}
	public function AdminLogin(){
		return View::make('login');
	}
	public function LogOut(){
	Session::forget('username');
	return View::make('login');
	}
	public function sign_up(){
		return View::make('sign_up');
	}
	public function store(){
		$user_validation = Validator::make(Input::all(),['username'=>'required','password'=>'required']);	
		if ($user_validation->passes())
		{
			$user=New User;
			$user->username=Input::get('username');
			$user->password=Input::get('password');
			$users = DB::table('users')
                    ->where('username', '=', $user->username)
                    ->Where('password', '=',$user->password)
                    ->get();
              if((count($users))==0) {
              	return View::make('login',['login_failed_message'=>"<P>Please Login with authentic values"]);   
              } 
              else {
              	$logged_user = Session::get('username'); 
              	Session::put('username', $user->username);
              	if ($user->username=='adminlaravel')
              	return Redirect::action('MainController@admin');
              else 
              {
              	return Redirect::action('MainController@home');
              }

              }
		}
		else return Redirect::back()->withInput()->withErrors($messages = $user_validation->messages());
		
	}
	public function sign_up_validator(){
		$sign_up_user_validation=Validator::make(Input::all(),['name'=>'required','username'=>'required|unique:users','password'=>'required','grade'=>'required','faculty'=>'required']);
		if ($sign_up_user_validation->passes()){
			$user= New User;
			$user->name=Input::get('name');
			$user->username=Input::get('username');
			$user->password=Input::get('password');//Hash::make(Input::get('password'));
			$user->grade=Input::get('grade');
			$user->faculty=Input::get('faculty');
			$user->save();
			echo "<script>alert('You Made it..Sign with Your credentials')</script>";
			return View::make('login');
		}
		else // var_dump($sign_up_user_validation->messages());
			return Redirect::back()->withInput()->withErrors($messages = $sign_up_user_validation->messages());
	}

}