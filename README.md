# 🏥 Barangay Bacsay Health Center — Patient & Medical Record System

![System Status](https://img.shields.io/badge/Status-Operational-brightgreen)
![Laravel](https://img.shields.io/badge/Laravel-v12.x-orange)
![PHP](https://img.shields.io/badge/PHP-v8.2+-blue)
![Database](https://img.shields.io/badge/Database-MySQL%20%2F%20MariaDB-teal)
![License](https://img.shields.io/badge/License-Proprietary-red)

A comprehensive, dynamic, and secure web application designed specifically for **Barangay Bacsay Health Center** to streamline patient registration, consultations, vital signs tracking, prescription issuance, appointments, reports, and printable medical slips.

---

## 🌟 Key Features

- **👥 Patient Management**:
  - Full CRUD operations with auto-generated unique Patient Codes (`BAC-YYYY-XXX`).
  - Search by name, code, contact number, or purok.
  - Comprehensive health records: age, sex, civil status, blood type, allergies, chronic diseases, emergency contacts.

- **🩺 Medical Records & Consultations**:
  - Consultation logs with vital signs (BP, Temperature, Heart Rate, Respiratory Rate, Height, Weight, BMI).
  - Medical history archive and longitudinal patient care tracking.

- **💊 Prescription System**:
  - Multi-item prescription creation (`RX-YYYY-XXX`).
  - Dosage, frequency, duration, and instructions tracking.

- **📅 Appointments**:
  - Patient appointment scheduling and status updates (Scheduled, Completed, Cancelled).

- **📈 Analytics & Reports**:
  - Daily, Monthly, and Patient Demographic reports.
  - High-level metric cards for total patients, daily consultations, active prescriptions, and monthly visits.

- **🖨️ Printable Slips & Forms**:
  - Professional print forms for Patient Slips, Medical Records, Consultation Summaries, Prescriptions, and Referral Forms.

- **🛡️ 2-Role Role-Based Access Control (RBAC)**:
  - `Admin`: Full system access, User Management (`/users`), and General Settings (`/settings`).
  - `Staff`: Clinical operations (Patients, Consultations, Vitals, Prescriptions, Reports, Printing).

- **🔔 Dynamic System Notifications**:
  - Real-time activity alerts in the topbar bell dropdown.
  - "Mark All as Read" and "Clear All" functionality.

---

## 🛠️ Technology Stack

- **Backend Framework**: [Laravel 12](https://laravel.com/)
- **Programming Language**: PHP 8.2+
- **Frontend / UI**: HTML5, Vanilla CSS / Dreams Admin Template, JavaScript (jQuery, Bootstrap 5)
- **Icons**: Feather Icons & FontAwesome 6
- **Database**: MariaDB / MySQL (Production VPS) & SQLite (Localhost Development)
- **Asset Bundling**: Vite

---

## 🚀 Quick Start Guide (Localhost Setup)

### 1. Prerequisites
- PHP 8.2 or higher
- Composer 2.x
- Node.js & npm
- XAMPP / MariaDB / MySQL server

### 2. Installation Steps

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/KeithTorda/bacsaymedicalsystem.git
   cd bacsaymedicalsystem
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install & Build Frontend Assets**:
   ```bash
   npm install
   npm run dev
   ```

4. **Environment Setup**:
   Copy `.env.example` to `.env` and set up database credentials:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run Migrations & Seeders**:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Start Local Development Server**:
   ```bash
   php artisan serve --port=8000
   ```

7. **Access the App**:
   Open browser at `http://127.0.0.1:8000`

---

## 🔐 Default Admin Credentials (Seeder)

- **Admin Account**:
  - Email: `admin@bacsay.gov.ph`
  - Password: `password123`
- **Staff Account**:
  - Email: `staff@bacsay.gov.ph`
  - Password: `password123`

---

## 📋 Git Deployment & Rollback Instructions

To push updates or roll back to this official release (`v1.0.0`):

### Push Official Initial Release to GitHub
```bash
git init
git remote add origin https://github.com/KeithTorda/bacsaymedicalsystem.git
git branch -M main
git add .
git commit -m "feat: official initial release v1.0.0 - Barangay Bacsay Medical Record System"
git push -u origin main
```

### Rollback if Needed in Future
```bash
# View commit history
git log --oneline

# Revert to a specific commit safely
git revert <commit-hash>
# OR hard reset to commit
git reset --hard <commit-hash>
```

---

## 📄 License & Credits

Developed for **Barangay Bacsay Health Center**. All rights reserved.
