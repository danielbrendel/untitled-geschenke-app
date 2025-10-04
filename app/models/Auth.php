<?php
    
/*
    Asatru PHP - Model for Auth

    Default authentication model
*/

/**
 * Model representing the authentication table
 */
class Auth extends \Asatru\Database\Model {
    /**
     * Add a new user registration
     * 
     * @param string $username The name of the user
     * @param string $email The user E-Mail address
     * @param string $password The password given by the user
     * @return boolean
     */
    public static function register(string $username, string $email, string $password)
    {
        if (($username === '') || ($password === '') || (filter_var($email, FILTER_VALIDATE_EMAIL) === false))
            return false;

        $byemail = Auth::getByEmail($email);
        if (($byemail) && ($byemail->count() > 0))
            return false;

        $user_password = password_hash($password, PASSWORD_DEFAULT);
        $account_confirm = md5($username . $email . date('Y-m-d H:i:s') . random_bytes(55));

        try {
            Auth::insert('username', $username)->insert('email', $email)->insert('password', $user_password)->insert('account_confirm', $account_confirm)->go();
        } catch (\Exception $e) {
            return false;
        }

        //To-do: Send a confirmation e-mail with the account confirmation token in order to verify the e-mail address

        return true;
    }

    /**
     * Confirm user account
     * 
     * @param string $token Account token that was generated upon registration
     * @return bool
     */
    public static function confirm($token)
    {
        $user = Auth::where('account_confirm', '=', $token)->first();
        if (!$user)
            return false;

        try {
            Auth::update('account_confirm', '_confirmed')->where('id', '=', $user->get('id'))->go();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Log the user in
     * 
     * @param string $email The E-Mail address of the user
     * @param string $password The user password
     * @return boolean
     */
    public static function login(string $email, string $password)
    {
        $byemail = Auth::getByEmail($email);
        
        if ($byemail->count() === 0)
            return false;

        if ($byemail->get('account_confirm') !== '_confirmed')
            return false;

        if (!password_verify($password, $byemail->get('password')))
            return false;

        try {
            Session::loginSession($byemail->get('id'), session_id());
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Log the user out
     * 
     * @return boolean
     */
    public static function logout()
    {
        try {
            Session::logoutSession(session_id());
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Get current authenticated user of this session if exists
     * 
     * @return Asatru\Database\Collection|null User data collection on success, otherwise null
     */
    public static function getAuthUser()
    {
        try {
            $session = Session::findSession(session_id());
            if (!$session) {
                return null;
            }

            $data = Auth::where('id', '=', $session->get('userId'))->first();
            if (!$data) {
                return null;
            }

            return $data;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get user by email
     * 
     * @param string $email The users E-Mail address
     * @return Asatru\Database\Collection|null User data collection on success, otherwise null
     */
    public static function getByEmail(string $email)
    {
        try {
            $result = Auth::where('email', '=', $email)->first();
        } catch (\Exception $e) {
            return null;
        }

        return $result;
    }

    /**
     * Get user by ID
     * 
     * @param int $userId The user ID
     * @return Asatru\Database\Collection|null User data collection on success, otherwise null
     */
    public static function getById(int $userId)
    {
        try {
            $result = Auth::where('id', '=', $userId)->first();
        } catch (\Exception $e) {
            return null;
        }

        return $result;
    }
}
    