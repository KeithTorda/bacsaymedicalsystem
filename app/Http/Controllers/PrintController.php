<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Consultation;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patient($id)
    {
        $patient = Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])->where('id', $id)->orWhere('patient_code', $id)->firstOrFail();
        return view('print.patient', compact('patient'));
    }

    public function medicalRecord($id)
    {
        $record = MedicalRecord::with(['patient', 'consultation'])->where('id', $id)->orWhere('record_code', $id)->firstOrFail();
        return view('print.medical_record', compact('record'));
    }

    public function consultation($id)
    {
        $consultation = Consultation::with('patient')->where('id', $id)->orWhere('consultation_code', $id)->firstOrFail();
        return view('print.consultation', compact('consultation'));
    }

    public function prescription($id)
    {
        $prescription = Prescription::with(['patient', 'items'])->where('id', $id)->orWhere('prescription_code', $id)->firstOrFail();
        return view('print.prescription', compact('prescription'));
    }

    public function referral($id)
    {
        $patient = Patient::where('id', $id)->orWhere('patient_code', $id)->firstOrFail();
        return view('print.referral', compact('patient'));
    }
}
