<?php

class ReponseModel {
    private $manager;
    private $collection = "Suplblog.Response";

    /**
     * @param $collection
     */
    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    public function getAllByPostOID($oid){
        $filter = ["post_id"=>new MongoDB\BSON\ObjectID($oid)];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $allResult = [];

        foreach ($cursor as $document) {
            $post = json_decode(json_encode($document), true);
            $result = ["response"=>$post, "user"=>[]];
            array_push($allResult, $result);
        }
        return $allResult;
    }

    public function getAllByResponseOID($oid){
        $filter = ["_id"=>['$ne'=>new MongoDB\BSON\ObjectID($oid)],"response_id"=>new MongoDB\BSON\ObjectID($oid)];
        $options = [];

        $query = new MongoDB\Driver\Query($filter, $options);

        $cursor = $this->manager->executeQuery($this->collection, $query);

        $allResult = [];

        foreach ($cursor as $document) {
            $post = json_decode(json_encode($document), true);
            $result = ["response"=>$post, "user"=>[]];
            array_push($allResult, $result);
        }
        return $allResult;
    }
}