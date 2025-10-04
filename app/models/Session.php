<?php

/*
    Asatru PHP - Model for Session

    Default session model
*/

/**
 * Model representing the session table
 */ 
class Session extends \Asatru\Database\Model {
    /**
     * Create an active session of that given user with the given session
     * 
     * @param $userId
     * @param $session
     * @return void
     * @throws \Exception
     */
    public static function loginSession($userId, $session)
    {
        try {
            if (!Session::hasSession($userId, $session)) {
                Session::insert('userId', $userId)->insert('session', $session)->insert('status', 1)->go();
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Ends the given session if active
     * 
     * @param $session
     * @return void
     * @throws \Exception
     */
    public static function logoutSession($session)
    {
        try {
            Session::where('session', '=', $session)->where('status', '=', 1)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Returns the data object of the given session if exists
     * 
     * @param $session
     * @return mixed
     * @throws \Exception
     */
    public static function findSession($session)
    {
        try {
            return Session::where('session', '=', $session)->where('status', '=', 1)->first();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Checks if a session of that given user exists
     * 
     * @param $userId
     * @param $session
     * @return bool
     * @throws \Exception
     */
    public static function hasSession($userId, $session)
    {
        try {
            return Session::where('userId', '=', $userId)->where('session', '=', $session)->get()->count();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Clears all sessions of that given user
     * 
     * @param $userId
     * @return void
     * @throws \Exception
     */
    public static function clearForUser($userId)
    {
        try {
            Session::where('userId', '=', $userId)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}