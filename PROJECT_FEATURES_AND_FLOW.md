# 🏥 BacsayMedSys - System Features and Workflow

Ang document na ito ay naglalaman ng kasalukuyang features at operational flow ng **Barangay Bacsay Medical Record Management System (BacsayMedSys) v1.1**.

---

## 🌟 Kasalukuyang Features

Ang system ay binuo gamit ang Laravel (PHP 8.3) at naglalaman ng mga sumusunod na pangunahing features:

1. **🔐 Authentication & Role-Based Access Control (RBAC)**
   - **Admin:** May full access sa system, kasama ang pamamahala ng mga System Users (`/users`) at General Settings (`/settings`).
   - **Staff:** Nakatutok sa clinical operations tulad ng Patients, Consultations, Vitals, Prescriptions, Reports, at Print Center.
   - Naka-disable ang public registration para panatilihing secure ang system (Admin lamang ang pwedeng gumawa ng accounts).

2. **👥 Patient Management**
   - Full CRUD (Create, Read, Update, Delete) para sa patient records.
   - Automatic generation ng unique Patient Code (halimbawa: `BAC-YYYY-XXX`).
   - Advanced search functionality gamit ang pangalan, code, contact number, o address.
   - Kumpletong health profile na naglalaman ng blood type, allergies, at chronic conditions.

3. **🩺 Medical Records & Consultations**
   - Pag-log ng consultations kasama ang vital signs (Blood Pressure, Temp, Pulse Rate, Resp Rate, Height, Weight).
   - Medical history archive para makita ang progress ng pasyente.

4. **💊 Digital Prescription System**
   - Paggawa ng prescriptions na may multiple items (`RX-YYYY-XXX`).
   - Management ng medicine dosage, frequency, duration, at tamang instructions.

5. **📅 Appointment Scheduling**
   - Pag-schedule ng appointments ng mga pasyente.
   - Pag-update ng status: *Scheduled, Completed, Cancelled*.

6. **📊 Health Analytics & Reports**
   - Pag-generate ng Daily, Monthly, at Patient Demographic reports.
   - Interactive dashboard charts (gamit ang ApexCharts).

7. **🖨️ Official Print Center (DOH & Barangay Bacsay Aligned)**
   - Dynamic database data rendering para iprint ang: Patient Information Sheets, Clinical Medical Records, Consultation Encounter Forms, Rx Forms, at Referral Slips.
   - **Dynamic Signature Line:** Awtomatikong pinipirmahan ang dokumento base sa naka-login na user.

8. **🔔 Notification System**
   - Role-specific notifications (Security/Summaries para sa Admin; Appointments/Prescriptions para sa Staff).

---

## 🔄 System Flow (Paano ginagamit ang system)

Narito ang standard step-by-step flow ng system mula sa pag-login hanggang sa pagtapos ng consultation:

### 1. Authentication Phase
- Ang user ay pupunta sa system at ire-redirect sa `/login`.
- Maglo-login gamit ang seeded credentials (`admin@gmail.com` o `staff@bacsay.gov.ph`).
- Pagkatapos mag-login, ididirekta sa **Dashboard** (`/home`) kung saan makikita ang overall analytics at recent activities.

### 2. Patient Registration Phase (Staff/Admin)
- Kapag may bagong pasyente, pupunta sa **Patients Module** (`/patients`).
- I-eencode ang mga detalye ng pasyente. Ang system ay mag-gegenerate ng kanyang unique `BAC` code.
- Kung lumang pasyente, maaaring i-search ang record gamit ang search bar.

### 3. Consultation & Vitals Phase
- Kung ang pasyente ay magpapakonsulta, pwedeng gawan muna ng **Appointment** (`/appointments`) o diretsong gawan ng record.
- Pupunta sa **Consultations Module** (`/consultations/create`).
- Kukunin at i-eencode ang Vital Signs (BP, Temp, etc.) at ilalagay ang clinical diagnosis/notes.

### 4. Prescription Phase
- Kung kailangan ng gamot ng pasyente pagkatapos ng consultation, pupunta sa **Prescriptions Module** (`/prescriptions`).
- I-eencode ang mga gamot, dosage, at schedule.

### 5. Printing / Releasing Phase
- Pupunta sa **Print Center** (`/print`) para i-print ang mga kailangang dokumento.
- Maaaring i-print ang *Consultation Encounter Form*, *Prescription (Rx)*, o *Referral Slip* kung kailangan ilipat sa ibang ospital.
- Ang printed form ay may awtomatikong pangalan/pirma ng staff o admin na nag-asikaso.

### 6. Reporting Phase (End of Day/Month)
- Ang Admin o Head Staff ay pupunta sa **Reports Module** (`/reports/...`) para i-check o i-export ang daily o monthly health reports na ipapasa sa DOH o sa Kapitan ng Barangay.

---
*Ang dokumentong ito ay naka-base sa source code structure at routing setup ng BacsayMedSys repository.*
