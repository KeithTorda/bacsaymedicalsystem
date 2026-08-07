<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Notification;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        return view('consultations.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id'      => 'required|exists:patients,id',
            'chief_complaint' => 'required|string',
            'diagnosis'       => 'required|string',
            'bp'              => 'required|string',
            'temperature'     => 'required|string',
        ]);

        $patient = Patient::findOrFail($request->patient_id);
        $count = Consultation::count() + 101;
        $consultationCode = 'CNS-' . $count;

        $consultation = Consultation::create([
            'consultation_code' => $consultationCode,
            'patient_id'        => $patient->id,
            'visit_date'        => $request->visit_date ?? date('Y-m-d'),
            'attending_nurse'   => $request->attending_nurse ?? 'Nurse Teresa Alonzo, RN',
            'chief_complaint'   => $request->chief_complaint,
            'bp'                => $request->bp,
            'temperature'       => $request->temperature,
            'pulse_rate'        => $request->pulse_rate,
            'respiratory_rate'  => $request->respiratory_rate,
            'height'            => $request->height,
            'weight'            => $request->weight,
            'diagnosis'         => $request->diagnosis,
            'treatment'         => $request->treatment,
            'prescription'      => $request->prescription,
            'next_visit'        => $request->next_visit,
        ]);

        // Auto create corresponding Medical Record entry
        $mrYear = date('Y');
        $mrCount = MedicalRecord::whereYear('created_at', $mrYear)->count() + 1;
        $mrCode = 'MR-' . $mrYear . '-' . sprintf('%03d', $mrCount);

        MedicalRecord::create([
            'record_code'     => $mrCode,
            'patient_id'      => $patient->id,
            'consultation_id' => $consultation->id,
            'date'            => $consultation->visit_date,
            'complaint'       => $consultation->chief_complaint,
            'diagnosis'       => $consultation->diagnosis,
            'vitals'          => "{$request->bp} mmHg, {$request->temperature}°C, {$request->pulse_rate} bpm",
            'attending_nurse' => $consultation->attending_nurse,
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'title'   => 'Consultation Recorded',
            'message' => "Consultation {$consultationCode} logged for {$patient->name}.",
            'type'    => 'success'
        ]);

        return redirect()->route('medical-records.index')->with('success', "Consultation {$consultationCode} Saved & Medical Record Automatically Created for {$patient->name}!");
    }
}
