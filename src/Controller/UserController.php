<?php
    include_once "connection.php";
    include_once "./Model/UserModel.php";
    
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
                header("Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=user&action=login");
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
                                header("Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=post&action=home");
                            } else if ($user["password"] != hash('sha256', ($_POST['password']))) {
                                $passwordError = "Incorrect password";
                            }
                        } else {
                            $emailError = "There is no account with ".$_POST['email'];
                        }
                    }
                    include_once "./View/login.php";
                    break;

                case 'signup':
                    if (isset($_POST['signup'])) {
                        $userByEmail = $this->model->getOneByEmail($_POST['email']);
                        if ($userByEmail == NULL) {
                            $userByUsername = $this->model->getOneByEmail($_POST['username']);
                            if ($userByUsername == NULL) {
                                $passwordConfirm = preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/',$password)

                                if($uppercase || $lowercase || $number || strlen($_POST['password']) >= 8) {

                                } else {
                                    $passwordError = "Your";
                                }
                            } else {
                                $usernameError = "This username is already taken";
                            }
                        } else {
                            $emailError = "There is already an account with ".$_POST['email'];
                        }
                    }
                    // if (isset($_POST['Submit'])) {
                    //     # Check if passwords are matching
                    //     $data                   = new stdClass();
                    //     $data->email            = $_POST['email'];
                    //     $data->username         = $_POST['username'];
                    //     $data->password         = hash('sha256', ($_POST['password']));
                    //     $password_confirm       = hash('sha256',($_POST['password_confirm']));
                    //     if( $data->email != null || $data->password != null || $password_confirm != null) {
                    //       // if confirm password is equal to password user
                    //       if( $data->password == $password_confirm) {
                    //         $mng = new MongoDB\Driver\Manager("mongodb+srv://Parizoo:Mareil95850@cluster0.ackwg.mongodb.net/test?authSource=admin&replicaSet=atlas-xfzeox-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");
                    //         $aleatoire = rand(1, 20000);
                    //         $_id = $aleatoire;
                    //         $bulk = new MongoDB\Driver\BulkWrite;
                    //         $user_test = ['email' => $data->email,
                    //                       'username' => $data->username,
                    //                       'password' => $data->password,
                    //                       'user_id' => $_id
                    //                     ];
                    //         $_id3 = $bulk->insert($user_test);
                    //         $result = $mng->executeBulkWrite('Suplblog.User', $bulk);
                    //         $success_msg ="Your account is now created";
                    //       } else {
                    //         $error_msg = "Password doesn't matching";
                    //       }
                    //     } else {
                    //         $error_msg ="Please, be focus !";
                    //     }
                    // }
                    include_once "./View/signup.php";
                    break;
                
                case "logout":
                    session_destroy();
                    header('Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=post&action=home');
                    break;

                default:
                    echo "Action doesn't exist or you don't have the rights !";
                    break;
            }
        }
    }