<?php

/*
    Asatru PHP - Migration for Auth
*/

/**
 * Authentication migration
 */
class Auth_Migration {
    private $database = null;
    private $connection = null;

    /**
     * Set PDO connection handle
     * 
     * @param \PDO $pdo The PDO connection handle
     * @return void
     */
    public function __construct($pdo)
    {
        $this->connection = $pdo;
    }

    /**
     * Create the authentication database table
     * 
     * @return void
     */
    public function up()
    {
        $this->database = new Asatru\Database\Migration('Auth', $this->connection);
        $this->database->drop();
        $this->database->add('id INT NOT NULL AUTO_INCREMENT PRIMARY KEY');
        $this->database->add('email VARCHAR(512) NOT NULL');
        $this->database->add('username VARCHAR(512) NOT NULL');
        $this->database->add('password VARCHAR(512) NOT NULL');
        $this->database->add('account_confirm VARCHAR(512) NOT NULL');
        $this->database->add('updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        $this->database->add('created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
        $this->database->create();
    }

    /**
     * Drop the authentication database table
     * 
     * @return void
     */
    public function down()
    {
        if ($this->database)
            $this->database->drop();
    }
}
    