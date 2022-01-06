<?php

class PostManager {
    private $collection;

    /**
     * @param $collection
     */
    public function __construct($db)
    {
        $this->collection = $db->Post;
    }

    public function getAll(){
        return $this->collection->find(['id' => 1]);
    }
}