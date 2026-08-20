# BacsayMedSys

A Laravel-based medical record management system designed for barangay health centers.

## Overview

BacsayMedSys streamlines patient registration, clinical encounters, vital signs monitoring, digital prescription issuance, appointments, reports, and official printable forms for the Barangay Bacsay Health Center.

## Features

### Authentication and Access Control
Secure login system via Laravel's built-in authentication. Public registration is restricted; accounts can only be created by an Admin.

### Patient Management
Full CRUD operations for patient records. Automatically generates unique Patient Codes (`BAC-YYYY-XXX`). Records store health profiles including civil status, blood type, allergies, chronic diseases, vaccination history, and emergency contacts.

### Medical Records and Consultations
Logs clinical consultations and tracks vital signs including blood pressure, temperature, pulse rate, respiratory rate, height, and weight. Archives medical history for patient care tracking.

### Prescription Management
Digital prescription creation with unique identifiers (`RX-YYYY-XXX`). Manages medicine names, dosage, frequency, duration, and instructions.

### Appointment Scheduling
Patient appointment scheduling and status tracking (Scheduled, Completed, Cancelled).

### Reports and Analytics
Generates daily, monthly, and patient demographic reports. Features interactive dashboard charting metrics.

### Print Center
Generates dynamic database-driven forms including Patient Information Sheets, Clinical Medical Records, Consultation Encounter Forms, Prescription Forms, and Referral Slips.

### Notifications
Role-specific notifications for system events such as system audits, daily health summaries, new appointments, prescription issuances, and vaccination reminders.

## User Roles and Access Control

| Role | Access |
|---|---|
| Admin | Full system access, system users management (`/users`), and general settings (`/settings`) |
| Staff | Clinical operations including patients, consultations, vitals, prescriptions, reports, and printing |

## Technology Stack

* Laravel 12.x (Framework)
* PHP 8.2+
* SQLite (Default) / MySQL (Supported via standard Laravel configuration)
* Tailwind CSS (v4.0.0 via Vite)
* Bootstrap (v5.2.3 via Vite)
* Vite (Asset Bundler)

## System Modules and Routes

| Module | Method | Route | Purpose | Access |
|---|---|---|---|---|
| Dashboard | GET | `/home` | Main system dashboard | Admin, Staff |
| Patients | GET | `/patients` | Patient record management | Admin, Staff |
| Consultations | GET | `/consultations/create` | Consultation records creation | Admin, Staff |
| Medical Records | GET | `/medical-records` | Medical history tracking | Admin, Staff |
| Appointments | GET | `/appointments` | Appointment scheduling | Admin, Staff |
| Prescriptions | GET | `/prescriptions` | Digital prescription issuance | Admin, Staff |
| Notifications | GET | `/notifications` | Role-specific alerts | Admin, Staff |
| Daily Reports | GET | `/reports/daily` | Daily health reports | Admin, Staff |
| Monthly Reports | GET | `/reports/monthly` | Monthly health reports | Admin, Staff |
| Patient Reports | GET | `/reports/patients` | Patient demographic reports | Admin, Staff |
| Print Center | GET | `/print` | Document generation | Admin, Staff |
| Users | GET | `/users` | System user management | Admin |
| Settings | GET | `/settings` | General system settings | Admin |

## System Workflow

1. Authentication: Users log in using provided credentials.
2. Patient Registration or Search: Users register a new patient or search for an existing record.
3. Consultation and Vital Signs: Users record vital signs and clinical diagnoses.
4. Prescription: Users generate digital prescriptions linked to a consultation.
5. Printing and Release: Users print official forms from the Print Center.
6. Reporting: Users generate and review end-of-day or end-of-month reports.

## Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

### Database Setup

SQLite is the default database used in development. Ensure the database file exists before migrating:

**For Unix/macOS:**
```bash
touch database/database.sqlite
```

**For Windows (PowerShell):**
```powershell
New-Item -ItemType File -Path "database\database.sqlite"
```

Once the database is ready, run the migrations and seeders:
```bash
php artisan migrate
php artisan db:seed
```

### Development Server

To run the application locally, start both the Vite development server and the Laravel server:

```bash
npm run dev
php artisan serve
```

For production deployment, build the frontend assets:
```bash
npm run build
```

## Seeded Accounts

The application includes the following seeded accounts for development and initial access. These must be changed in a production environment:

* Admin: `admin@gmail.com` / `admin123`
* Staff: `staff@bacsay.gov.ph` / `admin123`

## Environment Configuration

Configure standard Laravel `.env` variables such as `DB_CONNECTION`, `DB_DATABASE`, and `APP_URL` depending on your environment.

## Project Structure

```text
app/
├── Http/
│   └── Controllers/
├── Models/
└── ...

database/
├── migrations/
└── seeders/

public/
resources/
├── css/
├── js/
└── views/

routes/
└── web.php
```

## Security

* Authentication is required for all routes except the login interface.
* Public registration is disabled to prevent unauthorized access.
* Specific routes (`/settings` and `/users`) strictly enforce Admin-only access.

## Documentation Notes

This documentation is based on the current repository implementation, reflecting verified routes, models, migrations, views, and configuration.
