# 🏥 BacsayMedSys (Barangay Bacsay Medical Record Management System) — Version 1.1 Official Release

![Release Version](https://img.shields.io/badge/Release-v1.1%20Official-orange)
![System Status](https://img.shields.io/badge/Status-Operational-brightgreen)
![Framework](https://img.shields.io/badge/Laravel-v11.x%20%2F%2012.x-red)
![PHP Version](https://img.shields.io/badge/PHP-v8.2+-blue)
![Database](https://img.shields.io/badge/Database-MySQL%20%2F%20MariaDB-teal)

A comprehensive, dynamic, role-secured, and high-performance medical record management system designed specifically for **Barangay Bacsay Health Center, Luna, Apayao** to streamline patient registration, clinical encounters, vital signs monitoring, digital prescription issuance, appointments, reports, and official Philippine DOH-aligned printable forms.

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
  - Accessible via footer and profile menu, featuring Project Start Date (`08/05/2026`), Tech Stack Badges, and team roles for **MARK CHRISTIAN GAON**, **ARMIE VELASCO**, and **JOCEL ROSE TORDA**.

---

## 💻 Capstone Development Team

- **MARK CHRISTIAN GAON** — *Lead Programmer & Full-Stack Systems Developer*
- **ARMIE VELASCO** — *Project Lead & System UI/UX Designer*
- **JOCEL ROSE TORDA** — *Quality Assurance & Technical Documentation Specialist*

**Development Started**: August 05, 2026 (`08/05/2026`)

---

## 🛠️ Technology Stack

- **Backend**: PHP 8.2+, Laravel 11/12 Framework
- **Frontend**: HTML5, Vanilla CSS3, JavaScript ES6+, Bootstrap 4, ApexCharts, DataTables, FontAwesome 6
- **Database**: SQLite / MySQL / MariaDB

---

© 2026 **BacsayMedSys** Capstone Project. Barangay Bacsay Health Center. All Rights Reserved.
