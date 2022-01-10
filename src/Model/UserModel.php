<?php

class UserModel {
    private $manager;
    private $collection = "Suplblog.User";

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function getAll()
    {
        $filter  = [];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $allResults = [];

        foreach ($cursor as $document) {
            $result = ["user"=>[]];
            $user = json_decode(json_encode($document), true);
            $result["user"] = $user;

            array_push($allResults, $result);
        }
        return $allResults;
    }

    public function getOneByOID($oid)
    {
        $filter  = ["_id"=>new MongoDB\BSON\ObjectID($oid)];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $result = null;

        foreach ($cursor as $document) {
            $user = json_decode(json_encode($document), true);
            $result = $user;
        }

        return $result;
    }

    public function getOneByEmail($email)
    {
        $filter  = ["email"=>$email];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $result = null;

        foreach ($cursor as $document) {
            $user = json_decode(json_encode($document), true);
            $result = $user;
        }

        return $result;
    }

    public function getOneByUsername($username)
    {
        $filter  = ["username"=>$username];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $result = null;

        foreach ($cursor as $document) {
            $user = json_decode(json_encode($document), true);
            $result = $user;
        }

        return $result;
    }

    public function insertUser($data)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $test = $bulk->insert($data);
        if ($test == NULL) {
            return false;
        }
        $this->manager->executeBulkWrite('Suplblog.User', $bulk);
        return true;
    }

    public function updateUser($data)
    {
        $bulk = new MongoDB\Driver\BulkWrite;

        try {
            $test = $bulk->update(
                ['_id' => new MongoDB\BSON\ObjectId($data['user_id'])],
                ['$set' => ['email' => $data['email'], 'username' => $data['username'], 'password' => $data['password'], 'avatar' => $data['avatar']]]
            );
        } catch (MongoDB\Driver\InvalidArgumentException $e) {
            
        }
       
        $this->manager->executeBulkWrite('Suplblog.User', $bulk);
        return true;
    }
}
