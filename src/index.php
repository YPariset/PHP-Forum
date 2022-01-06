<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            $mod = "post";
        }

        switch ($mod) {
            case 'post':
                include_once "/Controller/PostManager.php";
                $controler = new PostManager($manager);
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