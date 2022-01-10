<main class="col-span-2 bg-characterBackground">
    <div class="flex items-center justify-center h-full">
        <div class="h-full w-full md:flex md:justify-center md:items-center md:w-form md:h-max bg-zinc-700 p-6 md:rounded-lg md:shadow-lg">
            <div class="grid gap-4 w-full mt-10 md:mt-0">
                <h3 class="w-full text-center text-xl text-bold text-zinc-200">Welcome !</h3>
                <p class="w-full text-center text-zinc-300">I'm glad to see you here</p>
                <form id="login" class="grid gap-4" action="/licence13/PHP-Forum/src/index.php?mod=user&action=login" method="post">
                    <div class="grid gap-2">
                        <label class="uppercase text-zinc-400 text-sm" for="email">Email</label>
                        <input class="w-full bg-zinc-800 border border-zinc-900 rounded-sm p-2 focus:border focus:border-sky-500" type="email" id="email" name="email" required/>
                    </div>

                    <div class="grid gap-2">
                        <label class="uppercase text-zinc-400 text-sm" for="password">Password</label>
                        <input class="w-full bg-zinc-800 border border-zinc-900 rounded-sm p-2 focus:border focus:border-sky-500" type="password" id="password" name="password" required/>
                    </div>
                    
                    <button class="w-full bg-zinc-700 bg-sky-600 transition-all duration-150 ease-in-out hover:bg-sky-500 hover:transition-all hover:duration-150 hover:ease-in-out border border-zinc-800 rounded-sm p-2" type="submit" name="login">Login</button>
                </form>
                <span class="flex items-center text-md text-thin text-zinc-600">
                    Need an account ?
                    <a class="ml-2 text-sky-600 transition-all duration-150 ease-in-out hover:text-sky-500 hover:transition-all hover:duration-150 hover:ease-in-out " href="/licence13/PHP-Forum/src/index.php?mod=user&action=signup">Sign up</a>
                </span>
<?php
    if(isset($emailError)) {
?>
                <span class="bg-red-600 p-4 rounded-sm text-center"><?= $emailError ?></span>
<?php   
    }

    if(isset($passwordError)) {
?>
                <span class="bg-red-600 p-4 rounded-sm text-center"><?= $passwordError ?></span>
<?php   
    }
?>
                
            </div>
        </div>
    </div>
</main>
