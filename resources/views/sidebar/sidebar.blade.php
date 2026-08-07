<div class="sidebar" id="sidebar">
    <!-- Custom Mobile Drawer Header with Close (X) Button -->
    <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom d-lg-none" id="mobile_sidebar_header">
        <span class="fw-bold fs-6 text-primary d-flex align-items-center gap-2">
            <img src="{{ asset('assets/img/bacsaymedsys-icon.svg') }}" alt="BacsayMedSys" style="width: 24px; height: 24px;"> BacsayMedSys
        </span>
        <button type="button" id="custom_mobile_close_btn" class="btn btn-sm btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <!-- Dashboard -->
                <li class="{{ set_active(['home']) }}">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-chart-line fs-5 me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Patients -->
                <li class="submenu {{ set_active(['patients*', 'patients/create*']) }}">
                    <a href="javascript:void(0);">
                        <i class="fas fa-users fs-5 me-2"></i>
                        <span>Patients</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('patients.index') }}" class="{{ set_active(['patients']) }}">Patient List</a></li>
                        <li><a href="{{ route('patients.create') }}" class="{{ set_active(['patients/create']) }}">Register Patient</a></li>
                    </ul>
                </li>

                <!-- Medical Records -->
                <li class="submenu {{ set_active(['medical-records*']) }}">
                    <a href="javascript:void(0);">
                        <i class="fas fa-file-medical fs-5 me-2"></i>
                        <span>Medical Records</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('medical-records.index') }}" class="{{ set_active(['medical-records']) }}">Consultation Records</a></li>
                        <li><a href="{{ route('medical-records.history') }}">Medical History</a></li>
                        <li><a href="{{ route('medical-records.vitals') }}">Vital Signs</a></li>
                    </ul>
                </li>

                <!-- Appointments -->
                <li class="{{ set_active(['appointments*']) }}">
                    <a href="{{ route('appointments.index') }}">
                        <i class="fas fa-calendar-check fs-5 me-2"></i>
                        <span>Appointments</span>
                    </a>
                </li>

                <!-- Prescriptions -->
                <li class="{{ set_active(['prescriptions*']) }}">
                    <a href="{{ route('prescriptions.index') }}">
                        <i class="fas fa-pills fs-5 me-2"></i>
                        <span>Prescriptions</span>
                    </a>
                </li>

                <!-- Reports -->
                <li class="submenu {{ set_active(['reports*']) }}">
                    <a href="javascript:void(0);">
                        <i class="fas fa-chart-bar fs-5 me-2"></i>
                        <span>Reports</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('reports.daily') }}">Daily Reports</a></li>
                        <li><a href="{{ route('reports.monthly') }}">Monthly Reports</a></li>
                        <li><a href="{{ route('reports.patients') }}">Patient Reports</a></li>
                    </ul>
                </li>

                <!-- Print Records -->
                <li class="submenu {{ set_active(['print*']) }}">
                    <a href="javascript:void(0);">
                        <i class="fas fa-print fs-5 me-2"></i>
                        <span>Print Records</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="{{ route('print.index') }}" class="{{ set_active(['print']) }}">Print Center Hub</a></li>
                        <li><a href="{{ route('print.patient') }}" target="_blank">Patient Information Sheet</a></li>
                        <li><a href="{{ route('print.medical-record') }}" target="_blank">Clinical Medical Record</a></li>
                        <li><a href="{{ route('print.consultation') }}" target="_blank">Consultation Form</a></li>
                        <li><a href="{{ route('print.prescription') }}" target="_blank">Prescription Form (Rx)</a></li>
                        <li><a href="{{ route('print.referral') }}" target="_blank">Referral Form</a></li>
                    </ul>
                </li>

                <!-- Users -->
                <li class="{{ set_active(['users*']) }}">
                    <a href="{{ route('users.index') }}">
                        <i class="fas fa-user-shield fs-5 me-2"></i>
                        <span>Users</span>
                    </a>
                </li>

                <!-- Settings -->
                <li class="{{ set_active(['settings*']) }}">
                    <a href="{{ route('settings') }}">
                        <i class="fas fa-cog fs-5 me-2"></i>
                        <span>Settings</span>
                    </a>
                </li>

                <!-- Logout -->
                <li>
                    <a href="{{ route('logout') }}" class="text-danger">
                        <i class="fas fa-sign-out-alt fs-5 me-2 text-danger"></i>
                        <span class="text-danger">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>