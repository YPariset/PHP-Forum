<?php
    include_once "./src/config.php";

    class Connection {
        private $manager;

        public function __construct() {
            try {
                $this->manager = new MongoDB\Driver\Manager(URI_SERVER);;
            } catch (Throwable $e) {
                echo $e->getMessage();
            }
        }

        public function getManager(){
            return $this->manager;
        }
    }