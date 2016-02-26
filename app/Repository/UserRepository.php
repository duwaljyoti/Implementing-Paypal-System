<?php
// namespace Repository;
class UserRepository
{
    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * @param $form_data
     * @return mixed
     */
    public function checkUserAuth($form_data)
    {
        $matchThese = ['username' => $form_data['username'], 'password' => $form_data['password']];
        $user_check = $this->user->where($matchThese)->get();
        return $user_check;
    }
    /**
     * @param $form_sign_up_data
     */
    public function signUpUserRepo($form_sign_up_data)
    {

        $user->name = $form_sign_up_data['name'];
        $user->username = $form_sign_up_data['username'];
        $user->password = Hash::make('password'); //Hash::make(Input::get('password'));
        $user->grade = $form_sign_up_data['grade'];
        $user->faculty = $form_sign_up_data['faculty'];
        $user->save();
    }
}
