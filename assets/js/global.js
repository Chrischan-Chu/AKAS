// assets/js/global.js
(function () {
  const backToTopBtn = document.getElementById("backToTop");
  const mobileMenu = document.getElementById("mobileMenu");

  if (!backToTopBtn) return;

  function isMobileMenuOpen() {
    return mobileMenu && !mobileMenu.classList.contains("hidden");
  }

  function updateBackToTop() {
    if (isMobileMenuOpen()) {
      backToTopBtn.classList.remove("show");
      return;
    }

    if (window.scrollY > 80) backToTopBtn.classList.add("show");
    else backToTopBtn.classList.remove("show");
  }

  window.addEventListener("scroll", updateBackToTop, { passive: true });
  window.addEventListener("load", updateBackToTop);

  backToTopBtn.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: "smooth" });
  });

  if (mobileMenu) {
    new MutationObserver(updateBackToTop).observe(mobileMenu, {
      attributes: true,
      attributeFilter: ["class"],
    });
  }
})();


// smooth scroll only
document.addEventListener("click", (e) => {
  const a = e.target.closest("a");
  if (!a) return;

  const href = a.getAttribute("href");
  if (!href) return;

  const hashIndex = href.indexOf("#");
  if (hashIndex === -1) return;

  const hash = href.slice(hashIndex);
  const target = document.querySelector(hash);
  if (!target) return;

  e.preventDefault();
  target.scrollIntoView({ behavior: "smooth", block: "start" });
});
