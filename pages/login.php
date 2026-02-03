<?php
$appTitle = "AKAS | Login";
$baseUrl  = "/AKAS";
include "../includes/partials/head.php";
?>

<body class="min-h-screen bg-white">

<style>
  /* closer to the mock's LOGIN look */
  .login-title {
    font-family: ui-monospace, "Courier New", monospace;
    letter-spacing: .14em;
  }
</style>

<main class="min-h-screen flex items-center justify-center px-4 py-10">

  <!-- Outer frame -->
  <section class="w-full max-w-6xl rounded-[40px] overflow-visible shadow-xl border border-slate-100">
    <div class="grid grid-cols-1 lg:grid-cols-2 min-h-[560px]">

      <!-- LEFT (off-white) -->
      <div class="bg-[#FFFDF6] relative flex items-start justify-center pt-16 p-10">

        <!-- Logo -->
        <img
          src="<?php echo $baseUrl; ?>/assets/img/akas-logo.png"
          alt="AKAS Logo"
          class="w-80 max-w-full"
        />

        <!-- Doctor (overlapping) -->
        <img
          src="<?php echo $baseUrl; ?>/assets/img/doctor.png"
          alt="Doctor"
          class="hidden lg:block absolute -right-24 bottom-0 w-[360px] z-30 pointer-events-none"
        />
      </div>

      <!-- RIGHT (blue panel) -->
      <div class="relative flex items-center justify-center p-10 rounded-tl-[40px] rounded-bl-[40px]"
           style="background: #9ED9FB;"> <!-- matches your light blue -->

        <div class="w-full max-w-sm">

          <!-- Title -->
          <h1 class="login-title text-5xl font-semibold text-white mb-14 text-center">
            LOGIN
          </h1>

          <!-- Email -->
          <div class="relative mb-5">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-black/80">
              <!-- mail icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l9 6 9-6m-18 0v10a2 2 0 002 2h14a2 2 0 002-2V8m-18 0l9 6 9-6" />
              </svg>
            </span>

            <input
              type="email"
              placeholder="Email"
              class="w-full rounded-xl bg-white px-12 py-3 text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-white/60"
              required
            />
          </div>

          <!-- Password -->
          <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-black/80">
              <!-- lock icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 11V7a4 4 0 00-8 0v4m8 0h6a2 2 0 012 2v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7a2 2 0 012-2h6z" />
              </svg>
            </span>

            <input
              type="password"
              placeholder="Password"
              class="w-full rounded-xl bg-white px-12 py-3 text-slate-700 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-white/60"
              required
            />
          </div>

          <!-- Forgot -->
          <div class="mt-2">
            <a href="#" class="text-xs text-black/80 hover:underline">
              Forgot your password?
            </a>
          </div>

        </div>

        <!-- Doctor on mobile (center bottom) -->
        <img
          src="<?php echo $baseUrl; ?>/assets/img/doctor.png"
          alt="Doctor"
          class="lg:hidden absolute -left-6 bottom-0 w-[260px] opacity-95"
        />
      </div>

    </div>
  </section>

</main>

</body>
</html>
