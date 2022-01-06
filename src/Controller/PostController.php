<?php
    include_once "connection.php";
    include_once "./Model/PostModel.php";
    include_once "./Model/UserModel.php";
    include_once "./Model/ResponseModel.php";
    
    class PostController {
        private $manager;
        private $model;
        private $userModel;
        private $responseModel;
    
        public function __construct($manager)
        {
            $this->manager = $manager;
            $this->model = new PostModel($this->manager);
            $this->userModel = new UserModel($this->manager);
            $this->responseModel = new ReponseModel($this->manager);

            if(isset($_GET["action"])) {
                $action = $_GET["action"];
            } else {
                $_GET["action"] = "home";
                $action = "home";
            }
            
            switch ($action) {
                case 'home':
                    $posts = $this->model->getAll();
                    // include_once "./View/forum.php";
                    foreach ($posts as $post) {
                        $post["user"] = $this->userModel->getOneByOID($post["post"]["user_id"]['$oid']);
                        $date = date("Y-m-d H:i:s",($post["post"]["created_at"]['$date']['$numberLong'] / 1000));
                        echo '<img src="'.$post["user"]["avatar"].'" width="20" height="20">'."<p>".$post["user"]["username"]." (".$date.")</p>";
                        echo "<p>".$post["post"]["content"]."</p>";
                        echo '<a href="/licence13/PHP-Forum/src/index.php?mod=post&action=post&oid='.$post["post"]["_id"]['$oid'].'">See reponse(s)...</a><br>';
                    }
                    break;

                case 'post':
                    $res = $this->model->getOneByOID($_GET["oid"]);
                    $res["user"] = $this->userModel->getOneByOID($res["post"]["user_id"]['$oid']);
                    $date = date("Y-m-d H:i:s",($res["post"]["created_at"]['$date']['$numberLong'] / 1000));
                    echo '<img src="'.$res["user"]["avatar"].'" width="20" height="20">'."<p>".$res["user"]["username"]." (".$date.")</p>";
                    echo "<p>".$res["post"]["content"]."</p><br>";
                    $responses = $this->responseModel->getAllByPostOID($res["post"]["_id"]['$oid']);
                    foreach ($responses as $response) {
                        $response["user"] = $this->userModel->getOneByOID($response["response"]["user_id"]['$oid']);
                        $date = date("Y-m-d H:i:s",($response["response"]["created_at"]['$date']['$numberLong'] / 1000));
                        echo '<img src="'.$response["user"]["avatar"].'" width="20" height="20">'."<p>".$response["user"]["username"]." (".$date.")</p>";
                        echo "<p>".$response["response"]["content"]."</p><br>";
                        $nextResponses = $this->responseModel->getAllByResponseOID($response["response"]["_id"]['$oid']);
                        if(count($nextResponses) > 0) { $this->getResponsesOfResponse ($nextResponses); }
                    }
                    break;

                default:
                    echo "Action doesn't exist or you don't have the rights !";
                    break;
            }
        }

        private function getResponsesOfResponse($responses) 
        {
            foreach ($responses as $response) {
                $response["user"] = $this->userModel->getOneByOID($response["response"]["user_id"]['$oid']);
                $date = date("Y-m-d H:i:s",($response["response"]["created_at"]['$date']['$numberLong'] / 1000));
                echo '<img src="'.$response["user"]["avatar"].'" width="20" height="20">'."<p>".$response["user"]["username"]." (".$date.")</p>";
                echo "<p>".$response["response"]["content"]."</p><br>";
                $nextResponses = $this->responseModel->getAllByResponseOID($response["response"]["_id"]['$oid']);
                if(count($nextResponses) > 0) { $this->getResponsesOfResponse($nextResponses); }
            }
        }
    }