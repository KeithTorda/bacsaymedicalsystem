<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function daily()
    {
        $today = Carbon::today()->format('Y-m-d');
        $consultations = Consultation::with('patient')->whereDate('visit_date', $today)->get();
        $totalPatientsToday = $consultations->pluck('patient_id')->unique()->count();
        $prescriptionsToday = Prescription::whereDate('date', $today)->count();

        $stats = [
            'total_consultations' => $consultations->count(),
            'total_patients' => $totalPatientsToday,
            'prescriptions_issued' => $prescriptionsToday,
        ];

        return view('reports.daily', compact('consultations', 'stats', 'today'));
    }

    public function monthly()
    {
        $currentMonth = Carbon::now()->format('F Y');
        $consultations = Consultation::with('patient')
            ->whereMonth('visit_date', Carbon::now()->month)
            ->whereYear('visit_date', Carbon::now()->year)
            ->get();

        $totalPatients = Patient::count();
        $totalPrescriptions = Prescription::count();

        return view('reports.monthly', compact('consultations', 'currentMonth', 'totalPatients', 'totalPrescriptions'));
    }

    public function patients()
    {
        $patients = Patient::withCount(['consultations', 'prescriptions'])->get();
        return view('reports.patients', compact('patients'));
    }
}
