-- AKAS Database
-- Create DB + table for users and clinic admins

CREATE DATABASE IF NOT EXISTS akas_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE akas_db;

CREATE TABLE IF NOT EXISTS accounts (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  role ENUM('user','clinic_admin') NOT NULL DEFAULT 'user',

  -- Common
  name VARCHAR(150) NOT NULL,
  email VARCHAR(190) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  phone VARCHAR(32) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  -- User fields
  birthdate DATE NULL,

  -- Clinic admin fields
  clinic_name VARCHAR(190) NULL,
  specialty VARCHAR(120) NULL,
  specialty_other VARCHAR(120) NULL,
  logo_path VARCHAR(255) NULL,
  license_number VARCHAR(120) NULL,

  PRIMARY KEY (id),
  UNIQUE KEY uq_accounts_email (email)
);
