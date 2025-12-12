@extends('layouts.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-wrapper">
                        <div class="page-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div>
                            <h1 class="page-title">Profil Pengguna</h1>
                            <p class="page-subtitle">Kelola informasi profil dan keamanan akun Anda</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Profile Information -->
            <div class="data-card mb-4">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-person-badge"></i>
                        <span>Informasi Profil</span>
                    </div>
                </div>
                <div class="data-card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="data-card mb-4">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-key"></i>
                        <span>Update Password</span>
                    </div>
                </div>
                <div class="data-card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="data-card mb-4">
                <div class="data-card-header">
                    <div class="data-card-title">
                        <i class="bi bi-trash"></i>
                        <span>Hapus Akun</span>
                    </div>
                </div>
                <div class="data-card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
