<?php

class MailController extends \BaseController
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        // $message = Session::get('forgetMessage');
        return View::make('Mail/mailIndex');
    }
    public function sendEmailDemo()
    {

        $emailCodeValidation = Validator::make(Input::all(), array(
            'email' => 'required|email',
            'pCode' => 'required|numeric',
        ));
        if ($emailCodeValidation->passes()) {
            $user = new User;
            $user->email = Input::get('email');
            $user->code = Input::get('pCode');
            $userEmailCheck = $this->user->checkUserExists($user->email);
            if (count($userEmailCheck) == 0) {
                Session::flash('forgetMessage', "No Such Emails Registered.Please Try with a valid one");
                return Redirect::back()->withInput();
                // return $this->index();
            } else {
                // var_dump($userEmailCheck);

                foreach ($userEmailCheck as $info) {
                    $userEmail = $info->email;
                    $userId = $info->id;
                }

                echo $user->code;
                $this->user->pushCode($user->code, $userId);
                Mail::send('Mail/confirmMessage', array('userId' => $userId), function ($message) {
                    $message->to(Input::get('email'), Input::get('name'))->subject('Testing Email Functionality');
                });
                Session::flash('forgetMessage', 'Please check your email inbox');
                return Redirect::back();
            }
        } else {
            return Redirect::back()->withInput()->withErrors($messages = $emailCodeValidation->messages());
        }

    }
    public function changePass()
    {
        # code...
    }
}

// link(): No such file or directory (View: C:\wamp\www\late_laravel\app\views\mailDemo.blade.php)
