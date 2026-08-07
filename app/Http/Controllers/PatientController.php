<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('patient_code', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $patients = $query->latest()->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return redirect()->route('patients.index')->with('open_add_modal', true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'birthdate'  => 'required|date',
            'sex'        => 'required|string',
            'contact'    => 'required|string',
            'address'    => 'required|string',
        ]);

        $year = date('Y');
        $count = Patient::whereYear('created_at', $year)->count() + 1;
        $patientCode = 'BAC-' . $year . '-' . sprintf('%03d', $count);

        // Calculate age
        $age = Carbon::parse($request->birthdate)->age;
        $fullName = trim($request->first_name . ' ' . ($request->middle_name ? $request->middle_name . ' ' : '') . $request->last_name);

        $patient = Patient::create([
            'patient_code' => $patientCode,
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'middle_name'  => $request->middle_name,
            'name'         => $fullName,
            'birthdate'    => $request->birthdate,
            'age'          => $age,
            'sex'          => $request->sex,
            'civil_status' => $request->civil_status ?? 'Single',
            'blood_type'   => $request->blood_type ?? 'O+',
            'contact'      => $request->contact,
            'address'      => $request->address,
            'allergies'    => $request->allergies,
            'diseases'     => $request->diseases,
            'vaccination'  => $request->vaccination,
            'emergency_contact_name'  => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
        ]);

        Notification::create([
            'user_id' => auth()->id(),
            'title'   => 'New Patient Registered',
            'message' => "Patient {$fullName} ({$patientCode}) was successfully registered.",
            'type'    => 'info'
        ]);

        return redirect()->route('patients.index')->with('success', "New Patient {$fullName} Registered Successfully!");
    }

    public function show($id)
    {
        $patient = Patient::with(['consultations', 'medicalRecords', 'prescriptions.items', 'appointments'])
            ->where('id', $id)
            ->orWhere('patient_code', $id)
            ->firstOrFail();

        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Patient::where('id', $id)->orWhere('patient_code', $id)->firstOrFail();
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        $patient = Patient::where('id', $id)->orWhere('patient_code', $id)->firstOrFail();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'birthdate'  => 'required|date',
            'sex'        => 'required|string',
            'contact'    => 'required|string',
            'address'    => 'required|string',
        ]);

        $age = Carbon::parse($request->birthdate)->age;
        $fullName = trim($request->first_name . ' ' . ($request->middle_name ? $request->middle_name . ' ' : '') . $request->last_name);

        $patient->update([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'middle_name'  => $request->middle_name,
            'name'         => $fullName,
            'birthdate'    => $request->birthdate,
            'age'          => $age,
            'sex'          => $request->sex,
            'civil_status' => $request->civil_status,
            'blood_type'   => $request->blood_type,
            'contact'      => $request->contact,
            'address'      => $request->address,
            'allergies'    => $request->allergies,
            'diseases'     => $request->diseases,
            'vaccination'  => $request->vaccination,
            'emergency_contact_name'  => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
        ]);

        return redirect()->route('patients.index')->with('success', "Patient record for {$fullName} updated successfully!");
    }

    public function destroy($id)
    {
        $patient = Patient::where('id', $id)->orWhere('patient_code', $id)->firstOrFail();
        $name = $patient->name;
        $patient->delete();

        return redirect()->route('patients.index')->with('success', "Patient Record for {$name} removed successfully!");
    }
}
