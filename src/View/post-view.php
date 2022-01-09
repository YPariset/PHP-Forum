<?php include_once "../src/View/Component/aside.php"; ?>

<main class="bg-zinc-700 h-screen">
    <div class="main__responses__wrapper p-4 overflow-auto">
<?php
    foreach ($posts as $post) {
        $post["user"] = $this->userModel->getOneByOID($post["post"]["user_id"]['$oid']);
        $date = date("Y-m-d H:i:s",($post["post"]["created_at"]['$date']['$numberLong'] / 1000));
        $responseTo = NULL;
        if(isset($post["post"]["post_id"])) {
            $responseTo = $this->model->getOneByOID($post["post"]["post_id"]['$oid']);
            $responseTo["user"] = $this->userModel->getOneByOID($responseTo["post"]["user_id"]['$oid']);
?>
        <div class="response__wrapper mb-2">
            <div class="response__thread">
                <span class="border-t-2 border-l-2 border-zinc-500 w-full h-full block"></span>
            </div>
            <div class="flex items-center">
                <img class="rounded-full mr-2"
                    src="<?php if (isset($responseTo["user"]["avatar"])) {
                        echo $responseTo["user"]["avatar"];
                    } else {
                        echo "../src/static/img/default-avatar.png";
                    } ?>"
                    alt="avatar <?= $responseTo["user"]["username"] ?>"
                    width="20"
                    height="20"
                    loading="lazy">
                <a class="mr-2 text-xs opacity-50" href="">@<?= $responseTo["user"]["username"] ?></a>
                <p class="text-xs opacity-50"><?= $responseTo["post"]["content"] ?></p>
            </div>
        </div>
<?php
        }
?>
        <div class="post__wrapper">
            <img class="rounded-full"
                src="<?php if (isset($post["user"]["avatar"])) {
                    echo $post["user"]["avatar"];
                } else {
                    echo "../src/static/img/default-avatar.png";
                } ?>"
                alt="avatar <?= $post["user"]["username"] ?>"
                width="50"
                height="50"
                loading="lazy">
            <div>
                <div class="flex items-end">
                    <p class="font-bold mr-2"><?= $post["user"]["username"] ?></p>
                    <p class="post__date text-xs font-thin opacity-40"><?= $date ?></p>
                </div>
                <p><?= $post["post"]["content"] ?></p>
            </div>
        </div>
<?php
    }
?>
    </div>

<?php
    if (isset($_GET["response"])) {
?>
    <div class="p-2">
        <form class="response_form bg-zinc-600 flex rounded-md" action="index.php?mod=post&action=post&post=<?= isset($_GET["response"]) ?>" method="post">
            <input class="p-2 bg-transparent border-0 outline-none focus:outline-none" type="text" name="post" placeholder="Envoyer un post">
            <button class="send-btn flex justify-center items-center" type="submit" name="response">
                <img src="../src/static/img/icon-send-white.svg" alt="Send" width="20" height="20" loading="lazy">
            </button>
        </form>
    </div>
<?php  
    } else if (!isset($_GET["response"])) {
?>
    <div class="p-2">
        <form class="response_form bg-zinc-600 flex rounded-md" action="index.php?mod=post&action=post" method="post">
            <input class="p-2 bg-transparent border-0 outline-none focus:outline-none" type="text" name="post" placeholder="Envoyer un post">
            <button class="send-btn flex justify-center items-center" type="submit" name="post">
                <img src="../src/static/img/icon-send-white.svg" alt="Send" width="20" height="20" loading="lazy">
            </button>
        </form>
    </div>
<?php
    }
?>
</main>