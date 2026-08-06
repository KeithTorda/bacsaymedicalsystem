<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function daily()
    {
        return view('reports.daily');
    }

    public function monthly()
    {
        return view('reports.monthly');
    }

    public function patients()
    {
        return view('reports.patients');
    }
}
