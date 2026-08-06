<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patient($id)
    {
        return view('print.patient', ['id' => $id]);
    }

    public function medicalRecord($id)
    {
        return view('print.medical_record', ['id' => $id]);
    }

    public function consultation($id)
    {
        return view('print.consultation', ['id' => $id]);
    }

    public function prescription($id)
    {
        return view('print.prescription', ['id' => $id]);
    }

    public function referral($id)
    {
        return view('print.referral', ['id' => $id]);
    }
}
