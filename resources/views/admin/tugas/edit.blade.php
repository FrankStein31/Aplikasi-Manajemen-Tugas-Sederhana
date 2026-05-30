@extends('layouts.admin.app')
@section('title', 'Edit Data Tugas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-edit mr-2"></i>Edit Data Tugas</h1>
</div>

<div class="card shadow border-0 mb-4">
    {{-- Header Bar (Yellow) --}}
    <div class="p-3" style="background-color: #f6c23e; border-top-left-radius: 4px; border-top-right-radius: 4px;">
        <a href="{{ route('admin.tugas.index') }}" class="btn btn-success btn-sm px-3" style="background-color: #1cc88a; border-color: #1cc88a; font-weight: bold; border-radius: 4px;">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
    
    <div class="card-body p-4">
        <form action="{{ route('admin.tugas.update', $tugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Hidden input for user_id to maintain consistency --}}
            <input type="hidden" name="user_id" value="{{ $tugas->user_id }}">

            <div class="row">
                {{-- Nama (Disabled) --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Nama :
                    </label>
                    <input
                        type="text"
                        class="form-control form-control-lg bg-light"
                        value="{{ $tugas->user->name ?? '-' }}"
                        disabled
                    >
                </div>
                
                {{-- Email (Disabled) --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Email :
                    </label>
                    <input
                        type="text"
                        class="form-control form-control-lg bg-light"
                        value="{{ $tugas->user->email ?? '-' }}"
                        disabled
                    >
                </div>
            </div>

            {{-- Tugas --}}
            <div class="form-group mb-4">
                <label class="font-weight-semibold text-gray-700">
                    <span class="text-danger">*</span> Tugas :
                </label>
                <textarea
                    name="tugas"
                    class="form-control form-control-lg @error('tugas') is-invalid @enderror"
                    rows="4"
                    required
                >{{ old('tugas', $tugas->tugas) }}</textarea>
                @error('tugas')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="row">
                {{-- Tanggal Mulai --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Tanggal Mulai :
                    </label>
                    <input
                        type="date"
                        name="tgl_mulai"
                        class="form-control form-control-lg @error('tgl_mulai') is-invalid @enderror"
                        value="{{ old('tgl_mulai', $tugas->tgl_mulai ? $tugas->tgl_mulai->format('Y-m-d') : '') }}"
                        required
                    >
                    @error('tgl_mulai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                
                {{-- Tanggal Selesai --}}
                <div class="col-md-6 form-group mb-4">
                    <label class="font-weight-semibold text-gray-700">
                        <span class="text-danger">*</span> Tanggal Selesai :
                    </label>
                    <input
                        type="date"
                        name="tgl_selesai"
                        class="form-control form-control-lg @error('tgl_selesai') is-invalid @enderror"
                        value="{{ old('tgl_selesai', $tugas->tgl_selesai ? $tugas->tgl_selesai->format('Y-m-d') : '') }}"
                        required
                    >
                    @error('tgl_selesai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Tombol Update --}}
            <div>
                <button type="submit" class="btn btn-warning text-white px-4" style="background-color: #f6c23e; border-color: #f6c23e; border-radius: 4px;">
                    <i class="fas fa-edit mr-1"></i> Update
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
