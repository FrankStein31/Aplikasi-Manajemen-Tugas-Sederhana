@extends('layouts.admin.app')
@section('title', 'Tambah Data Tugas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-plus mr-2"></i>Tambah Data Tugas</h1>
</div>

<div class="card shadow border-0 mb-4">
    {{-- Header Bar --}}
    <div class="p-3" style="background-color: #4e73df; border-top-left-radius: 4px; border-top-right-radius: 4px;">
        <a href="{{ route('admin.tugas.index') }}" class="btn btn-success btn-sm px-3" style="background-color: #1cc88a; border-color: #1cc88a; font-weight: bold; border-radius: 4px;">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>
    
    <div class="card-body p-4">
        <form action="{{ route('admin.tugas.store') }}" method="POST">
            @csrf

            {{-- Karyawan --}}
            <div class="form-group mb-4">
                <label class="font-weight-semibold text-gray-700">
                    <span class="text-danger">*</span> Pilih Karyawan :
                </label>
                <select name="user_id" id="user_id" class="form-control form-control-lg @error('user_id') is-invalid @enderror" required>
                    <option value="" disabled selected>-- Pilih Karyawan --</option>
                    @foreach($karyawan as $k)
                        <option value="{{ $k->id }}" data-email="{{ $k->email }}">{{ $k->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            {{-- Email (Read-only representation) --}}
            <div class="form-group mb-4" id="emailWrapper" style="display: none;">
                <label class="font-weight-semibold text-gray-700">Email Karyawan :</label>
                <input type="text" id="karyawanEmail" class="form-control form-control-lg" readonly>
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
                    placeholder="Masukkan Deskripsi Tugas"
                    required
                >{{ old('tugas') }}</textarea>
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
                        value="{{ old('tgl_mulai') }}"
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
                        value="{{ old('tgl_selesai') }}"
                        required
                    >
                    @error('tgl_selesai')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
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

@push('scripts')
<script>
$(document).ready(function() {
    $('#user_id').on('change', function() {
        const email = $(this).find(':selected').data('email');
        if (email) {
            $('#karyawanEmail').val(email);
            $('#emailWrapper').slideDown();
        } else {
            $('#emailWrapper').slideUp();
        }
    });
});
</script>
@endpush
