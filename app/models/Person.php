<?php

/*
    Asatru PHP - Model
*/

/**
 * This class extends the base model class and represents your associated table
 */ 
class Person extends \Asatru\Database\Model {
    /**
     * @return mixed
     * @throws \Exception
     */
    public static function getAll()
    {
        return static::all();
    }

    /**
     * @param $name
     * @param $birthday
     * @return void
     * @throws \Exception
     */
    public static function addPerson($name, $birthday)
    {
        try {
            static::raw('INSERT INTO `@THIS` (name, birthday) VALUES(?, ?)', [$name, $birthday]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public static function getPersonInfo($id)
    {
        try {
            return static::raw('SELECT * FROM `@THIS` WHERE id = ?', [$id])->first();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}