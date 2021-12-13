<?php
    include_once "config.php";

    class Connection {
        private $db;

        public function __construct() {
            try {
                $this->db = new MongoDB\Driver\Manager(URI_SERVER);
            }
            catch ( MongoDB\Driver\Exception\Exception $e )
            {
                echo "Probleme! : ".$e->getMessage();
                exit();
            }
        }

        public function getDB(){
            return $this->db;
        }
    }