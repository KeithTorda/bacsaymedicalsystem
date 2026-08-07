# 🏥 BacsayMedSys (Barangay Bacsay Medical Record Management System) — Version 1.1 Official Release (VPS Live)

![Release Version](https://img.shields.io/badge/Release-v1.1%20VPS%20Live-orange)
![System Status](https://img.shields.io/badge/Status-Operational-brightgreen)
![Framework](https://img.shields.io/badge/Laravel-v11.x%20%2F%2012.x-red)
![PHP Version](https://img.shields.io/badge/PHP-v8.3%20FPM-blue)
![Database](https://img.shields.io/badge/Database-SQLite%20%2F%20MySQL-teal)

A comprehensive, dynamic, role-secured, and high-performance medical record management system designed specifically for **Barangay Bacsay Health Center, Luna, Apayao** to streamline patient registration, clinical encounters, vital signs monitoring, digital prescription issuance, appointments, reports, and official Philippine DOH-aligned printable forms.

---

## 🚀 Live VPS Production Server
- **Live URL**: [http://167.99.69.239:8085](http://167.99.69.239:8085)
- **Deployment Host**: Ubuntu Linux VPS (`167.99.69.239`)
- **Nginx Web Server**: Configured on Port `8085` using PHP 8.3 FPM
- **Status**: 100% Operational & Tested (HTTP 200 OK)

---

## 🌟 Key Features (Version 1.1 Official)

- **🔐 Warm Beige-Orange Centered Login System**:
  - Single centered glassmorphic login card with inset floating label inputs.
  - Public self-registration disabled (Admin-controlled staff creation).

- **👥 Patient Management**:
  - Full CRUD operations with auto-generated unique Patient Codes (`BAC-YYYY-XXX`).
  - Search by name, code, contact number, or address.
  - Comprehensive health profile: age, sex, civil status, blood type, allergies, chronic conditions, emergency contacts.

- **🩺 Medical Records & Clinical Consultations**:
  - Consultation logs with vital signs tracking (BP, Body Temp, Pulse Rate, Resp Rate, Height, Weight).
  - Medical history archive and longitudinal patient care tracking.

- **💊 Digital Prescription System**:
  - Multi-item prescription creation (`RX-YYYY-XXX`).
  - Medicine dosage, frequency, duration, and instructions management.

- **📅 Appointment Scheduling**:
  - Patient appointment scheduling and status updates (*Scheduled, Completed, Cancelled*).

- **📊 Health Analytics & Reports**:
  - Daily, Monthly, and Patient Demographic reports with export options.
  - ApexCharts interactive dashboard metrics.

- **🖨️ Official Philippine DOH & Barangay Bacsay Print Slips**:
  - 100% dynamic database data rendering for Patient Information Sheets, Clinical Medical Records, Consultation Encounter Forms, Rx Forms, and Referral Slips.
  - **Dynamic Signature Line**: Automatically signs document with current logged-in user's name and role.

- **🛡️ 2-Role Role-Based Access Control (RBAC)**:
  - `Admin`: Full system access, System Users Management (`/users`), and General Settings (`/settings`).
  - `Staff`: Clinical operations (Patients, Consultations, Vitals, Prescriptions, Reports, Print Center).

- **🔔 Role-Specific Notification System**:
  - Distinct alerts tailored for Admin (*Security Audit, Daily Summaries*) vs Staff (*Appointments, Prescriptions, Patient Updates*).

- **💻 Development Team Credits**:
  - Interactive Capstone Team Modal featuring project start date (`08/05/2026`), tech stack, photos, and team roles (**MARK CHRISTIAN GAON**, **ARMIE VELASCO**, **JOCEL ROSE TORDA**).

---

## 🛠️ Recent Production Fixes & Updates
1. **Helper Autoload Fix**: Moved `app/Helper/helpers.php` to main Composer `autoload` section and added `set_active()` fallback in `AppServiceProvider.php` to resolve production `500 Server Error`.
2. **Route Caching Fix**: Fixed duplicate route names in `web.php` for `logout`, `forget-password`, and `reset-password` to support `php artisan route:cache`.
3. **Dark Mode Modal Overrides**: Added CSS rules for `.modal-content`, `.modal-header`, and high-contrast `(X)` close button for night/dark theme.

---

## 🔑 Default Credentials (Seeded)

- **Admin Account**: `admin@gmail.com` | `admin123`
- **Staff Account**: `staff@bacsay.gov.ph` | `admin123`

---

## 👨‍💻 Capstone Project Team

- **MARK CHRISTIAN GAON** — Lead Programmer & Full-Stack Systems Developer
- **ARMIE VELASCO** — Project Lead & System UI/UX Designer
- **JOCEL ROSE TORDA** — Quality Assurance & Technical Documentation Specialist

*Project Started: August 05, 2026*
