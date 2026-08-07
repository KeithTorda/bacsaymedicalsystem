<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        return view('dashboard.home', compact(
            'totalPatients',
            'todayConsultations',
            'totalPrescriptions',
            'upcomingAppointments',
            'recentConsultations',
            'recentPatients'
        ));
    }

    public function profile()
    {
        return view('dashboard.profile');
    }
}
