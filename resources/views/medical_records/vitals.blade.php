@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Vital Signs Monitoring Records</h4>
            <h6>Barangay Bacsay Health Center Patient Vital Signs Log</h6>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Patient Name</th>
                            <th>Blood Pressure</th>
                            <th>Temperature</th>
                            <th>Pulse Rate</th>
                            <th>Resp. Rate</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Nurse</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Feb 06, 2026</td>
                            <td class="fw-semibold">Maria Clara Santos</td>
                            <td><span class="badge bg-warning-subtle text-warning fw-bold">140/90 mmHg</span></td>
                            <td>36.5°C</td>
                            <td>80 bpm</td>
                            <td>18 cpm</td>
                            <td>160 cm</td>
                            <td>58 kg</td>
                            <td>N. Alonzo, RN</td>
                        </tr>
                        <tr>
                            <td>Feb 06, 2026</td>
                            <td class="fw-semibold">Juan Dela Cruz</td>
                            <td><span class="badge bg-success-subtle text-success fw-bold">125/80 mmHg</span></td>
                            <td>36.6°C</td>
                            <td>74 bpm</td>
                            <td>17 cpm</td>
                            <td>172 cm</td>
                            <td>78 kg</td>
                            <td>N. Alonzo, RN</td>
                        </tr>
                        <tr>
                            <td>Feb 05, 2026</td>
                            <td class="fw-semibold">Ana Marie Ramos</td>
                            <td><span class="badge bg-success-subtle text-success fw-bold">118/78 mmHg</span></td>
                            <td>37.0°C</td>
                            <td>88 bpm</td>
                            <td>22 cpm</td>
                            <td>155 cm</td>
                            <td>52 kg</td>
                            <td>N. Alonzo, RN</td>
                        </tr>
                        <tr>
                            <td>Feb 04, 2026</td>
                            <td class="fw-semibold">Roberto Garcia Jr.</td>
                            <td><span class="badge bg-danger-subtle text-danger fw-bold">160/100 mmHg</span></td>
                            <td>36.6°C</td>
                            <td>88 bpm</td>
                            <td>20 cpm</td>
                            <td>168 cm</td>
                            <td>75 kg</td>
                            <td>N. Alonzo, RN</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
