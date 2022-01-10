<aside class="h-screen absolute top-0 left-0 translate-x-full-invert transition-all duration-200 ease-in-out md:translate-x-0 z-10 md:relative">
    <div class="aside__users__container bg-zinc-800 p-2 overflow-hidden">
        <a
            <?php
                if(isset($_GET["oid"])){
                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md transition-all duration-150 ease-in-out hover:bg-zinc-700 hover:transition-all hover:duration-150 hover:ease-in-out"';
                } else {

                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md bg-zinc-700 transition-all duration-150 ease-in-out hover:bg-zinc-500 hover:transition-all hover:duration-150 hover:ease-in-out"';
                }
            ?>
            href="index.php?mod=post&action=home">  
            <div class="icon-wrapper flex items-center mr-3">
                <img class="mx-auto" src="./src/static/img/icon-all-white.svg" alt="all icon" width="20" height="20" loading="lazy">
            </div>  
            <p>All</p>
        </a>
<?php
    foreach ($users as $user) {
        if ($user["user"]["_id"]['$oid'] != $_SESSION["oid"]) {
?>
        <a
            <?php
                if(isset($_GET["oid"]) && $_GET["oid"]== $user["user"]["_id"]['$oid']){
                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md bg-zinc-700 transition-all duration-150 ease-in-out hover:bg-zinc-500 hover:transition-all hover:duration-150 hover:ease-in-out"';
                } else {
                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md transition-all duration-150 ease-in-out hover:bg-zinc-700 hover:transition-all hover:duration-150 hover:ease-in-out"';
                }
            ?>
            href="index.php?mod=post&action=user&oid=<?= $user["user"]["_id"]['$oid'] ?>">
            <img class="mr-3 rounded-full" 
                src="<?= isset($user["user"]["avatar"]) ? $user["user"]["avatar"] : "./src/static/img/default-avatar.png" ?>" 
                alt="avatar <?= $user["user"]["username"] ?>"
                width="30"
                height="30"
                loading="lazy">
            <p class="text-sm text-zinc-100"><?= $user["user"]["username"] ?></p>
        </a>
<?php
        }
    }
?>
    </div>

    <div class="aside__bottom flex justify-between items-center bg-zinc-900 px-4">
        <div class="flex items-center">
            <img class="mr-3 rounded-full" 
                src="<?= isset($_SESSION["avatar"]) ? $_SESSION["avatar"] : "./src/static/img/default-avatar.png" ?>"
                width="30"
                height="30"
                loading="lazy">
            <div>
                <p class="text-sm text-zinc-100 font-bold"><?= $_SESSION["username"] ?></p>
                <p class="text-xs uppercase font-thin text-zinc-300">#<?= substr($_SESSION["oid"], 0, 4) ?></p>
            </div>
        </div>
        <a class="hover:opacity-50" href="index.php?mod=post&action=update-profile">
            <img src="./src/static/img/icon-settings-white.svg" alt="Settings" height="30" width="30">
        </a>
    </div>
</aside>