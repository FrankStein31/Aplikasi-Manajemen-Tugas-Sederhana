@extends('layouts.karyawan.app')
@section('title', 'Data Tugas Saya')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-clipboard-list mr-2"></i>Tugas Saya</h1>
    @if($tugas->count() > 0)
    <a href="{{ route('karyawan.tugas.cetak_pdf') }}" class="btn btn-sm btn-danger shadow-sm">
        <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
    </a>
    @endif
</div>

@if($user->status === 'belum_ditugaskan')
    <div class="card shadow">
        <div class="card-body text-center py-5">
            <i class="fas fa-inbox fa-4x text-gray-300 mb-3"></i>
            <h5 class="text-gray-600">Belum Ada Tugas</h5>
            <p class="text-muted">Anda belum mendapat tugas dari admin. Silakan tunggu informasi lebih lanjut.</p>
            <a href="{{ route('karyawan.dashboard') }}" class="btn btn-primary mt-2">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
@else
    @if($tugas->count() === 0)
        <div class="card shadow">
            <div class="card-body text-center py-5">
                <i class="fas fa-tasks fa-4x text-gray-300 mb-3"></i>
                <h5 class="text-gray-600">Data Tugas Kosong</h5>
                <p class="text-muted">Tidak ada data tugas yang ditemukan.</p>
            </div>
        </div>
    @else
        @foreach($tugas as $t)
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-tasks mr-2"></i>Tugas #{{ $loop->iteration }}
                </h6>
                <div>
                    <span class="badge badge-pill badge-info">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $t->tgl_mulai ? $t->tgl_mulai->format('d/m/Y') : '-' }}
                        &rarr;
                        {{ $t->tgl_selesai ? $t->tgl_selesai->format('d/m/Y') : '-' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <p class="mb-0" style="white-space: pre-wrap; line-height: 1.7;">{{ $t->tugas }}</p>
            </div>
            <div class="card-footer text-muted small">
                <i class="fas fa-clock mr-1"></i>
                @php
                    $now = now();
                    $selesai = $t->tgl_selesai;
                    $diff = $now->diffInDays($selesai, false);
                @endphp
                @if($diff < 0)
                    <span class="text-danger">Sudah melewati batas waktu {{ abs($diff) }} hari yang lalu</span>
                @elseif($diff === 0)
                    <span class="text-warning">Deadline hari ini!</span>
                @else
                    <span class="text-success">{{ $diff }} hari lagi menuju deadline</span>
                @endif
            </div>
        </div>
        @endforeach
    @endif
@endif
@endsection
