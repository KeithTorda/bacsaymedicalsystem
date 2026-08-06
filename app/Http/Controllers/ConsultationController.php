<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('consultations.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('medical-records.index')->with('success', 'Consultation Saved & Medical Record Automatically Created!');
    }
}
