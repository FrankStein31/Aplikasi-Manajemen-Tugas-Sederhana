@extends('layouts.admin.app')
@section('title', 'Edit Profile')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user-cog mr-2"></i>Edit Profile</h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <img class="img-profile rounded-circle mb-3" src="{{ asset('sbadmin/img/undraw_profile.svg') }}" style="width:80px; height:80px;">
                    <h5 class="font-weight-bold">{{ session('name') }}</h5>
                    <span class="badge badge-primary">{{ ucfirst(session('jabatan')) }}</span>
                </div>
                <form action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Password Baru <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password baru" required minlength="6">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Ulangi password baru" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save mr-1"></i> Simpan Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
