@extends('layouts.master')
@section('content')
    <!-- Page-content -->
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Profile</h4>
                    <h6>User Profile</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="profile-set">
                        <div class="profile-head">
                        </div>
                        <div class="profile-top">
                            <div class="profile-content">
                                <div class="profile-contentimg">
                                    <img src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" alt="User Avatar" id="blah" style="border-radius: 50%;">
                                    <div class="profileupload">
                                        <input type="file" id="imgInp">
                                        <a href="javascript:void(0);">
                                            <img src="{{ asset('assets/img/icons/edit-set.svg') }}" alt="img">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-contentname">
                                    <h2>{{ Auth::user()->name ?? 'KBOT Admin' }}</h2>
                                    <h4>Update Your Photo and Personal Details.</h4>
                                </div>
                            </div>
                            <div class="ms-auto">
                                <a href="javascript:void(0);" class="btn btn-submit me-2">Save</a>
                                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" value="{{ explode(' ', Auth::user()->name ?? 'KBOT Admin')[0] }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" value="{{ explode(' ', Auth::user()->name ?? 'KBOT Admin')[1] ?? 'Admin' }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" value="{{ Auth::user()->email ?? 'admin@gmail.com' }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" value="+63 900 000 0000">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" value="{{ Auth::user()->user_id ?? 'ID0001' }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Password</label>
                                <div class="pass-group">
                                    <input type="password" class="pass-input" placeholder="••••••••">
                                    <span class="fas toggle-password fa-eye-slash"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
@endsection