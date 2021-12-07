<?php
    include_once "config.php";

    class Connection {
        private $db;

        public function __construct() {
            try {
                $this->db = new MongoDB\Driver\Manager(URI_MONGODB_SERV);
                echo "Connection to database successfully";
            }
            catch (Throwable $e) {
                echo "Captured Throwable for connection : " . $e->getMessage() . PHP_EOL;
            }
        }
    }
?>