<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $prescriptions = [
            [
                'id' => 'RX-2026-001',
                'patient_name' => 'Maria Clara Santos',
                'date' => '2026-02-06',
                'medicines_count' => 2,
                'medicines_summary' => 'Amlodipine 5mg, Paracetamol 500mg',
                'attending_nurse' => 'Nurse Teresa Alonzo, RN'
            ],
            [
                'id' => 'RX-2026-002',
                'patient_name' => 'Juan Dela Cruz',
                'date' => '2026-02-06',
                'medicines_count' => 2,
                'medicines_summary' => 'Metformin 500mg, Vitamin B-Complex',
                'attending_nurse' => 'Nurse Teresa Alonzo, RN'
            ],
            [
                'id' => 'RX-2026-003',
                'patient_name' => 'Ana Marie Ramos',
                'date' => '2026-02-05',
                'medicines_count' => 1,
                'medicines_summary' => 'Salbutamol Nebule 2.5mg',
                'attending_nurse' => 'Nurse Teresa Alonzo, RN'
            ]
        ];

        return view('prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        return view('prescriptions.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('prescriptions.index')->with('success', 'Prescription Issued Successfully!');
    }
}
