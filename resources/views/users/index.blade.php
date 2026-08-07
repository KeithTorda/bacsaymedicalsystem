@extends('layouts.master')

@section('content')
<div class="page-wrapper">
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

        @php
            $users = \App\Models\User::all();
        @endphp

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
                                <th>User ID</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $usr)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="fw-semibold text-dark">{{ $usr->name }}</td>
                                <td>{{ $usr->email }}</td>
                                <td><span class="badge {{ $usr->role_name == 'Admin' ? 'bg-primary' : 'bg-info' }}">{{ $usr->role_name ?? 'User' }}</span></td>
                                <td><span class="badge bg-success-subtle text-success fw-bold">{{ $usr->status ?? 'Active' }}</span></td>
                                <td><span class="badge bg-outline-secondary">{{ $usr->user_id ?? 'ID000' . ($key + 1) }}</span></td>
                                <td class="text-center">
                                    <a href="#" class="me-2 text-primary" data-bs-toggle="tooltip" title="Edit User"><i class="fas fa-edit fs-6"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
