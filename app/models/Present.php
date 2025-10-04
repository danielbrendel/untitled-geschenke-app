<?php

/*
    Asatru PHP - Model
*/

/**
 * This class extends the base model class and represents your associated table
 */ 
class Present extends \Asatru\Database\Model {
    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public static function getById($id)
    {
        try {
            return static::raw('SELECT * FROM `@THIS` WHERE id = ?', [$id])->first();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $pid
     * @return mixed
     * @throws \Exception
     */
    public static function getForPerson($pid)
    {
        try {
            return static::raw('SELECT * FROM `@THIS` WHERE person = ?', [$pid]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $pid
     * @return int
     * @throws \Exception
     */
    public static function getPersonQuantity($pid)
    {
        try {
            return static::raw('SELECT COUNT(*) AS count FROM `@THIS` WHERE person = ?', [$pid])->first()->get('count');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}