<?php

include_once "connection.php";

class UserManager {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * createUser
     *
     * @return void
     */
    public function createUser()
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert(['nom' => 'hello', 'prenom' => 'test', 'email' => 'test@gmail.com']);
        $this -> $db->executeBulkWrite('db_php_forum.users', $bulk);
    }

    /**
     * updateUser
     *
     * @return void
     */
    public function updateUser()
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['prenom' => 'hello'],
            ['nom' =>'test']
        );
        $this -> $db->executeBulkWrite('db_php_forum.users', $bulk);

    }

    /**
     * deleteUser
     *
     * @return void
     */
    public function deleteUser()
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->delete(['prenom' => 'hello']);

        $this -> $db->executeBulkWrite('db_php_forum.users', $bulk);

    }





}
