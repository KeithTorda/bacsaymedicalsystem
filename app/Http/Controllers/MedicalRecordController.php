<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = MedicalRecord::with('patient');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('record_code', 'like', "%{$search}%")
                  ->orWhere('complaint', 'like', "%{$search}%")
                  ->orWhere('diagnosis', 'like', "%{$search}%")
                  ->orWhereHas('patient', function($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%")
                        ->orWhere('patient_code', 'like', "%{$search}%");
                  });
            });
        }

        $records = $query->latest()->get();
        $patients = Patient::orderBy('name')->get();

        return view('medical_records.index', compact('records', 'patients'));
    }

    public function history(Request $request)
    {
        $patients = Patient::with(['consultations' => function($q) {
            $q->latest('visit_date');
        }, 'medicalRecords'])->withCount('consultations')->orderBy('name')->get();

        return view('medical_records.history', compact('patients'));
    }

    public function vitals(Request $request)
    {
        $consultations = \App\Models\Consultation::with('patient')
            ->whereNotNull('bp')
            ->orWhereNotNull('temperature')
            ->orWhereNotNull('pulse_rate')
            ->orderBy('visit_date', 'desc')
            ->get();

        if ($consultations->isEmpty()) {
            $consultations = \App\Models\Consultation::with('patient')->latest()->get();
        }

        $records = MedicalRecord::with('patient')->latest()->get();

        return view('medical_records.vitals', compact('consultations', 'records'));
    }
}
