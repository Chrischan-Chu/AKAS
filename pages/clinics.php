
<section id="clinics" class="scroll-mt-24">
  <section class="px-4 py-14">

    <div class="max-w-6xl mx-auto">

      <!-- Header -->
      <div class="flex items-center justify-between gap-4 mb-8">
        <h2 class="text-3xl md:text-4xl font-extrabold text-[var(--primary)]">
          Clinics
        </h2>

        <a href="/AKAS/pages/clinics-all.php"
           class="px-6 h-11 flex items-center rounded-full font-semibold text-white shadow-sm hover:opacity-95 transition"
           style="background-color: var(--primary);">
          View All Clinics
        </a>
      </div>


      <!-- BIGGER GRID -->
      <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-6 px-8 lg:px-0">

        <?php for ($i = 1; $i <= 3; $i++): ?>

          <a href="/AKAS/pages/clinic-profile.php?id=<?php echo urlencode($i); ?>"
             class="group block bg-white rounded-3xl shadow-sm hover:shadow-lg transition overflow-hidden">

            <div class="p-8 min-h-[210px] flex flex-col justify-between">

              <!-- Top -->
              <div class="flex items-center gap-5">

                <!-- Bigger icon -->
                <div class="h-20 w-20 rounded-3xl flex items-center justify-center shadow-sm"
                     style="background: rgba(64, 183, 255, .15);">
                  <img
                    src="https://cdn-icons-png.flaticon.com/512/2967/2967350.png"
                    alt="Clinic"
                    class="h-12 w-12"
                  >
                </div>

                <div class="min-w-0">
                  <h5 class="text-xl font-extrabold text-[var(--primary)] truncate">
                    Clinic Name <?php echo $i; ?>
                  </h5>

                  <p class="text-slate-600 text-sm truncate">
                    Medical Specialty • Barangay
                  </p>
                </div>

              </div>


              <!-- Middle -->
              <p class="text-slate-600 mt-5 text-base leading-relaxed line-clamp-3">
                Short clinic description goes here. This can be fetched from the database.
              </p>


              <!-- Bottom -->
              <div class="mt-6 text-sm font-bold group-hover:translate-x-1 transition"
                   style="color: var(--secondary);">
                View profile →
              </div>

            </div>

          </a>

        <?php endfor; ?>

      </div>

    </div>
  </section>
</section>
