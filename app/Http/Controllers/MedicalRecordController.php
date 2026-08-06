<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $records = [
            [
                'id' => 'MR-2026-001',
                'patient_id' => 'BAC-2026-001',
                'patient_name' => 'Maria Clara Santos',
                'date' => '2026-02-06',
                'complaint' => 'Persistent headache and dizziness',
                'diagnosis' => 'Essential Hypertension',
                'vitals' => '130/85 mmHg, 36.8°C, 78 bpm',
                'attending_nurse' => 'Nurse Teresa Alonzo, RN'
            ],
            [
                'id' => 'MR-2026-002',
                'patient_id' => 'BAC-2026-002',
                'patient_name' => 'Juan Dela Cruz',
                'date' => '2026-02-06',
                'complaint' => 'Fasting blood sugar monitoring & leg pain',
                'diagnosis' => 'Type 2 Diabetes Mellitus',
                'vitals' => '125/80 mmHg, 36.6°C, 74 bpm',
                'attending_nurse' => 'Nurse Teresa Alonzo, RN'
            ],
            [
                'id' => 'MR-2026-003',
                'patient_id' => 'BAC-2026-003',
                'patient_name' => 'Ana Marie Ramos',
                'date' => '2026-02-05',
                'complaint' => 'Shortness of breath and wheezing',
                'diagnosis' => 'Acute Asthma Exacerbation',
                'vitals' => '118/78 mmHg, 37.0°C, 88 bpm',
                'attending_nurse' => 'Nurse Teresa Alonzo, RN'
            ],
            [
                'id' => 'MR-2026-004',
                'patient_id' => 'BAC-2026-004',
                'patient_name' => 'Roberto Garcia Jr.',
                'date' => '2026-02-04',
                'complaint' => 'Joint pain in knees and right wrist',
                'diagnosis' => 'Osteoarthritis',
                'vitals' => '138/88 mmHg, 36.7°C, 70 bpm',
                'attending_nurse' => 'Nurse Teresa Alonzo, RN'
            ]
        ];

        return view('medical_records.index', compact('records'));
    }

    public function history()
    {
        return view('medical_records.history');
    }

    public function vitals()
    {
        return view('medical_records.vitals');
    }
}
