<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Notification;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $appointments = Appointment::with('patient')->latest()->get();
        $patients = Patient::orderBy('name')->get();
        return view('appointments.index', compact('appointments', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date'       => 'required|date',
            'purpose'    => 'required|string',
        ]);

        $patient = Patient::findOrFail($request->patient_id);
        $year = date('Y');
        $count = Appointment::whereYear('created_at', $year)->count() + 1;
        $code = 'APT-' . $year . '-' . sprintf('%03d', $count);

        Appointment::create([
            'appointment_code' => $code,
            'patient_id'       => $patient->id,
            'date'             => $request->date,
            'time'             => $request->time ?? '09:00 AM',
            'purpose'          => $request->purpose,
            'status'           => $request->status ?? 'Scheduled',
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'title'   => 'Appointment Scheduled',
            'message' => "Appointment {$code} scheduled for {$patient->name} on {$request->date}.",
            'type'    => 'info'
        ]);

        return redirect()->route('appointments.index')->with('success', "Appointment Scheduled Successfully for {$patient->name}!");
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'status' => $request->status ?? 'Completed'
        ]);

        return redirect()->route('appointments.index')->with('success', "Appointment status updated to {$appointment->status}!");
    }
}
