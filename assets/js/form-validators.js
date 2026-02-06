// assets/js/form-validators.js
(() => {
  /* ================= helpers ================= */

  const showError = (el) => {
    el.classList.add("ring-2", "ring-red-400");
  };

  const clearError = (el) => {
    el.classList.remove("ring-2", "ring-red-400");
  };

  /**
   * Prevent popup spam while typing:
   * - input: UI only (red ring), no customValidity message
   * - blur + submit: set customValidity so submit is blocked
   */
  const wireInput = ({ input, validate, filter }) => {
    if (!input) return;

    const applyUI = (v) => {
      if (v === "") {
        clearError(input);
        return;
      }
      const { ok } = validate(v, input, "input");
      if (!ok) showError(input);
      else clearError(input);
    };

    const applyValidity = (v, phase) => {
      if (v === "") {
        input.setCustomValidity("");
        return;
      }
      const { ok, message } = validate(v, input, phase);
      input.setCustomValidity(ok ? "" : message);
    };

    input.addEventListener("input", () => {
      if (typeof filter === "function") filter(input);
      const v = (input.value || "").trim();

      applyUI(v);
      input.setCustomValidity(""); // quiet while typing
    });

    input.addEventListener("blur", () => {
      if (typeof filter === "function") filter(input);
      const v = (input.value || "").trim();

      // strict on blur
      const { ok } = validate(v, input, "blur");
      if (!ok) showError(input);
      else clearError(input);

      applyValidity(v, "blur");
    });

    input.closest("form")?.addEventListener("submit", () => {
      if (typeof filter === "function") filter(input);
      const v = (input.value || "").trim();

      applyValidity(v, "submit"); // strict on submit
    });
  };

  /* ================= validators ================= */

  const validateEmail = (val) => {
    const v = (val || "").trim();
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);
    return { ok, message: ok ? "" : "Enter a valid email (ex: name@gmail.com)." };
  };

  const validatePHMobile = (val, input, phase = "input") => {
    const v = (val || "").trim();

    // while typing: don't show red until they reach 10 digits
    if (phase === "input" && v.length < 10) {
      return { ok: true, message: "" };
    }

    // blur/submit: must be exactly 10 digits and start with 9
    const ok = /^9\d{9}$/.test(v);
    return {
      ok,
      message: ok ? "" : "Enter a valid PH mobile number (ex: 9123456789).",
    };
  };

  const validatePassword = (val) => {
    const v = val || "";
    const ok = v.length >= 8 && /[A-Z]/.test(v) && /[^A-Za-z0-9]/.test(v);
    return {
      ok,
      message: ok ? "" : "Password must be 8+ chars, with 1 uppercase and 1 special character.",
    };
  };

  // Optional new password: empty is OK, otherwise reuse validatePassword
  const validatePasswordOptional = (val) => {
    const v = (val || "").trim();
    if (v === "") return { ok: true, message: "" };
    return validatePassword(v);
  };

  // Confirm password must match target (optional-friendly)
  const validatePasswordConfirm = (val, input) => {
    const v = (val || "").trim();
    const targetName = input.dataset.match; // e.g. "password" or "new_password"
    const other = document.querySelector(`[name="${targetName}"]`);
    const otherVal = (other?.value || "").trim();

    // both empty -> ok (optional)
    if (v === "" && otherVal === "") return { ok: true, message: "" };

    const ok = v !== "" && v === otherVal;
    return { ok, message: ok ? "" : "Passwords do not match." };
  };

  const validateAge18 = (val) => {
    const v = (val || "").trim();
    if (!v) return { ok: true, message: "" };

    const birth = new Date(v + "T00:00:00");
    if (isNaN(birth.getTime())) return { ok: false, message: "Enter a valid birth date." };

    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const m = today.getMonth() - birth.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;

    const ok = age >= 18;
    return { ok, message: ok ? "" : "You must be at least 18 years old." };
  };

  /* ================= password toggle (SVG icons) ================= */

  const ICON_EYE = `
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
      <circle cx="12" cy="12" r="3" stroke-width="2"/>
    </svg>
  `;

  const ICON_EYE_OFF = `
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
      <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        d="M3 3l18 18"/>
      <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        d="M10.58 10.58A3 3 0 0012 15a3 3 0 002.42-4.42"/>
      <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        d="M9.88 5.08A10.94 10.94 0 0112 4c7 0 11 8 11 8a18.46 18.46 0 01-3.12 4.47"/>
      <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        d="M6.1 6.1C3.9 7.8 1 12 1 12s4 8 11 8c1.2 0 2.33-.2 3.4-.57"/>
    </svg>
  `;

  const initPasswordToggles = () => {
    document.querySelectorAll(".toggle-pass").forEach((btn) => {
      // prevent double-binding if partial reloads
      if (btn.dataset.bound === "1") return;
      btn.dataset.bound = "1";

      // set default icon if empty
      if (!btn.innerHTML.trim()) btn.innerHTML = ICON_EYE;

      btn.addEventListener("click", () => {
        const targetId = btn.dataset.target;
        const input = document.getElementById(targetId);
        if (!input) return;

        const nowVisible = input.type === "password";
        input.type = nowVisible ? "text" : "password";

        btn.innerHTML = nowVisible ? ICON_EYE_OFF : ICON_EYE;
      });
    });
  };

  /* ================= auto-wire ================= */

  document.addEventListener("DOMContentLoaded", () => {
    // Email
    document.querySelectorAll('[data-validate="email"]').forEach((input) => {
      wireInput({ input, validate: validateEmail });
    });

    // Phone (PH)
    document.querySelectorAll('[data-validate="phone-ph"]').forEach((input) => {
      wireInput({
        input,
        validate: validatePHMobile,
        filter: (el) => (el.value = el.value.replace(/\D/g, "").slice(0, 10)),
      });
    });

    // Password (required)
    document.querySelectorAll('[data-validate="password"]').forEach((input) => {
      wireInput({ input, validate: validatePassword });
    });

    // Password (optional - settings)
    document.querySelectorAll('[data-validate="password-optional"]').forEach((input) => {
      wireInput({ input, validate: validatePasswordOptional });
    });

    // Confirm password match
    document.querySelectorAll('[data-validate="password-confirm"]').forEach((input) => {
      wireInput({ input, validate: validatePasswordConfirm });
    });

    // Age 18+
    document.querySelectorAll('[data-validate="age-18"]').forEach((input) => {
      wireInput({ input, validate: validateAge18 });
    });

    // Password toggles
    initPasswordToggles();
  });
})();
