<?php include_once "../src/View/Component/aside.php"; ?>

<main class="bg-zinc-700 h-screen">
    <div class="main__responses__wrapper <?= isset($postToRespond) ? "response" : "" ?> py-4 overflow-auto">
<?php
    foreach ($posts as $post) {
        $post["user"] = $this->userModel->getOneByOID($post["post"]["user_id"]['$oid']);
        $date = date("Y-m-d H:i:s",($post["post"]["created_at"]['$date']['$numberLong'] / 1000));
        if(isset($post["post"]["post_id"])) {
            $responseTo = $this->model->getOneByOID($post["post"]["post_id"]['$oid']);
            $responseTo["user"] = $this->userModel->getOneByOID($responseTo["post"]["user_id"]['$oid']);
        }
?>
        <div class="post__container <?= isset($responseTo) ? ($responseTo["user"]["_id"]['$oid'] == $_SESSION["oid"] ? "bg-yellow-600 border-l-2 border-yellow-500" : "") : "" ?>">
<?php
        if(isset($responseTo)) {
?>
            <div class="response__wrapper pt-1 px-4">
                <div class="response__thread">
                    <span class="border-t-2 border-l-2 border-zinc-500 w-full h-full block"></span>
                </div>
                <div class="flex items-center">
                    <img class="rounded-full mr-2"
                        src="<?= isset($responseTo["user"]["avatar"]) ? $responseTo["user"]["avatar"] : "../src/static/img/default-avatar.png" ?>"
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
            <div class="post__wrapper relative px-4 py-2 <?= isset($responseTo) ? ($responseTo["user"]["_id"]['$oid'] == $_SESSION["oid"] ? "hover:bg-yellow-700" : "hover:bg-zinc-800") : "hover:bg-zinc-800" ?>">
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
                <a class="response-btn absolute right-0 top-0 p-2 mr-4 bg-zinc-800 border border-zinc-700 hover:bg-zinc-900" href="/licence13/PHP-Forum/src/index.php?mod=post&action=<?= $_GET["action"] == "user" ? "user&oid=".$_GET["oid"] : "home" ?>&response=<?= $post["post"]["_id"]['$oid'] ?>">
                    <img src="../src/static/img/icon-response-white.svg" alt="Respond" width="15" height="10" loading="lazy">
                </a>
            </div>
        </div>
<?php
    }
?>
    </div>
    <div class="p-2">
<?php
    if (isset($postToRespond)) {
?>
        <div class="bg-zinc-900 px-4 py-2 rounded-md-top">
            <p class="text-zinc-400">Répondre à <span class="text-zinc-200"><?= $postToRespond["user"]["username"] ?></span> au post "<?= substr($postToRespond["post"]["content"], 0, 50) ?><?= strlen($postToRespond["post"]["content"]) > 50 ? "..." : "" ?>"</p>
        </div>
<?php
    }
?>
        <form class="response_form bg-zinc-600 p-2 flex <?= isset($postToRespond) ? "rounded-md-bottom" : "rounded-md" ?>" action="index.php?mod=post&action=post<?= isset($postToRespond["post"]["_id"]['$oid']) ? "&response=".$postToRespond["post"]["_id"]['$oid'] : "" ?>" method="post" required>
            <input class="p-2 bg-transparent border-0 outline-none focus:outline-none" type="text" name="post" placeholder="Envoyer un post" required>
            <button class="send-btn flex justify-center items-center" type="submit" name="response">
                <img src="../src/static/img/icon-send-white.svg" alt="Send" width="20" height="20" loading="lazy">
            </button>
        </form>
    </div>
</main>