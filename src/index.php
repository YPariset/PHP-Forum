<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    width: {
                        'form': '450px',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="./static/css/style.css">
    <title>Suplblog</title>
</head>
<body class="h-screen">
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
        header("Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=user&action=login");
    }

    switch ($mod) {
        case 'post':
            if (isset($_SESSION["oid"])) {
                include_once "./Controller/PostController.php";
                $controler = new PostController($manager);
            } else {
                header("Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=user&action=login");
            }
            break;
        
        case 'user':
            include_once "./Controller//UserController.php";
            $controler = new UserController($manager);
            break;
        
        default:
            echo "Mod doesn't exist or you don't have the rights to be here !";
            break;
    }
?>
        <script>
            let wrapper = document.querySelector(".main__responses__wrapper");
            if (wrapper) {
                wrapper.scrollTo(0,wrapper.scrollHeight);
            }
        </script>
    </body>
</html>