<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalPatients = Patient::count();
        $todayConsultations = Consultation::whereDate('visit_date', Carbon::today())->count();
        $totalPrescriptions = Prescription::count();
        $upcomingAppointments = Appointment::where('status', 'Scheduled')->count();

        $recentConsultations = Consultation::with('patient')->latest()->take(5)->get();
        $recentPatients = Patient::latest()->take(5)->get();

        // 1. Monthly Registrations Real Data
        $currentYear = Carbon::now()->year;
        $monthlyRegistrations = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyRegistrations[] = Patient::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->count();
        }

        // 2. Daily Consultations This Week Real Data (Mon to Sun)
        $startOfWeek = Carbon::now()->startOfWeek();
        $dailyConsultations = [];
        for ($i = 0; $i < 7; $i++) {
            $dayDate = $startOfWeek->copy()->addDays($i)->format('Y-m-d');
            $dailyConsultations[] = Consultation::whereDate('visit_date', $dayDate)->count();
        }

        return view('dashboard.home', compact(
            'totalPatients',
            'todayConsultations',
            'totalPrescriptions',
            'upcomingAppointments',
            'recentConsultations',
            'recentPatients',
            'monthlyRegistrations',
            'dailyConsultations'
        ));
    }

    public function profile()
    {
        return view('dashboard.profile');
    }
}
