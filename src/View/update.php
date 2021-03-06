<?php include_once "../src/View/Component/aside.php"; ?>

<main class="bg-zinc-700">
    <div class="flex p-4 bg-zinc-800 md:hidden">
        <img class="burger block mr-4" src="../src/static/img/icon-burger-white.svg" alt="avatar" width="30" height="20" loading="lazy">
        <p class="flex items-center">
            Update your profile
        </p>
    </div>
    <div class="p-4 overflow-auto h-full">
        <div>
            <div>
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 font-bold text-white">Profile</h3>
                <p class="mt-1 text-sm text-gray-500">
                    This information will be displayed publicly so be careful what you share.
                </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="#" method="POST" enctype='multipart/form-data'>
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-zinc-800 space-y-6 sm:p-6">
                        <div class="grid grid-cols-3 gap-6">
                            <div class="col-span-3 sm:col-span-2">
                            <label for="email-adress-icon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Email</label>
                                <div class="relative mt-1">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                                    </div>
                                <input type="text" id="email" name="email" class="w-80 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full pl-10 p-2.5  dark:dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="<?= $_SESSION['email'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-200 dark:text-gray-300">Your password</label>
                        <input type="password" id="password" name="password" class=" w-80 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark: dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-600" placeholder="?????????????????????" required>
                    </div>
                    <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Username</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-zinc-800 rounded-l-md border border-r-0 border-gray-300 dark:bg-zinc-600 dark:text-gray-400 dark:border-gray-600">
                        @
                        </span>
                        <input type="text" id="username" name="username" class="w-80 rounded-none rounded-r-lg bg-white border border-gray-300 text-gray-900  block flex-1 min-w-0 text-sm border-gray-300 p-2.5  dark:dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-600" placeholder="<?= $_SESSION['username'] ?>" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white">
                        Photo
                        </label>
                        <div class="mt-1 flex items-center">
                        <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                        <img
                            src="<?php if (isset($_SESSION["avatar"])) {
                                echo $_SESSION["avatar"];
                                } else {
                                 echo "../src/static/img/default-avatar.png";
                            } ?>" 
                            alt="avatar <?= $user["user"]["username"] ?>"
                            width="100"
                            height="100"
                            loading="lazy">
                        </span>
                        
                        <input name="fileToUpload" id="fileToUpload" class="text-sm ml-4 text-gray-900 bg-gray-50 rounded-lg border border-gray-300" aria-describedby="user_avatar_help" type="file" required>

                        </div>
                    </div>

                    <div class="px-4 py-3 bg-zinc-800 text-right sm:px-6">
                    <div class="flex justify-center"><?php
                    if(isset($successUpdate)) {
                ?>
                    <span class="bg-green-600 p-4 rounded-sm text-center"><?= $successUpdate ?></span>
                <?php
                }
                ?></div>
                    <button type="submit" name="update-profile" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                    </div>
                </div>
                </form>
            </div>
            </div>
        </div>
        <a class="px-4 py-2 w-full rounded-md bg-red-700 mt-4 flex items-center justify-center" href="/licence13/PHP-Forum/src/index.php?mod=user&action=logout">D??connexion</a>
    </div>
</main>