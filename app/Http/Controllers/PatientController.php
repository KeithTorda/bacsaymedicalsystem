<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Mock patient records for Barangay Bacsay Health Center
        $patients = [
            [
                'id' => 'BAC-2026-001',
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
                'created_at' => '2026-01-10'
            ],
            [
                'id' => 'BAC-2026-002',
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
                'created_at' => '2026-01-15'
            ],
            [
                'id' => 'BAC-2026-003',
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
                'created_at' => '2026-02-01'
            ],
            [
                'id' => 'BAC-2026-004',
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
                'created_at' => '2026-02-04'
            ]
        ];

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('patients.index')->with('success', 'New Patient Registered Successfully at Barangay Bacsay Health Center!');
    }

    public function show($id)
    {
        $patient = [
            'id' => 'BAC-2026-001',
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
            'created_at' => '2026-01-10',
            'consultations' => [
                [
                    'id' => 'CNS-101',
                    'date' => '2026-02-06',
                    'complaint' => 'Persistent headache and dizziness since yesterday',
                    'bp' => '130/85 mmHg',
                    'temp' => '36.8 °C',
                    'pulse' => '78 bpm',
                    'resp' => '18 cpm',
                    'height' => '158 cm',
                    'weight' => '56 kg',
                    'diagnosis' => 'Mild Essential Hypertension',
                    'treatment' => 'Lifestyle modification, reduced sodium diet, bed rest',
                    'prescription' => 'Amlodipine 5mg - 1 tablet daily for 30 days',
                    'attending_nurse' => 'Nurse Teresa Alonzo, RN'
                ]
            ]
        ];

        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = [
            'id' => 'BAC-2026-001',
            'name' => 'Maria Clara Santos',
            'birthdate' => 'March 15, 1992',
            'birthdate_raw' => '1992-03-15',
            'age' => 34,
            'sex' => 'Female',
            'civil_status' => 'Married',
            'blood_type' => 'O+',
            'contact' => '09171234567',
            'address' => 'Purok 1, Barangay Bacsay',
            'allergies' => 'Penicillin',
            'diseases' => 'Hypertension',
            'vaccination' => 'COVID-19 (Booster)',
        ];

        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('patients.index')->with('success', 'Patient Information Updated Successfully!');
    }

    public function destroy($id)
    {
        return redirect()->route('patients.index')->with('success', 'Patient Record Removed Successfully!');
    }
}
