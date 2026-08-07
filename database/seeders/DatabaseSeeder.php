<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'user_id' => 'ID0001',
                'email' => 'admin@gmail.com',
                'status' => 'Active',
                'role_name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@bacsay.gov.ph'],
            [
                'name' => 'Staff User',
                'user_id' => 'ID0002',
                'email' => 'staff@bacsay.gov.ph',
                'status' => 'Active',
                'role_name' => 'Staff',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Seed Patients
        $p1 = Patient::create([
            'patient_code' => 'BAC-2026-001',
            'first_name' => 'Maria Clara',
            'last_name' => 'Santos',
            'middle_name' => 'Reyes',
            'name' => 'Maria Clara Santos',
            'birthdate' => '1992-05-14',
            'age' => 34,
            'sex' => 'Female',
            'civil_status' => 'Married',
            'blood_type' => 'O+',
            'contact' => '09171234567',
            'address' => 'Purok 1, Barangay Bacsay',
            'allergies' => 'Penicillin',
            'diseases' => 'Hypertension',
            'vaccination' => 'COVID-19 (Booster), Tetanus Toxoid',
            'emergency_contact_name' => 'Crisostomo Ibarra',
            'emergency_contact_phone' => '09179998877',
        ]);

        $p2 = Patient::create([
            'patient_code' => 'BAC-2026-002',
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'middle_name' => 'Santos',
            'name' => 'Juan Dela Cruz',
            'birthdate' => '1985-11-20',
            'age' => 40,
            'sex' => 'Male',
            'civil_status' => 'Married',
            'blood_type' => 'A+',
            'contact' => '09289876543',
            'address' => 'Purok 3, Barangay Bacsay',
            'allergies' => 'None',
            'diseases' => 'Type 2 Diabetes',
            'vaccination' => 'COVID-19 (Booster), Flu Vaccine',
            'emergency_contact_name' => 'Juana Dela Cruz',
            'emergency_contact_phone' => '09281112233',
        ]);

        $p3 = Patient::create([
            'patient_code' => 'BAC-2026-003',
            'first_name' => 'Ana Marie',
            'last_name' => 'Ramos',
            'middle_name' => 'Cruz',
            'name' => 'Ana Marie Ramos',
            'birthdate' => '2001-03-08',
            'age' => 25,
            'sex' => 'Female',
            'civil_status' => 'Single',
            'blood_type' => 'B+',
            'contact' => '09195554321',
            'address' => 'Purok 2, Barangay Bacsay',
            'allergies' => 'Shrimp, Dust',
            'diseases' => 'Asthma',
            'vaccination' => 'COVID-19 (Booster)',
            'emergency_contact_name' => 'Pedro Ramos',
            'emergency_contact_phone' => '09193334455',
        ]);

        $p4 = Patient::create([
            'patient_code' => 'BAC-2026-004',
            'first_name' => 'Roberto',
            'last_name' => 'Garcia Jr.',
            'middle_name' => 'Mendoza',
            'name' => 'Roberto Garcia Jr.',
            'birthdate' => '1958-08-30',
            'age' => 67,
            'sex' => 'Male',
            'civil_status' => 'Widower',
            'blood_type' => 'AB+',
            'contact' => '09391112233',
            'address' => 'Purok 4, Barangay Bacsay',
            'allergies' => 'Mefenamic Acid',
            'diseases' => 'Arthritis, Hypertension',
            'vaccination' => 'Pneumococcal, Flu Vaccine',
            'emergency_contact_name' => 'Carlos Garcia',
            'emergency_contact_phone' => '09398887766',
        ]);

        // 3. Seed Consultations & Medical Records
        $c1 = Consultation::create([
            'consultation_code' => 'CNS-101',
            'patient_id' => $p1->id,
            'visit_date' => '2026-02-06',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
            'chief_complaint' => 'Persistent headache and dizziness since yesterday',
            'bp' => '130/85',
            'temperature' => '36.8',
            'pulse_rate' => '78',
            'respiratory_rate' => '18',
            'height' => '158',
            'weight' => '56',
            'diagnosis' => 'Mild Essential Hypertension',
            'treatment' => 'Lifestyle modification, reduced sodium diet, bed rest',
            'prescription' => 'Amlodipine 5mg - 1 tablet daily for 30 days',
            'next_visit' => '2026-03-06',
        ]);

        MedicalRecord::create([
            'record_code' => 'MR-2026-001',
            'patient_id' => $p1->id,
            'consultation_id' => $c1->id,
            'date' => '2026-02-06',
            'complaint' => 'Persistent headache and dizziness',
            'diagnosis' => 'Essential Hypertension',
            'vitals' => '130/85 mmHg, 36.8°C, 78 bpm',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
        ]);

        $c2 = Consultation::create([
            'consultation_code' => 'CNS-102',
            'patient_id' => $p2->id,
            'visit_date' => '2026-02-06',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
            'chief_complaint' => 'Fasting blood sugar monitoring & leg pain',
            'bp' => '125/80',
            'temperature' => '36.6',
            'pulse_rate' => '74',
            'respiratory_rate' => '16',
            'height' => '165',
            'weight' => '72',
            'diagnosis' => 'Type 2 Diabetes Mellitus',
            'treatment' => 'Dietary restriction, glucose monitoring twice weekly',
            'prescription' => 'Metformin 500mg - 1 tab twice daily',
            'next_visit' => '2026-02-20',
        ]);

        MedicalRecord::create([
            'record_code' => 'MR-2026-002',
            'patient_id' => $p2->id,
            'consultation_id' => $c2->id,
            'date' => '2026-02-06',
            'complaint' => 'Fasting blood sugar monitoring & leg pain',
            'diagnosis' => 'Type 2 Diabetes Mellitus',
            'vitals' => '125/80 mmHg, 36.6°C, 74 bpm',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
        ]);

        $c3 = Consultation::create([
            'consultation_code' => 'CNS-103',
            'patient_id' => $p3->id,
            'visit_date' => '2026-02-05',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
            'chief_complaint' => 'Shortness of breath and wheezing',
            'bp' => '118/78',
            'temperature' => '37.0',
            'pulse_rate' => '88',
            'respiratory_rate' => '22',
            'height' => '152',
            'weight' => '48',
            'diagnosis' => 'Acute Asthma Exacerbation',
            'treatment' => 'Nebulization given at health center',
            'prescription' => 'Salbutamol Nebule 2.5mg - as needed',
            'next_visit' => '2026-02-12',
        ]);

        MedicalRecord::create([
            'record_code' => 'MR-2026-003',
            'patient_id' => $p3->id,
            'consultation_id' => $c3->id,
            'date' => '2026-02-05',
            'complaint' => 'Shortness of breath and wheezing',
            'diagnosis' => 'Acute Asthma Exacerbation',
            'vitals' => '118/78 mmHg, 37.0°C, 88 bpm',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
        ]);

        $c4 = Consultation::create([
            'consultation_code' => 'CNS-104',
            'patient_id' => $p4->id,
            'visit_date' => '2026-02-04',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
            'chief_complaint' => 'Joint pain in knees and right wrist',
            'bp' => '138/88',
            'temperature' => '36.7',
            'pulse_rate' => '70',
            'respiratory_rate' => '16',
            'height' => '160',
            'weight' => '65',
            'diagnosis' => 'Osteoarthritis',
            'treatment' => 'Warm compress, gentle joint exercises',
            'prescription' => 'Paracetamol 500mg as needed for pain',
            'next_visit' => '2026-03-01',
        ]);

        MedicalRecord::create([
            'record_code' => 'MR-2026-004',
            'patient_id' => $p4->id,
            'consultation_id' => $c4->id,
            'date' => '2026-02-04',
            'complaint' => 'Joint pain in knees and right wrist',
            'diagnosis' => 'Osteoarthritis',
            'vitals' => '138/88 mmHg, 36.7°C, 70 bpm',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
        ]);

        // 4. Seed Prescriptions
        $rx1 = Prescription::create([
            'prescription_code' => 'RX-2026-001',
            'patient_id' => $p1->id,
            'date' => '2026-02-06',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
        ]);
        PrescriptionItem::create([
            'prescription_id' => $rx1->id,
            'medicine_name' => 'Amlodipine',
            'dosage' => '5mg',
            'frequency' => 'Once daily in the morning',
            'duration' => '30 days',
            'instructions' => 'Take after breakfast with water',
        ]);
        PrescriptionItem::create([
            'prescription_id' => $rx1->id,
            'medicine_name' => 'Paracetamol',
            'dosage' => '500mg',
            'frequency' => 'Every 6 hours as needed',
            'duration' => '5 days',
            'instructions' => 'For headache or fever only',
        ]);

        $rx2 = Prescription::create([
            'prescription_code' => 'RX-2026-002',
            'patient_id' => $p2->id,
            'date' => '2026-02-06',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
        ]);
        PrescriptionItem::create([
            'prescription_id' => $rx2->id,
            'medicine_name' => 'Metformin',
            'dosage' => '500mg',
            'frequency' => 'Twice daily after meals',
            'duration' => '30 days',
            'instructions' => 'Maintain low-sugar diet',
        ]);
        PrescriptionItem::create([
            'prescription_id' => $rx2->id,
            'medicine_name' => 'Vitamin B-Complex',
            'dosage' => '1 tablet',
            'frequency' => 'Once daily',
            'duration' => '30 days',
            'instructions' => 'Take after breakfast',
        ]);

        $rx3 = Prescription::create([
            'prescription_code' => 'RX-2026-003',
            'patient_id' => $p3->id,
            'date' => '2026-02-05',
            'attending_nurse' => 'Nurse Teresa Alonzo, RN',
        ]);
        PrescriptionItem::create([
            'prescription_id' => $rx3->id,
            'medicine_name' => 'Salbutamol Nebule',
            'dosage' => '2.5mg',
            'frequency' => 'Every 8 hours during attacks',
            'duration' => '7 days',
            'instructions' => 'Use nebulizer machine',
        ]);

        // 5. Seed Appointments
        Appointment::create([
            'appointment_code' => 'APT-2026-001',
            'patient_id' => $p1->id,
            'date' => '2026-02-15',
            'time' => '09:00 AM',
            'purpose' => 'Blood Pressure Check-up',
            'status' => 'Scheduled',
        ]);

        Appointment::create([
            'appointment_code' => 'APT-2026-002',
            'patient_id' => $p2->id,
            'date' => '2026-02-20',
            'time' => '10:30 AM',
            'purpose' => 'Fasting Blood Sugar Follow-up',
            'status' => 'Scheduled',
        ]);

        Appointment::create([
            'appointment_code' => 'APT-2026-003',
            'patient_id' => $p3->id,
            'date' => '2026-02-12',
            'time' => '02:00 PM',
            'purpose' => 'Asthma Evaluation',
            'status' => 'Scheduled',
        ]);

        // 6. Seed Notifications
        Notification::create([
            'user_id' => $admin->id,
            'title' => 'New Patient Registered',
            'message' => 'Maria Clara Santos was registered at Purok 1.',
            'type' => 'info',
            'is_read' => false,
        ]);
        Notification::create([
            'user_id' => $admin->id,
            'title' => 'Consultation Completed',
            'message' => 'Consultation CNS-101 recorded for Maria Clara Santos.',
            'type' => 'success',
            'is_read' => false,
        ]);
        Notification::create([
            'user_id' => $admin->id,
            'title' => 'Prescription Issued',
            'message' => 'Prescription RX-2026-001 issued by Nurse Teresa Alonzo.',
            'type' => 'primary',
            'is_read' => false,
        ]);
    }
}
