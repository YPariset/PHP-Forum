<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['Submit'])) {
    $manager = new MongoDB\Driver\Manager("mongodb+srv://Parizoo:Mareil95850@cluster0.ackwg.mongodb.net/test?authSource=admin&replicaSet=atlas-xfzeox-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hash_password = hash('sha256', ($password));

    try {
        $query = new MongoDB\Driver\Query([]);
        $rows = $manager->executeQuery("Suplblog.User", $query);

        foreach ($rows as $row) {
            if($row->email == $email && $row->password == $hash_password) {
                // Set session
                $_SESSION['user_id'] = $row->user_id;
                $_SESSION['email'] = $row->email;
                $_SESSION['username'] = $row->username;
                header('Location: forum.php');
            } else {
                $error_msg = "Please be focus, try again !";
            }
        }
    } catch (MongoDB\Driver\Exception\Exception $e) {

        $filename = basename(__FILE__);

        echo "The $filename script has experienced an error.\n";
        echo "It failed with the following exception:\n";

        echo "Exception:", $e->getMessage(), "\n";
        echo "In file:", $e->getFile(), "\n";
        echo "On line:", $e->getLine(), "\n";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../static/css/style.css">
    <link href="../static/lib/bootstrap-5.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../static/lib/bootstrap-icons-1.5.0/bootstrap-icons.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid d-flex h-100 characterBackground">
        <div class="row align-self-center w-100">
            <div class="col-md-4 mx-auto auth-container">
                <div class="align-self-center d-flex justify-content-end">
                    <a class="bi bi-question-circle-fill" data-toggle="tooltip" title="Copyright © created with love and passion by Parizoo"></a>
                </div>
                <h3>Welcome !
                </h3>
                <p class="text-muted">I'm glad to see you here</p>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted small text-uppercase">Email</label>
                        <input type="email" class="form-control" id="email" name="email"/>
                    </div>
    
                    <div class="mb-3">
                        <label for="password" class="form-label text-muted small text-uppercase">Password</label>
                        <input type="password" class="form-control" id="password" name="password"/>
                    </div>
    
                    <div class="mb-3">
                        <button type="submit" name="Submit" class="btn btn-primary btn-lg btn-block w-100">Login</button>
                    </div>
    
                    <span class="d-flex pt-3 justify-content-center space">
                        Don't have an account ?  
                        <a class="pleft" href="signup.php">Sign up</a>
                    </span>
                </form>
                <br>
                <span class="error-msg alert-danger d-flex justify-content-center">
                 <?= isset($error_msg) ? $error_msg : null; ?>
                </span>
                <span class="success-msg alert-success d-flex justify-content-center">
                 <?= isset($success_msg) ? $success_msg: null; ?>
                </span>
            </div>
        </div>
    </div>
</body>
</html>