<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Patient;
use App\Models\Notification;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Prescription::with(['patient', 'items']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('prescription_code', 'like', "%{$search}%")
                  ->orWhereHas('patient', function($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%")
                        ->orWhere('patient_code', 'like', "%{$search}%");
                  });
            });
        }

        $prescriptions = $query->latest()->get();
        $patients = Patient::orderBy('name')->get();

        return view('prescriptions.index', compact('prescriptions', 'patients'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        return view('prescriptions.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'date'       => 'required|date',
            'medicine'   => 'required|array|min:1',
        ]);

        $patient = Patient::findOrFail($request->patient_id);
        $year = date('Y');
        $count = Prescription::whereYear('created_at', $year)->count() + 1;
        $rxCode = 'RX-' . $year . '-' . sprintf('%03d', $count);

        $prescription = Prescription::create([
            'prescription_code' => $rxCode,
            'patient_id'        => $patient->id,
            'date'              => $request->date,
            'attending_nurse'   => $request->nurse ?? 'Nurse Teresa Alonzo, RN',
        ]);

        if (is_array($request->medicine)) {
            foreach ($request->medicine as $index => $medName) {
                if (!empty($medName)) {
                    PrescriptionItem::create([
                        'prescription_id' => $prescription->id,
                        'medicine_name'   => $medName,
                        'dosage'          => $request->dosage[$index] ?? '',
                        'frequency'       => $request->frequency[$index] ?? '',
                        'duration'        => $request->duration[$index] ?? '',
                        'instructions'    => $request->instructions[$index] ?? '',
                    ]);
                }
            }
        }

        Notification::create([
            'user_id' => auth()->id(),
            'title'   => 'Prescription Issued',
            'message' => "Prescription {$rxCode} issued for {$patient->name}.",
            'type'    => 'primary'
        ]);

        return redirect()->route('prescriptions.index')->with('success', "Prescription {$rxCode} Issued Successfully for {$patient->name}!");
    }

    public function show($id)
    {
        $prescription = Prescription::with(['patient', 'items'])->findOrFail($id);
        return view('print.prescription', ['id' => $id, 'prescription' => $prescription]);
    }
}
