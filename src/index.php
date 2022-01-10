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
                    },
                    borderRadius: {
                        'md-bottom': '0 0 0.375rem 0.375rem',
                        'md-top': '0.375rem 0.375rem 0 0',
                    },
                    translate: {
                        'full-invert': '-100%',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="./static/css/style.css">
    <title>Suplblog</title>
</head>
<body class="h-screen relative md:grid">
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
            header("Location: https://www.projet-web-training.ovh/licence13/PHP-Forum/src/index.php?mod=post&action=home");
            break;
    }
?>
        <script>
            let wrapper = document.querySelector(".main__responses__wrapper");
            if (wrapper) {
                wrapper.scrollTo(0,wrapper.scrollHeight);
            }

            let burger = document.querySelector("img.burger");
            if (burger) {
                let aside = document.querySelector("aside");
                let main = document.querySelector("main");
                burger.addEventListener("click", ()=>{
                    main.classList.toggle("active");
                    aside.classList.toggle("active");
                });
            }
        </script>
    </body>
</html>