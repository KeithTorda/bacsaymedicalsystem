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
        $records = MedicalRecord::with('patient')->latest()->get();
        return view('medical_records.history', compact('records'));
    }

    public function vitals(Request $request)
    {
        $records = MedicalRecord::with('patient')->latest()->get();
        return view('medical_records.vitals', compact('records'));
    }
}
