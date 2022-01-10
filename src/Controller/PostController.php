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
                header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
            }
            
            switch ($action) {
                case 'home':
                    $posts = $this->model->getAll();
                    $users = $this->userModel->getAll();
                    if (isset($_GET["response"])){
                        $reponseTestOID = preg_match('/^[0-9A-Fa-f]{24}$/', $_GET['response']);
                        if ($reponseTestOID) {
                            $postToRespond =  $this->model->getOneByOID($_GET["response"]);
                            if ($postToRespond == NULL) {
                                header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
                            }
                            $postToRespond["user"] = $this->userModel->getOneByOID($postToRespond["post"]["user_id"]['$oid']);
                        } else {
                            header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
                        }
                    }
                    include_once "./View/post-view.php";
                    break;

                case 'user':
                    if (isset($_GET["oid"])) {
                        $oidPossible = preg_match('/^[0-9A-Fa-f]{24}$/', $_GET['oid']);
                        if ($oidPossible) {
                            $user = $this->userModel->getOneByOID($_GET["oid"]);
                            if($user == NULL) {
                                header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
                            }
                        } else {
                            header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
                        }
                    } else {
                        header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
                    }
                    $posts = $this->model->getAllByUserOID($_GET["oid"]);
                    $users = $this->userModel->getAll();
                    if (isset($_GET["response"])){
                        $reponseTestOID = preg_match('/^[0-9A-Fa-f]{24}$/', $_GET['response']);
                        if ($reponseTestOID) {
                            $postToRespond =  $this->model->getOneByOID($_GET["response"]);
                            if ($postToRespond == NULL) {
                                header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=user&oid=".$_GET["oid"]);
                            }
                            $postToRespond["user"] = $this->userModel->getOneByOID($postToRespond["post"]["user_id"]['$oid']);
                        } else {
                            header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=user&oid=".$_GET["oid"]);
                        }
                    }
                    include_once "./View/post-view.php";
                    break;
                    
                case 'update-profile':
                    $posts = $this->model->getAll();
                    $users = $this->userModel->getAll();
                    $user = $this->userModel->getOneByOID($_SESSION["oid"]);

                    if ($user != NULL) {
                        if (isset($_POST['update-profile'])) { 

                            $data                   = new stdClass();
                            $data->email            = $_POST['email'];
                            $data->username         = $_POST['username'];
                            $data->password         = hash('sha256', ($_POST['password']));

                            $destination_path = "./static/img/";
                            $target_path = $destination_path . basename( $_FILES["fileToUpload"]["name"]);

                            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_path);

                            $path = $target_path;
                            $type = pathinfo($path, PATHINFO_EXTENSION);
                            $img = file_get_contents($path);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);    

                            $data->avatar = $base64;

                            $_id = $_SESSION['oid'];
                            $user = ['email' => $data->email,
                                            'username' => $data->username,
                                            'password' => $data->password,
                                            'user_id' => $_id,
                                            'avatar' => $data->avatar
                                        ];
                            $updated = $this->userModel->updateUser($user);

                            $_SESSION['username'] = $user['username'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['avatar'] = $user['avatar'];

                            $successUpdate = "Successfully updated";
                        }
                    }   
                    require "./View/update.php";
                    break;    

                case 'post':
                    if (isset($_GET["response"])) {
                        $data = [
                            "content"=>htmlspecialchars($_POST["post"]),
                            "created_at"=>new MongoDB\BSON\UTCDateTime((new DateTime('NOW'))->getTimestamp()*1000),
                            "user_id"=>new MongoDB\BSON\ObjectID($_SESSION["oid"]),
                            "post_id"=>new MongoDB\BSON\ObjectID($_GET["response"])
                        ];
                    } else {
                        $data = [
                            "content"=>htmlspecialchars($_POST["post"]),
                            "created_at"=>new MongoDB\BSON\UTCDateTime((new DateTime('NOW'))->getTimestamp()*1000),
                            "user_id"=>new MongoDB\BSON\ObjectID($_SESSION["oid"])
                        ];
                    }
                    $this->model->insertPost($data);
                    header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
                    break;

                default:
                    header("Location: https://www.projet-web-training.ovh/licence19/Projects/PHP-Forum/src/index.php?mod=post&action=home");
                    break;
            }
        }
    }