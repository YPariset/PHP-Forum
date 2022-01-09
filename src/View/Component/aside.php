<aside class="bg-zinc-800 h-screen">
    <div class="aside__users__container p-2 overflow-hidden">
        <a
            <?php
                if(isset($_GET["oid"])){
                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md transition-all duration-150 ease-in-out hover:bg-zinc-700 hover:transition-all hover:duration-150 hover:ease-in-out"';
                } else {

                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md bg-zinc-700 transition-all duration-150 ease-in-out hover:bg-zinc-500 hover:transition-all hover:duration-150 hover:ease-in-out"';
                }
            ?>
            href="/licence13/PHP-Forum/src/index.php?mod=post&action=home">  
            <div class="icon-wrapper flex items-center mr-3">
                <img class="mx-auto" src="../src/static/img/icon-all-black.svg" alt="all icon" width="20" height="20" loading="lazy">
            </div>  
            <p>All</p>
        </a>
<?php
    foreach ($users as $user) {
?>
        <a
            <?php
                if(isset($_GET["oid"]) && $_GET["oid"]== $user["user"]["_id"]['$oid']){
                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md bg-zinc-700 transition-all duration-150 ease-in-out hover:bg-zinc-500 hover:transition-all hover:duration-150 hover:ease-in-out"';
                } else {
                    echo 'class="user__wrapper flex items-center px-2 py-1 rounded-md transition-all duration-150 ease-in-out hover:bg-zinc-700 hover:transition-all hover:duration-150 hover:ease-in-out"';
                }
            ?>
            href="/licence13/PHP-Forum/src/index.php?mod=post&action=post&oid=<?= $user["user"]["_id"]['$oid'] ?>">
            <img class="mr-3 rounded-full" 
                src="<?php if (isset($user["user"]["avatar"])) {
                    echo $user["user"]["avatar"];
                } else {
                    echo "../src/static/img/default-avatar.png";
                } ?>" 
                alt="avatar <?= $user["user"]["username"] ?>"
                width="30"
                height="30"
                loading="lazy">
            <p class="text-sm text-zinc-100"><?= $user["user"]["username"] ?></p>
        </a>
<?php
    }
?>
    </div>
    
    <a class="aside__bottom flex justify-between items-center w-full bg-zinc-900 px-4" href="">
        <div class="flex items-center">
            <img class="mr-3 rounded-full" 
                src="<?php if (isset($_SESSION["avatar"])) {
                    echo $_SESSION["avatar"];
                } else {
                    echo "../src/static/img/default-avatar.png";
                } ?>" 
                alt="avatar <?= $_SESSION["username"] ?>"
                width="30"
                height="30"
                loading="lazy">
            <div>
                <p class="text-sm text-zinc-100 font-bold"><?= $_SESSION["username"] ?></p>
                <p class="text-xs uppercase font-thin text-zinc-300">#<?= substr($_SESSION["oid"], 0, 4) ?></p>
            </div>
        </div>
        <img src="../src/static/img/icon-settings-white.svg" alt="Settings" height="30" width="30">
    </a>
</aside>