<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['Submit'])) {
  # Check if passwords are matching
  $data                   = new stdClass();
  $data->email            = $_POST['email'];
  $data->username         = $_POST['username'];
  $data->password         = hash('sha256', ($_POST['password']));
  $password_confirm       = hash('sha256',($_POST['password_confirm']));
  if( $data->email != null || $data->password != null || $password_confirm != null) {
    // if confirm password is equal to password user
    if( $data->password == $password_confirm) {
      $mng = new MongoDB\Driver\Manager("mongodb+srv://Parizoo:Mareil95850@cluster0.ackwg.mongodb.net/test?authSource=admin&replicaSet=atlas-xfzeox-shard-0&readPreference=primary&appname=MongoDB%20Compass&ssl=true");
      $aleatoire = rand(1, 20000);
      $_id = $aleatoire;
      $bulk = new MongoDB\Driver\BulkWrite;
      $user_test = ['email' => $data->email,
                    'username' => $data->username,
                    'password' => $data->password,
                    'user_id' => $_id
                  ];
      $_id3 = $bulk->insert($user_test);
      $result = $mng->executeBulkWrite('Suplblog.User', $bulk);
      $success_msg ="Your account is now created";
    } else {
      $error_msg = "Password doesn't matching";
    }
  } else {
      $error_msg ="Please, be focus !";
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
                      <a class="bi bi-arrow-left-circle-fill" href="login.php"></a>
                      <h2>Registration <span class="emoji">🕺</span></h2>

                      <form method="post" action="" class="custom-form">

                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" name="email" value="" id="email" class="form-control" required />
                        </div>

                        <div class="form-group">
                          <label for="username">Username</label>
                          <input type="username" name="username" value="" id="username" class="form-control" required />
                        </div>

                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" name="password" id="password" class="form-control" required />
                        </div>

                        <div class="form-group">
                          <label for="password_confirm">Confirm password</label>
                          <input type="password" name="password_confirm" id="password_confirm" class="form-control" required />
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="d-flex justify-content-center ptop">
                              <input type="submit" name="Submit" class="btn btn-block" />
                            </div>
                          </div>
                        </div>
                      </form>
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

