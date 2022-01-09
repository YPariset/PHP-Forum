<?php
    include_once "connection.php";
    include_once "./Model/PostModel.php";
    include_once "./Model/UserModel.php";
    
    class PostController {
        private $manager;
        private $model;
        private $userModel;
    
        public function __construct($manager)
        {
            $this->manager = $manager;
            $this->model = new PostModel($this->manager);
            $this->userModel = new UserModel($this->manager);

            if(isset($_GET["action"])) {
                $action = $_GET["action"];
            } else {
                header("Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=post&action=home");
            }
            
            switch ($action) {
                case 'home':
                    $posts = $this->model->getAll();
                    $users = $this->userModel->getAll();
                    if (isset($_GET["response"])){
                        $postToRespond =  $this->model->getOneByOID($_GET["response"]);
                        var_dump($postToRespond);
                        if ($postToRespond == NULL) {
                            header("Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=post&action=home");
                        }
                    }
                    require "./View/post-view.php";
                    break;

                case 'user':
                    $posts = $this->model->getAllByUserOID($_GET["oid"]);
                    $users = $this->userModel->getAll();
                    require "./View/post-view.php";
                    break;

                case 'post':


                default:
                    echo "Action doesn't exist or you don't have the rights !";
                    break;
            }
        }
    }