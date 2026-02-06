<?php
header("Content-Type: text/html; charset=UTF-8");

$doctorId = (int)($_GET["id"] ?? 0);
$clinicId = (int)($_GET["clinic_id"] ?? 0);

$doctor = [
  "name" => "Dr. Alexandra Reyes",
  "specialty" => "General Practitioner",
  "license" => "PRC Lic. No. 0123456",
  "clinic" => "AKAS Health Clinic – Angeles City",
  "experience" => "7+ years experience",
  "languages" => ["English", "Filipino"],
  "rating" => 4.8,
  "reviews" => 126,
  "about" => "Dr. Reyes focuses on preventive care, general consultations, minor illness management, and wellness planning. Patients appreciate her clear explanations and friendly approach.",
  "services" => [
    "General Consultation",
    "Follow-up Checkups",
    "Medical Certificates",
    "Basic Wellness Advice",
    "Blood Pressure Monitoring"
  ],
  "availability" => [
    ["day" => "Mon", "time" => "9:00 AM – 4:00 PM"],
    ["day" => "Tue", "time" => "10:00 AM – 5:00 PM"],
    ["day" => "Wed", "time" => "9:00 AM – 2:00 PM"],
    ["day" => "Thu", "time" => "10:00 AM – 5:00 PM"],
    ["day" => "Fri", "time" => "9:00 AM – 3:00 PM"],
  ],
  "fee" => "₱300 – ₱500",
  "address" => "Angeles City, Pampanga",
  "education" => [
    "Doctor of Medicine – University of the Philippines (UP)",
    "Residency – Family Medicine (Regional Medical Center)"
  ]
];

function h($v){ return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8"); }
?>

<div class="max-h-[70vh] sm:max-h-[75vh] overflow-y-auto pr-2 sm:pr-3 overscroll-contain">
  <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

    <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-7 flex flex-col items-center text-center border border-slate-100">
      <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full flex items-center justify-center" style="background:rgba(255,161,84,.35)">
        <img src="/AKAS/assets/img/doctor1.png" loading="lazy" decoding="async" class="w-14 sm:w-20" alt="Doctor" />
      </div>

      <h2 class="mt-4 sm:mt-5 text-xl sm:text-2xl font-extrabold text-slate-900"><?php echo h($doctor["name"]); ?></h2>
      <p class="mt-1 text-slate-600 font-semibold"><?php echo h($doctor["specialty"]); ?></p>

      <p class="mt-3 text-sm text-slate-500">
        <?php echo h($doctor["experience"]); ?> • <?php echo h($doctor["license"]); ?>
      </p>

      <div class="mt-4 flex items-center gap-2">
        <span class="text-sm font-bold text-slate-900"><?php echo h($doctor["rating"]); ?></span>
        <span class="text-xs text-slate-500">(<?php echo (int)$doctor["reviews"]; ?> reviews)</span>
      </div>

      <div class="mt-6 flex flex-wrap justify-center gap-2">
        <span class="px-3 py-1 rounded-full text-xs font-semibold text-white" style="background:var(--primary)">Verified Doctor</span>
        <span class="px-3 py-1 rounded-full text-xs font-semibold text-slate-900" style="background:rgba(255,161,84,.45)">Walk-in & Online</span>
      </div>

      <div class="mt-6 w-full">
        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Languages</p>
        <div class="mt-2 flex flex-wrap justify-center gap-2">
          <?php foreach($doctor["languages"] as $lang): ?>
            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700"><?php echo h($lang); ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="lg:col-span-3 rounded-3xl p-6 sm:p-7 text-white"
         style="background:linear-gradient(135deg, rgba(64,183,255,.96), rgba(11,56,105,.92));">

      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div class="min-w-0">
          <h3 class="text-xl sm:text-2xl font-extrabold leading-tight break-words"><?php echo h($doctor["name"]); ?></h3>
          <p class="text-white/90 break-words"><?php echo h($doctor["clinic"]); ?></p>
          <p class="text-white/80 text-sm mt-1">📍 <?php echo h($doctor["address"]); ?></p>
        </div>

        <div class="bg-white/15 rounded-2xl px-4 py-3 shrink-0">
          <p class="text-xs uppercase tracking-wider text-white/80">Consultation Fee</p>
          <p class="text-lg font-extrabold"><?php echo h($doctor["fee"]); ?></p>
        </div>
      </div>

      <div class="mt-6">
        <h4 class="font-bold text-base sm:text-lg">About the Doctor</h4>
        <p class="mt-2 text-white/90 leading-relaxed text-sm sm:text-base"><?php echo h($doctor["about"]); ?></p>
      </div>

      <div class="mt-6">
        <h4 class="font-bold text-base sm:text-lg">Services</h4>
        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
          <?php foreach($doctor["services"] as $svc): ?>
            <div class="bg-white/15 rounded-xl px-4 py-2 text-sm font-semibold">✓ <?php echo h($svc); ?></div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="mt-6">
        <h4 class="font-bold text-base sm:text-lg">Availability</h4>
        <div class="mt-3 rounded-2xl bg-white/10 overflow-hidden border border-white/20">
          <?php foreach($doctor["availability"] as $row): ?>
            <div class="flex items-center justify-between px-4 py-3 border-b border-white/10 last:border-b-0 gap-4">
              <span class="font-semibold"><?php echo h($row["day"]); ?></span>
              <span class="text-white/90 text-sm text-right"><?php echo h($row["time"]); ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="mt-6">
        <h4 class="font-bold text-base sm:text-lg">Education</h4>
        <div class="mt-3 space-y-2">
          <?php foreach($doctor["education"] as $edu): ?>
            <div class="bg-white/15 rounded-xl px-4 py-2 text-sm font-semibold">🎓 <?php echo h($edu); ?></div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</div>
