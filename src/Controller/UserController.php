<?php
    include_once "./src/connection.php";
    include_once "./src/Model/UserModel.php";
    
    class UserController {
        private $manager;
        private $model;
    
        public function __construct($manager)
        {
            $this->manager = $manager;
            $this->model = new UserModel($this->manager);

            if(isset($_GET["action"])) {
                $action = $_GET["action"];
            } else {
                header("Location: http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."?mod=user&action=login");
            }
            
            switch ($action) {
                case 'login':
                    if (isset($_POST['login'])) {
                        $user = $this->model->getOneByEmail($_POST['email']);
                        if ($user != NULL) {
                            if ($user["password"] == hash('sha256', ($_POST['password']))) {
                                $_SESSION["oid"] = $user["_id"]['$oid'];
                                $_SESSION["email"] = $user["email"];
                                $_SESSION["password"] = $user["password"];
                                $_SESSION["username"] = $user["username"];
                                $_SESSION["admin"] = $user["admin"];
                                if (isset($user["avatar"])) {
                                    $_SESSION["avatar"] = $user["avatar"];
                                }
                                header("Location: http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."?mod=post&action=home");
                            } else if ($user["password"] != hash('sha256', ($_POST['password']))) {
                                $passwordError = "Incorrect password";
                            }
                        } else {
                            $emailError = "There is no account with ".$_POST['email'];
                        }
                    }
                    include_once "./src/View/login.php";
                    break;

                case 'signup':
                    if (isset($_POST['signup'])) {
                        $userByEmail = $this->model->getOneByEmail($_POST['email']);
                        if ($userByEmail == NULL) {
                            $userByUsername = $this->model->getOneByUsername($_POST['username']);
                            if ($userByUsername == NULL) {
                                $passwordConfirm = preg_match('/^(?=.*\d)(?=.*[@#\-\*\`\~\,\<\>\/_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-\*\`\~\,\<\>\/_$%^&+=§!\?]{8,50}$/', $_POST['password']);
                                if($passwordConfirm) {
                                    $passwordHashed = hash('sha256', ($_POST['password']));
                                    $data = [
                                        "email"=>$_POST['email'],
                                        "username"=>$_POST["username"],
                                        "password"=>$passwordHashed,
                                        "admin"=>false
                                    ];
                                    $created = $this->model->insertUser($data);
                                    if ($created) {
                                        $user = $this->model->getOneByEmail($_POST['email']);
                                        if ($user != NULL) {
                                            if(isset($_SESSION["oid"])) {
                                                session_destroy();
                                                session_start();
                                            }
                                            $_SESSION["oid"] = $user["_id"]['$oid'];
                                            $_SESSION["email"] = $user["email"];
                                            $_SESSION["password"] = $user["password"];
                                            $_SESSION["username"] = $user["username"];
                                            $_SESSION["admin"] = $user["admin"];
                                            header("Location: http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."?mod=post&action=home");
                                        } else {
                                            $error = "An error as occured, try later";
                                        }
                                    } else {
                                        $error = "An error as occured, try later";
                                    }
                                } else {
                                    $passwordError = 'Password must contain 8 characters with uppercase and downcase letters,numbers and at least one special character';
                                }
                            } else {
                                $usernameError = "This username is already taken";
                            }
                        } else {
                            $emailError = "There is already an account with ".$_POST['email'];
                        }
                    }
                    include_once "./src/View/signup.php";
                    break;
                
                case "logout":
                    session_destroy();
                    header("Location: http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."?mod=user&action=login");
                    break;

                default:
                    header("Location: http://".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]."?mod=post&action=home");
                    break;
            }
        }
    }