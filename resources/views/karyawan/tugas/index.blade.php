@extends('layouts.karyawan.app')
@section('title', 'Data Tugas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-list-alt mr-2"></i>Data Tugas</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-body">

        {{-- Tombol PDF pojok kanan atas --}}
        <div class="text-right mb-3">
            <a href="{{ route('karyawan.tugas.cetak_pdf') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf mr-1"></i> PDF
            </a>
        </div>

        @if($tugas->count() === 0)
            <div class="text-center py-5 text-muted">
                <i class="fas fa-inbox fa-4x mb-3"></i>
                <p class="mt-2">Belum ada tugas yang diberikan.</p>
            </div>
        @else
            @foreach($tugas as $t)
            <table class="table table-borderless mb-{{ !$loop->last ? '4' : '0' }}" style="border-bottom: {{ !$loop->last ? '1px solid #e3e6f0' : 'none' }};">
                <tbody>
                    <tr>
                        <td class="text-gray-600" style="width: 160px; font-weight: 500;">Nama</td>
                        <td>: {{ $t->user->name ?? session('name') }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="font-weight: 500;">Email</td>
                        <td>: {{ $t->user->email ?? session('email') }}</td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="font-weight: 500;">Tugas</td>
                        <td>: <span class="badge badge-info px-2 py-1" style="font-size: 13px; border-radius: 4px;">{{ $t->tugas }}</span></td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="font-weight: 500;">Tanggal Mulai</td>
                        <td>: <span class="badge badge-primary px-2 py-1" style="font-size: 13px; border-radius: 4px;">
                            {{ $t->tgl_mulai ? $t->tgl_mulai->format('Y-m-d') : '-' }}
                        </span></td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="font-weight: 500;">Tanggal Selesai</td>
                        <td>: <span class="badge badge-primary px-2 py-1" style="font-size: 13px; border-radius: 4px;">
                            {{ $t->tgl_selesai ? $t->tgl_selesai->format('Y-m-d') : '-' }}
                        </span></td>
                    </tr>
                </tbody>
            </table>
            @endforeach
        @endif

    </div>
</div>
@endsection
