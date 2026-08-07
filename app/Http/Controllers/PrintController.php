<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Print Selector Hub Page
     */
    public function index(Request $request)
    {
        $patients = Patient::with(['medicalRecords', 'prescriptions'])->orderBy('full_name', 'asc')->get();
        $records = MedicalRecord::with('patient')->orderBy('id', 'desc')->get();
        $prescriptions = Prescription::with('patient')->orderBy('id', 'desc')->get();

        return view('print.index', compact('patients', 'records', 'prescriptions'));
    }

    public function patient($id = 1)
    {
        $patient = Patient::with(['medicalRecords', 'prescriptions'])->find($id) 
                ?? Patient::with(['medicalRecords', 'prescriptions'])->first() 
                ?? new Patient([
                    'patient_id' => 'BAC-2026-001',
                    'full_name' => 'Maria Clara Santos',
                    'date_of_birth' => '1992-03-15',
                    'sex' => 'female',
                    'civil_status' => 'Married',
                    'contact_number' => '0917-123-4567',
                    'address' => 'Purok 1, Barangay Bacsay',
                    'allergies' => 'Penicillin, Sulfa Drugs',
                    'created_at' => now(),
                ]);

        return view('print.patient', compact('patient'));
    }

    public function medicalRecord($id = 1)
    {
        $record = MedicalRecord::with('patient')->find($id) 
                ?? MedicalRecord::with('patient')->first() 
                ?? new MedicalRecord([
                    'record_code' => 'MR-2026-001',
                    'diagnosis' => 'Essential Hypertension Stage I',
                    'symptoms' => 'Occasional headache, dizziness',
                    'treatment' => 'Amlodipine 5mg OD x 30 days, low salt diet',
                    'created_at' => now(),
                ]);

        if (!$record->patient) {
            $record->setRelation('patient', $this->patient($id)->patient ?? Patient::first());
        }

        return view('print.medical_record', compact('record'));
    }

    public function consultation($id = 1)
    {
        $patient = Patient::with('medicalRecords')->find($id) ?? Patient::first();
        $record = MedicalRecord::where('patient_id', $id)->first() ?? MedicalRecord::first();

        return view('print.consultation', compact('patient', 'record'));
    }

    public function prescription($id = 1)
    {
        $prescription = Prescription::with('patient')->find($id) 
                     ?? Prescription::with('patient')->first();
        
        $patient = $prescription->patient ?? Patient::find($id) ?? Patient::first();

        return view('print.prescription', compact('prescription', 'patient'));
    }

    public function referral($id = 1)
    {
        $patient = Patient::with('medicalRecords')->find($id) ?? Patient::first();

        return view('print.referral', compact('patient'));
    }
}
