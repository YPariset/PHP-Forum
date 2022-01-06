<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="./static/css/style.css">
    <link href="./static/lib/bootstrap-5.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="./static/lib/bootstrap-icons-1.5.0/bootstrap-icons.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Suplblog</title>
</head>
<body>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include_once "connection.php";
        $connection = new Connection();
        $manager = $connection->getManager();

        if(isset($_GET["mod"])) {
            $mod = $_GET["mod"];
        } else {
            $_GET["mod"] = "post";
            $mod = "post";
        }

        switch ($mod) {
            case 'post':
                include_once "./Controller/PostController.php";
                $controler = new PostController($manager);
                break;
            
            default:
                echo "Mod doesn't exist or you don't have the rights to be here !";
                break;
        }

        // $filter  = [];
        // $options = ['sort'=>array('_id'=>-1),'limit'=>3];

        // $query = new MongoDB\Driver\Query($filter, $options);

        // $cursor = $manager->executeQuery('Suplblog.Post', $query);

        // foreach ($cursor as $document) {
        //     var_dump($document);
        // }
    ?>
</body>
</html>