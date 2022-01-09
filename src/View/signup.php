<main class="col-span-2 bg-characterBackground">
  <div class="flex items-center justify-center h-full">
    <div class="h-full w-full md:flex md:justify-center md:items-center md:w-form md:h-max bg-zinc-700 p-6 md:rounded-lg md:shadow-lg">
      <div class="grid gap-4 w-full mt-10 md:mt-0">
            <h2 class="w-full text-center text-xl text-bold text-zinc-200">Create an account</h2>
            <form id="signup" class="grid gap-4" method="post" action="/licence13/PHP-Forum/src/index.php?mod=user&action=login">
              <div class="grid gap-2">
                <label class="uppercase text-zinc-400 text-sm" for="email">Email</label>
                <input class="w-full bg-zinc-800 border border-zinc-900 rounded-sm p-2 focus:border focus:border-sky-500" type="email" name="email" value="" id="email" required/>
              </div>

              <div class="grid gap-2">
                <label class="uppercase text-zinc-400 text-sm" for="username">Username</label>
                <input class="w-full bg-zinc-800 border border-zinc-900 rounded-sm p-2 focus:border focus:border-sky-500" type="username" name="username" id="username" required/>
              </div>

              <div class="grid gap-2">
                <label class="uppercase text-zinc-400 text-sm" for="password">Password</label>
                <input class="w-full bg-zinc-800 border border-zinc-900 rounded-sm p-2 focus:border focus:border-sky-500" type="password" name="password" id="password" required/>
              </div>

              <button class="w-full bg-zinc-700 bg-sky-600 transition-all duration-150 ease-in-out hover:bg-sky-500 hover:transition-all hover:duration-150 hover:ease-in-out border border-zinc-800 rounded-sm p-2" type="submit" name="signup">Create account</button>
            </form>
            <a class="text-sky-600 transition-all duration-150 ease-in-out hover:text-sky-500 hover:transition-all hover:duration-150 hover:ease-in-out" href="/licence13/PHP-Forum/src/index.php?mod=user&action=login">Already have an account ?</a>
          </div>
      </div>
  </div>
</main>