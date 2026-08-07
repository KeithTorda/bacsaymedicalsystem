@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>System Users & Staff Management</h4>
                <h6>Manage Barangay Bacsay Health Center Authorized Accounts & Role Privileges</h6>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus me-1"></i> Add New User
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datanew table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $usr)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><span class="badge bg-outline-secondary fw-bold">{{ $usr->user_id ?? 'KH-000' . ($key + 1) }}</span></td>
                                <td class="fw-semibold">{{ $usr->name }}</td>
                                <td>{{ $usr->email }}</td>
                                <td>{{ $usr->phone_number ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $role = $usr->role_name ?? 'Staff';
                                        $badgeClass = match($role) {
                                            'Admin' => 'bg-danger-subtle text-danger border-danger',
                                            'Doctor' => 'bg-primary-subtle text-primary border-primary',
                                            'Nurse' => 'bg-info-subtle text-info border-info',
                                            'Health Worker' => 'bg-success-subtle text-success border-success',
                                            default => 'bg-secondary-subtle text-secondary border-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} border fw-bold">{{ $role }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('users.toggle-status', $usr->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm p-0 border-0 background-none" title="Click to toggle status">
                                            @if(($usr->status ?? 'Active') === 'Active')
                                                <span class="badge bg-success text-white fw-bold"><i class="fas fa-check-circle me-1"></i> Active</span>
                                            @else
                                                <span class="badge bg-secondary text-white fw-bold"><i class="fas fa-minus-circle me-1"></i> Inactive</span>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $usr->id }}" title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    @if(auth()->id() != $usr->id)
                                    <form action="{{ route('users.destroy', $usr->id) }}" method="POST" class="d-inline delete-user-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete User">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>

                            <!-- Edit User Modal -->
                            <div class="modal fade" id="editUserModal{{ $usr->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold"><i class="fas fa-user-edit text-primary me-2"></i> Edit User Account</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('users.update', $usr->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $usr->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email Address</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $usr->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Role Designation</label>
                                                    <select name="role_name" class="form-select" required>
                                                        <option value="Admin" {{ ($usr->role_name ?? '') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="Doctor" {{ ($usr->role_name ?? '') == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                                                        <option value="Nurse" {{ ($usr->role_name ?? '') == 'Nurse' ? 'selected' : '' }}>Nurse</option>
                                                        <option value="Health Worker" {{ ($usr->role_name ?? '') == 'Health Worker' ? 'selected' : '' }}>Health Worker</option>
                                                        <option value="Staff" {{ ($usr->role_name ?? '') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="text" name="phone_number" class="form-control" value="{{ $usr->phone_number }}" placeholder="0917-000-0000">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Account Status</label>
                                                    <select name="status" class="form-select">
                                                        <option value="Active" {{ ($usr->status ?? 'Active') == 'Active' ? 'selected' : '' }}>Active</option>
                                                        <option value="Inactive" {{ ($usr->status ?? '') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">New Password <small class="text-muted">(Leave blank to keep current password)</small></label>
                                                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update User</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add New User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="fas fa-user-plus text-primary me-2"></i> Register New System User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Dr. Teresa Alonzo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="user@bacsayhealth.gov.ph" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role Designation <span class="text-danger">*</span></label>
                        <select name="role_name" class="form-select" required>
                            <option value="Staff">Staff</option>
                            <option value="Health Worker">Health Worker</option>
                            <option value="Nurse">Nurse</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="0917-123-4567">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Create account password" required minlength="6">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check me-1"></i> Register Account</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
