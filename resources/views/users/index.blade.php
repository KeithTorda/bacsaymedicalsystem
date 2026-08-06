@extends('layouts.master')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>System Users Management</h4>
            <h6>Barangay Bacsay Health Center Authorized Staff</h6>
        </div>
        <div class="page-btn">
            <a href="#" class="btn btn-added"><i class="fas fa-user-plus me-1"></i> Add New User</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table datanew table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td class="fw-semibold">Admin</td>
                            <td>admin@gmail.com</td>
                            <td><span class="badge bg-primary">Administrator</span></td>
                            <td><span class="badge bg-success-subtle text-success fw-bold">Active</span></td>
                            <td>Feb 06, 2026 08:15 AM</td>
                            <td class="text-center">
                                <a href="#" class="me-2 text-primary"><i class="fas fa-edit fs-6"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="fw-semibold">Nurse Teresa Alonzo</td>
                            <td>teresa.alonzo@bacsay.gov.ph</td>
                            <td><span class="badge bg-info">Nurse / Encoder</span></td>
                            <td><span class="badge bg-success-subtle text-success fw-bold">Active</span></td>
                            <td>Feb 06, 2026 07:45 AM</td>
                            <td class="text-center">
                                <a href="#" class="me-2 text-primary"><i class="fas fa-edit fs-6"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
