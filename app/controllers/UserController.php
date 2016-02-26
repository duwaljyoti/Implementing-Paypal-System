<?php

use Illuminate\Http\Request;

class UserController extends \BaseController
{

    /**
     * @param UserRepository $user
     * @param Request $request
     */
    public function __construct(UserRepository $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }
    public function Login()
    {
        return View::make('login');
    }
    public function AdminLogin()
    {
        return View::make('login');
    }
    public function LogOut()
    {
        Session::forget('username');
        return View::make('login');
    }
    public function signUp()
    {
        return View::make('sign_up');
    }
    public function store()
    {
        $user_validation = Validator::make(Input::all(), ['username' => 'required', 'password' => 'required']);
        if ($user_validation->passes()) {
            $data = $this->request->all();
            // $user_check_auth=Auth::attempt(['username'=>$data['username'],'password'=>$data['password']]);
            $user_num = $this->user->check_user_auth($data);
            echo $num_users = count($user_num);
            if ($num_users == 0) {
                return View::make('login', ['login_failed_message' => "<P>Please Login with authentic values"]);
            } else {
                $logged_user = Session::get('username');
                Session::put('username', $data['username']);
                if ($data['username'] == 'adminlaravel') {
                    return Redirect::action('MainController@admin');
                } else {
                    return Redirect::action('MainController@home');
                }

            }
        } else {
            return Redirect::back()->withInput()->withErrors($messages = $user_validation->messages());
        }

    }
    // signUpNewUser
    public function signUpUser()
    {
        $sign_up_user_validation = Validator::make(Input::all(), ['name' => 'required', 'username' => 'required|unique:users', 'password' => 'required', 'grade' => 'required', 'faculty' => 'required']);
        if ($sign_up_user_validation->passes()) {
            $sign_up_data = $this->request->all();
            $this->sign_up_user($sign_up_data);
            return View::make('login');
        } else // var_dump($sign_up_user_validation->messages());
        {
            return Redirect::back()->withInput()->withErrors($messages = $sign_up_user_validation->messages());
        }

    }

}
