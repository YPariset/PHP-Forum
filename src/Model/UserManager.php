<?php

include_once "connection.php";

class UserManager {
    private $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function createUser()
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert(['nom' => 'hello', 'prenom' => 'test', 'email' => 'test@gmail.com']);
        $this -> $manager->executeBulkWrite('db_php_forum.users', $bulk);
    }

    public function updateUser()
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update(
            ['prenom' => 'hello'],
            ['nom' =>'test']
        );
        $this -> $manager->executeBulkWrite('db_php_forum.users', $bulk);

    }

    public function deleteUser()
    {
        $collection = $this->manager->suplblog->post;
        return $collection->find( [ 'id' => '1' ] );;

    }
}
