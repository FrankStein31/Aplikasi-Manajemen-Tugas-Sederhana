@extends('layouts.admin.app')
@section('title', 'Tambah Data User')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus mr-2"></i>Tambah Data User</h1>
</div>

<div class="card shadow border-0 mb-4">
    {{-- Header Bar --}}
    <div class="p-3" style="background-color: #4e73df; border-top-left-radius: 4px; border-top-right-radius: 4px;">
        <a href="{{ route('admin.user.index') }}" class="btn btn-success btn-sm px-3" style="background-color: #1cc88a; border-color: #1cc88a; font-weight: bold; border-radius: 4px;">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
    
    <div class="card-body p-4">
        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf

            <div class="row">
                {{-- Nama --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Nama :
                    </label>
                    <input
                        type="text"
                        name="name"
                        class="form-control form-control-lg @error('name') is-invalid @enderror"
                        placeholder="Masukkan Nama"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                {{-- Email --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Email :
                    </label>
                    <input
                        type="email"
                        name="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        placeholder="Masukkan Email"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Jabatan --}}
            <div class="form-group mb-4">
                <label class="font-weight-semibold text-gray-700">
                    <span class="text-danger">*</span> Jabatan :
                </label>
                <select name="jabatan" class="form-control form-control-lg @error('jabatan') is-invalid @enderror" required>
                    <option value="" disabled {{ old('jabatan') === null ? 'selected' : '' }}>-- Pilih Jabatan --</option>
                    <option value="admin" {{ old('jabatan') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="karyawan" {{ old('jabatan') === 'karyawan' ? 'selected' : '' }}>Karyawan</option>
                </select>
                @error('jabatan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                {{-- Password --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Password :
                    </label>
                    <input
                        type="password"
                        name="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        placeholder="Masukkan Password"
                        required
                    >
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                {{-- Konfirmasi Password --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Konfirmasi Password :
                    </label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control form-control-lg"
                        placeholder="Masukkan Konfirmasi Password"
                        required
                    >
                </div>
            </div>

            {{-- Tombol Simpan --}}
            <div>
                <button type="submit" class="btn btn-primary px-4" style="background-color: #4e73df; border-color: #4e73df; border-radius: 4px;">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
