<?php 
	namespace Library\Repository;
	use User;




	class UserDataRepository implements UserDataInterface{
		public function __construct(){
			$this->user=$user;
		}
		public function disp_all(){
			$this->user->get();
		}
	}