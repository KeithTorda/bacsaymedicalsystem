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

    /**
     * Print Selector Hub Page
     */
    public function index(Request $request)
    {
        $patients = Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])->orderBy('id', 'desc')->get();
        $records = MedicalRecord::with('patient')->orderBy('id', 'desc')->get();
        $prescriptions = Prescription::with(['patient', 'items'])->orderBy('id', 'desc')->get();

        return view('print.index', compact('patients', 'records', 'prescriptions'));
    }

    public function patient($id = null)
    {
        $patient = null;
        if ($id) {
            $patient = Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])
                ->where('id', $id)
                ->orWhere('patient_code', $id)
                ->first();
        }

        if (!$patient) {
            $patient = Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])->orderBy('id', 'desc')->first();
        }

        return view('print.patient', compact('patient'));
    }

    public function medicalRecord($id = null)
    {
        $record = null;
        if ($id) {
            $record = MedicalRecord::with(['patient.consultations', 'patient.prescriptions.items', 'consultation'])
                ->where('id', $id)
                ->orWhere('record_code', $id)
                ->first();
        }

        if (!$record) {
            $record = MedicalRecord::with(['patient.consultations', 'patient.prescriptions.items', 'consultation'])->orderBy('id', 'desc')->first();
        }

        $patient = $record->patient ?? Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])->first();

        return view('print.medical_record', compact('record', 'patient'));
    }

    public function consultation($id = null)
    {
        $consultation = null;
        if ($id) {
            $consultation = Consultation::with('patient')
                ->where('id', $id)
                ->orWhere('consultation_code', $id)
                ->first();
        }

        if (!$consultation) {
            $consultation = Consultation::with('patient')->orderBy('id', 'desc')->first();
        }

        $patient = $consultation->patient ?? Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])->first();

        return view('print.consultation', compact('consultation', 'patient'));
    }

    public function prescription($id = null)
    {
        $prescription = null;
        if ($id) {
            $prescription = Prescription::with(['patient', 'items'])
                ->where('id', $id)
                ->orWhere('prescription_code', $id)
                ->first();
        }

        if (!$prescription) {
            $prescription = Prescription::with(['patient', 'items'])->orderBy('id', 'desc')->first();
        }

        $patient = $prescription->patient ?? Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])->first();

        return view('print.prescription', compact('prescription', 'patient'));
    }

    public function referral($id = null)
    {
        $patient = null;
        if ($id) {
            $patient = Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])
                ->where('id', $id)
                ->orWhere('patient_code', $id)
                ->first();
        }

        if (!$patient) {
            $patient = Patient::with(['consultations', 'medicalRecords', 'prescriptions.items'])->first();
        }

        return view('print.referral', compact('patient'));
    }
}
