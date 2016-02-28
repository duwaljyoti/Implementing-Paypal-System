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
    /**
     * @param $userEmail
     * @return mixed
     */
    public function checkUserExists($userEmail)
    {
        $userCheck = $this->user->where('email', '=', $userEmail)->get();
        if (count($userCheck) == 0) {
            return $userCheck;
        } else {
            return $userCheck;
        }

    }
    /**
     * @param $userCode
     * @param $userId
     */
    public function pushCode($userCode, $userId)
    {
        $user = User::find($userId);
        $user->code = $userCode; //Hash::make($userCode);
        $user->save();
    }
    /**
     * @param $newPass
     * @param $userId
     * @param $dataCode
     * @return int
     */
    public function checkUserToReset($newPass, $userId, $dataCode)
    {
        $user = User::find($userId);
        if ($dataCode == $user->code) {
            $user->password = $newPass; //Hash::make($user->code);
            $user->save();
            return 1;

        }
        return 0;
    }
}
