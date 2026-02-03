<?php
// includes/partials/navbar.php
if (!isset($baseUrl)) $baseUrl = "/AKAS";
?>

<a id="top"></a>

<!-- Back to Top -->
<button
  id="backToTop"
  class="flex items-center justify-center cursor-pointer hover:shadow-2xl transition-all text-white text-xl font-bold rounded-full"
  style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; width: 48px; height: 48px; background-color: var(--primary); border: 2px solid rgba(255,255,255,0.5); display: none; box-shadow: 0 4px 12px rgba(64, 183, 255, 0.4);">
  ↑
</button>

<nav class="bg-white shadow-sm py-3 sticky top-0 z-40">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex justify-between items-center">

      <!-- Brand -->
      <a href="<?php echo $baseUrl; ?>/index.php#top" class="flex items-center font-bold text-lg gap-2">
        AKAS
      </a>

      <!-- Desktop links -->
      <div class="hidden md:flex items-center gap-8">
        <ul class="flex gap-6">
          <li><a href="<?php echo $baseUrl; ?>/index.php#home" class="nav-link transition-colors">Home</a></li>
          <li><a href="<?php echo $baseUrl; ?>/index.php#about" class="nav-link transition-colors">About</a></li>
          <li><a href="<?php echo $baseUrl; ?>/index.php#clinics" class="nav-link transition-colors">Clinics</a></li>
          <li><a href="<?php echo $baseUrl; ?>/index.php#contact" class="nav-link transition-colors">Contact</a></li>
        </ul>

        <div class="flex gap-2">
          <a href="<?php echo $baseUrl; ?>/pages/login.php"
             class="px-6 py-2 rounded-full font-semibold text-white transition-all duration-300"
             style="background-color: var(--primary);">Login</a>

          <a href="<?php echo $baseUrl; ?>/pages/signup.php"
             class="px-6 py-2 rounded-full font-semibold text-white transition-all duration-300"
             style="background-color: var(--primary);">Sign Up</a>
        </div>
      </div>

      <!-- Mobile burger -->
      <div class="md:hidden flex items-center">
        <button id="burgerBtn"
                class="p-2 rounded-xl bg-white border border-gray-200 shadow-sm focus:outline-none"
                aria-label="Open menu"
                aria-controls="mobileMenu"
                aria-expanded="false">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

    </div>
  </div>
</nav>

<!-- ✅ MOBILE MENU (reference-style) -->
<div id="mobileMenu"
     class="fixed inset-0 z-50 hidden"
     aria-hidden="true">

  <!-- Backdrop -->
  <div id="mobileBackdrop" class="absolute inset-0 bg-black/40"></div>

  <!-- Panel -->
  <div class="relative h-full w-full bg-white flex flex-col">

    <!-- Top bar -->
    <div class="h-16 px-4 flex items-center justify-between"
         style="background: var(--primary);">
      <button id="closeMenu"
              class="h-10 w-10 rounded-full flex items-center justify-center text-white/90 hover:text-white"
              aria-label="Close menu">
        ✕
      </button>

      <div class="text-white font-extrabold tracking-wide">AKAS</div>

      <!-- spacer (keeps title centered) -->
      <div class="h-10 w-10"></div>
    </div>

    <!-- Menu list -->
    <div class="px-6 pt-6 flex-1 overflow-auto">
      <div class="text-slate-900 font-extrabold text-2xl mb-4">Menu</div>

      <div class="divide-y divide-slate-200/80 rounded-2xl border border-slate-200/80 overflow-hidden">
        <a href="<?php echo $baseUrl; ?>/index.php#home" class="mobileLink flex items-center justify-between px-5 py-5 text-lg font-semibold">
          Home
          <span class="text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
            </svg>
          </span>
        </a>

        <a href="<?php echo $baseUrl; ?>/index.php#about" class="mobileLink flex items-center justify-between px-5 py-5 text-lg font-semibold">
          About
          <span class="text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
            </svg>
          </span>
        </a>

        <a href="<?php echo $baseUrl; ?>/index.php#clinics" class="mobileLink flex items-center justify-between px-5 py-5 text-lg font-semibold">
          Clinics
          <span class="text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
            </svg>
          </span>
        </a>

        <a href="<?php echo $baseUrl; ?>/index.php#contact" class="mobileLink flex items-center justify-between px-5 py-5 text-lg font-semibold">
          Contact
          <span class="text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
            </svg>
          </span>
        </a>
      </div>
    </div>

    <!-- Bottom actions (Login / Sign Up) -->
    <div class="px-6 pb-8 pt-4 border-t border-slate-200">
      <div class="grid grid-cols-1 gap-3">
        <a href="<?php echo $baseUrl; ?>/pages/login.php"
           class="w-full text-center rounded-2xl py-3 font-extrabold text-white"
           style="background: var(--secondary);">
          Login
        </a>
        <a href="<?php echo $baseUrl; ?>/pages/signup.php"
           class="w-full text-center rounded-2xl py-3 font-extrabold text-gray-900"
           style="background: var(--accent);">
          Sign Up
        </a>
      </div>
    </div>

  </div>
</div>

<script>
(function () {
  const burgerBtn = document.getElementById("burgerBtn");
  const menu = document.getElementById("mobileMenu");
  const closeBtn = document.getElementById("closeMenu");
  const backdrop = document.getElementById("mobileBackdrop");
  const links = document.querySelectorAll(".mobileLink");

  function openMenu() {
    menu.classList.remove("hidden");
    menu.setAttribute("aria-hidden", "false");
    burgerBtn?.setAttribute("aria-expanded", "true");
    document.body.style.overflow = "hidden";
  }

  function closeMenu() {
    menu.classList.add("hidden");
    menu.setAttribute("aria-hidden", "true");
    burgerBtn?.setAttribute("aria-expanded", "false");
    document.body.style.overflow = "";
  }

  burgerBtn?.addEventListener("click", openMenu);
  closeBtn?.addEventListener("click", closeMenu);
  backdrop?.addEventListener("click", closeMenu);

  links.forEach(a => a.addEventListener("click", closeMenu));

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !menu.classList.contains("hidden")) closeMenu();
  });
})();
</script>
