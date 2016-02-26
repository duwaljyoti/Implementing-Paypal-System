<?php 
// namespace Repository;
	class UserRepository{
		public function __construct(User $user){
			$this->user=$user;
		}
		public function check_user_auth(){
			if (!isset($users_login_check)) 
			// 	$users_login_check = new stdClass();

			// $users_login_check->success = false;
			// $users_login_check->username=Input::get('username');
			// $users_login_check->password=Input::get('password');
			// $users_login_check = DB::table('users')->where('username', '=',Input::get('username'))->Where('password', '=',Input::get('password'))->get();
				return 1;
			return $users_login_check;
		}
		public function sign_up_user_repo(){
			$user->name=Input::get('name');
			$user->username=Input::get('username');
			$user->password=Input::get('password');//Hash::make(Input::get('password'));
			$user->grade=Input::get('grade');
			$user->faculty=Input::get('faculty');
			$user->save();
		}
}