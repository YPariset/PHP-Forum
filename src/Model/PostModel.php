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
        $options = [];

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
}