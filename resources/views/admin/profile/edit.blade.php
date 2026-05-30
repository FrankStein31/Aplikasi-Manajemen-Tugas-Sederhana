@extends('layouts.admin.app')
@section('title', 'Edit Password')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit mr-2"></i>Edit Password</h1>
</div>

{{-- Yellow bar --}}
<div style="background: #f6c23e; height: 10px; border-radius: 4px; margin-bottom: 24px;"></div>

<div class="card shadow border-0">
    <div class="card-body p-4">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Password Lama --}}
            <div class="form-group mb-4">
                <label class="font-weight-semibold text-gray-700">
                    <span class="text-danger">*</span> Password Lama :
                </label>
                <div class="input-group">
                    <input
                        type="password"
                        name="password_lama"
                        class="form-control form-control-lg @error('password_lama') is-invalid @enderror"
                        placeholder=""
                    >
                    @error('password_lama')
                        <div class="input-group-append">
                            <span class="input-group-text border-danger bg-white text-danger">
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                        </div>
                    @enderror
                </div>
                @error('password_lama')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Password Baru & Konfirmasi --}}
            <div class="row">
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Password Baru :
                    </label>
                    <input
                        type="password"
                        name="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder=""
                    >
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Konfirmasi Password Baru :
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control form-control-lg"
                        placeholder=""
                    >
                </div>
            </div>

            {{-- Tombol Update --}}
            <div>
                <button type="submit" class="btn btn-warning text-white px-4">
                    <i class="fas fa-edit mr-1"></i> Update
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
