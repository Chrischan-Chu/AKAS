<?php
declare(strict_types=1);

$baseUrl = '/AKAS';
require_once __DIR__ . '/../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ' . $baseUrl . '/pages/signup.php');
  exit;
}

// If already logged in, send where they belong
if (auth_is_logged_in()) {
  header('Location: ' . ($baseUrl . (auth_role() === 'clinic_admin' ? '/admin/dashboard.php' : '/index.php#top')));
  exit;
}

$role = trim((string)($_POST['role'] ?? ''));
if (!in_array($role, ['user', 'clinic_admin'], true)) {
  flash_set('error', 'Invalid account type.');
  header('Location: ' . $baseUrl . '/pages/signup.php');
  exit;
}

$email = strtolower(trim((string)($_POST['email'] ?? '')));
$password = (string)($_POST['password'] ?? '');
$confirmPassword = (string)($_POST['confirm_password'] ?? '');

// Basic validation
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  flash_set('error', 'Please enter a valid email.');
  header('Location: ' . $baseUrl . ($role === 'clinic_admin' ? '/pages/signup-admin.php' : '/pages/signup-user.php'));
  exit;
}

// Password rules (same as your JS)
$minLen = strlen($password) >= 8;
$hasUpper = preg_match('/[A-Z]/', $password) === 1;
$hasSpecial = preg_match('/[^A-Za-z0-9]/', $password) === 1;

if (!($minLen && $hasUpper && $hasSpecial)) {
  flash_set('error', 'Password must be 8+ chars, with 1 uppercase and 1 special character.');
  header('Location: ' . $baseUrl . ($role === 'clinic_admin' ? '/pages/signup-admin.php' : '/pages/signup-user.php'));
  exit;
}

if ($password !== $confirmPassword) {
  flash_set('error', 'Passwords do not match.');
  header('Location: ' . $baseUrl . ($role === 'clinic_admin' ? '/pages/signup-admin.php' : '/pages/signup-user.php'));
  exit;
}

$pdo = db();

// Make sure email is unique
$stmt = $pdo->prepare('SELECT id FROM accounts WHERE email = ? LIMIT 1');
$stmt->execute([$email]);
if ($stmt->fetch()) {
  flash_set('error', 'Email is already registered. Please login.');
  header('Location: ' . $baseUrl . '/pages/login.php');
  exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

if ($role === 'user') {
  $name = trim((string)($_POST['name'] ?? ''));
  $gender = trim((string)($_POST['gender'] ?? ''));
  $phone = trim((string)($_POST['number'] ?? ''));
  $birthdate = trim((string)($_POST['birthdate'] ?? ''));


  if ($name === '') {
    flash_set('error', 'Please enter your name.');
    header('Location: ' . $baseUrl . '/pages/signup-user.php');
    exit;
  }

  // Gender validation
  $allowedGenders = ['Male', 'Female', 'Prefer not to say'];
  if (!in_array($gender, $allowedGenders, true)) {
    flash_set('error', 'Please select a gender.');
    header('Location: ' . $baseUrl . '/pages/signup-user.php');
    exit;
  }

  // Phone validation (expects 10 digits starting with 9)
  $phoneVal = null;
  if ($phone !== '') {
    $phone = preg_replace('/\D+/', '', $phone) ?? '';
    if (!preg_match('/^9\d{9}$/', $phone)) {
      flash_set('error', 'Enter a valid PH mobile number (ex: 9123456789).');
      header('Location: ' . $baseUrl . '/pages/signup-user.php');
      exit;
    }
    $phoneVal = $phone;
  }

  // Birthdate validation + 18+
  $birthdateVal = null;
  if ($birthdate !== '') {
    $d = date_create($birthdate);
    if (!$d) {
      flash_set('error', 'Enter a valid birth date.');
      header('Location: ' . $baseUrl . '/pages/signup-user.php');
      exit;
    }
    $birthdateVal = $d->format('Y-m-d');

    $today = new DateTime('today');
    $age = $d->diff($today)->y;
    if ($age < 18) {
      flash_set('error', 'You must be at least 18 years old.');
      header('Location: ' . $baseUrl . '/pages/signup-user.php');
      exit;
    }
  }

  $ins = $pdo->prepare('INSERT INTO accounts (role, name, gender, email, password_hash, phone, birthdate)
                        VALUES (?,?,?,?,?,?,?)');
  $ins->execute(['user', $name, $gender, $email, $hash, $phoneVal, $birthdateVal]);

} else {
  // clinic_admin
  $clinicName = trim((string)($_POST['clinic_name'] ?? ''));
  $specialty = trim((string)($_POST['specialty'] ?? ''));
  $specialtyOther = trim((string)($_POST['specialty_other'] ?? ''));
  $phone = trim((string)($_POST['contact_number'] ?? ''));
  $license = trim((string)($_POST['license_number'] ?? ''));

  if ($clinicName === '' || $specialty === '' || $license === '') {
    flash_set('error', 'Please complete all required fields.');
    header('Location: ' . $baseUrl . '/pages/signup-admin.php');
    exit;
  }

  if ($specialty === 'Other' && $specialtyOther === '') {
    flash_set('error', 'Please specify your clinic type.');
    header('Location: ' . $baseUrl . '/pages/signup-admin.php');
    exit;
  }

  // Upload logo
  $logoPath = null;
  if (!empty($_FILES['logo']['name'])) {
    $tmp = $_FILES['logo']['tmp_name'] ?? '';
    if (is_uploaded_file($tmp)) {
      $ext = strtolower(pathinfo((string)($_FILES['logo']['name'] ?? ''), PATHINFO_EXTENSION));
      if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
        flash_set('error', 'Logo must be a JPG, PNG, or WEBP image.');
        header('Location: ' . $baseUrl . '/pages/signup-admin.php');
        exit;
      }

      $dir = __DIR__ . '/../uploads/logos';
      if (!is_dir($dir)) @mkdir($dir, 0777, true);

      $fileName = 'logo_' . bin2hex(random_bytes(8)) . '.' . $ext;
      $dest = $dir . '/' . $fileName;
      if (!move_uploaded_file($tmp, $dest)) {
        flash_set('error', 'Failed to upload logo. Please try again.');
        header('Location: ' . $baseUrl . '/pages/signup-admin.php');
        exit;
      }
      $logoPath = $baseUrl . '/uploads/logos/' . $fileName;
    }
  }

  $displayName = $clinicName;

  $ins = $pdo->prepare('INSERT INTO accounts (role, name, email, password_hash, phone, clinic_name, specialty, specialty_other, logo_path, license_number)
                        VALUES (?,?,?,?,?,?,?,?,?,?)');
  $ins->execute(['clinic_admin', $displayName, $email, $hash, $phone ?: null, $clinicName, $specialty, $specialtyOther ?: null, $logoPath, $license]);
}

header('Location: ' . $baseUrl . '/pages/signup-success.php?role=' . urlencode($role));
exit;
