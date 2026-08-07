<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Update logged in user profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone'      => 'nullable|string|max:20',
            'password'   => 'nullable|string|min:6|confirmed',
        ]);

        $fullName = trim($request->first_name . ' ' . $request->last_name);

        $user->name = $fullName;
        $user->email = $request->email;
        if ($request->filled('phone')) {
            $user->phone_number = $request->phone;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Your profile details have been updated successfully!');
    }
}
