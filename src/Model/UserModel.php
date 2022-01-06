<?php

include_once "connection.php";

class UserModel {
    private $manager;
    private $collection = "Suplblog.User";

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function getOneByOID($oid){
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
}
