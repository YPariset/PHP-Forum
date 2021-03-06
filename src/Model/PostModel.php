<?php

class PostModel {
    private $manager;
    private $collection = "Suplblog.Post";

    /**
     * @param $collection
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function getAll(){
        $filter  = [];
        $options = ['sort'=>array('created_at'=>1)];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $allResult = [];

        foreach ($cursor as $document) {
            $post = json_decode(json_encode($document), true);
            $result = ["post"=>$post, "user"=>[]];
            array_push($allResult, $result);
        }
        return $allResult;
    }

    public function getAllByUserOID($userOid){
        $filter  = ["user_id"=>new MongoDB\BSON\ObjectID($userOid)];
        $options = ['sort'=>array('created_at'=>1)]; 

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $allResult = [];

        foreach ($cursor as $document) {
            $post = json_decode(json_encode($document), true);
            $result = ["post"=>$post, "user"=>[]];
            array_push($allResult, $result);
        }
        return $allResult;
    }

    public function getOneByOID($oid){
        $filter  = ["_id"=>new MongoDB\BSON\ObjectID($oid)];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $result = ["post"=>[], "user"=>[]];

        foreach ($cursor as $document) {
            $post = json_decode(json_encode($document), true);

            $result["post"] = $post;
        }

        return $result;
    }

    public function insertPost($data)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $test = $bulk->insert($data);
        if ($test == NULL) {
            return false;
        }
        $this->manager->executeBulkWrite($this->collection, $bulk);
        return true;
    }
}