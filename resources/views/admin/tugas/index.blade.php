@extends('layouts.admin.app')
@section('title', 'Data Tugas')

@push('styles')
<style>
    /* DataTable header styling */
    table.dataTable thead th {
        background-color: #4e73df !important;
        color: white !important;
        font-weight: bold;
        border: none;
    }
    
    .btn-tambah {
        background-color: #4e73df;
        color: white;
        border-radius: 4px;
        font-weight: 500;
    }
    .btn-tambah:hover {
        background-color: #2e59d9;
        color: white;
    }
    
    .btn-excel {
        background-color: #1cc88a;
        color: white;
        border: none;
        border-radius: 4px;
    }
    .btn-excel:hover {
        background-color: #17a673;
        color: white;
    }
    
    .btn-pdf {
        background-color: #e74a3b;
        color: white;
        border: none;
        border-radius: 4px;
    }
    .btn-pdf:hover {
        background-color: #be2617;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-list-alt mr-2"></i>Data Tugas</h1>
</div>

<div class="card shadow border-0 mb-4">
    <div class="card-body">
        
        {{-- Header Buttons --}}
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('admin.tugas.create') }}" class="btn btn-tambah px-3">
                <i class="fas fa-plus mr-1"></i> Tambah Data
            </a>
            <div>
                <a href="{{ route('admin.tugas.export.excel') }}" class="btn btn-excel px-3 mr-1">
                    <i class="fas fa-file-excel mr-1"></i> Excel
                </a>
                <a href="{{ route('admin.tugas.export.pdf') }}" class="btn btn-pdf px-3">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tableTugas" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>Tugas</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th class="text-center" style="width: 140px;"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tugas as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $t->user->name ?? '-' }}</td>
                        <td>{{ $t->tugas }}</td>
                        <td>
                            <span class="badge badge-pill text-white px-2 py-1" style="background-color: #36b9cc; font-size: 12px; border-radius: 12px;">
                                {{ $t->tgl_mulai ? $t->tgl_mulai->format('Y-m-d') : '-' }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-pill text-white px-2 py-1" style="background-color: #36b9cc; font-size: 12px; border-radius: 12px;">
                                {{ $t->tgl_selesai ? $t->tgl_selesai->format('Y-m-d') : '-' }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{-- Detail Button --}}
                            <button class="btn btn-info btn-sm text-white px-2 py-1 mr-1 btn-detail"
                                style="background-color: #36b9cc; border-color: #36b9cc;"
                                data-nama="{{ $t->user->name ?? '-' }}"
                                data-email="{{ $t->user->email ?? '-' }}"
                                data-tugas="{{ $t->tugas }}"
                                data-mulai="{{ $t->tgl_mulai ? $t->tgl_mulai->format('Y-m-d') : '-' }}"
                                data-selesai="{{ $t->tgl_selesai ? $t->tgl_selesai->format('Y-m-d') : '-' }}"
                                data-toggle="modal" data-target="#modalDetail">
                                <i class="fas fa-eye"></i>
                            </button>
                            
                            {{-- Edit Button --}}
                            <a href="{{ route('admin.tugas.edit', $t->id) }}" class="btn btn-warning btn-sm text-white px-2 py-1 mr-1" style="background-color: #f6c23e; border-color: #f6c23e;">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            {{-- Delete Button --}}
                            <button class="btn btn-danger btn-sm px-2 py-1 btn-hapus"
                                data-id="{{ $t->id }}"
                                data-nama="{{ $t->user->name ?? '-' }}"
                                data-email="{{ $t->user->email ?? '-' }}"
                                data-tugas="{{ $t->tugas }}"
                                data-toggle="modal" data-target="#modalHapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <div class="modal-header text-white border-0" style="background-color: #4e73df;">
                <h5 class="modal-title font-weight-bold">Detail Data</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body p-4">
                <table class="table table-borderless m-0">
                    <tr>
                        <td class="text-gray-600" style="width: 140px; padding: 6px 0; font-weight: 500;">Nama</td>
                        <td style="width: 20px; padding: 6px 0;">:</td>
                        <td id="detailNama" style="padding: 6px 0;"></td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Email</td>
                        <td style="padding: 6px 0;">:</td>
                        <td id="detailEmail" style="padding: 6px 0;"></td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Tugas</td>
                        <td style="padding: 6px 0;">:</td>
                        <td id="detailTugas" style="padding: 6px 0;"></td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Tanggal Mulai</td>
                        <td style="padding: 6px 0;">:</td>
                        <td style="padding: 6px 0;">
                            <span id="detailMulai" class="badge text-white px-2 py-1" style="background-color: #36b9cc; font-size: 12px; border-radius: 4px;"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Tanggal Selesai</td>
                        <td style="padding: 6px 0;">:</td>
                        <td style="padding: 6px 0;">
                            <span id="detailSelesai" class="badge text-white px-2 py-1" style="background-color: #36b9cc; font-size: 12px; border-radius: 4px;"></span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow">
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title font-weight-bold">Konfirmasi Penghapusan Data ?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-4">
                    <table class="table table-borderless m-0">
                        <tr>
                            <td class="text-gray-600" style="width: 140px; padding: 6px 0; font-weight: 500;">Nama</td>
                            <td style="width: 20px; padding: 6px 0;">:</td>
                            <td id="hapusNama" style="padding: 6px 0; font-weight: 500;"></td>
                        </tr>
                        <tr>
                            <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Email</td>
                            <td style="padding: 6px 0;">:</td>
                            <td id="hapusEmail" style="padding: 6px 0;"></td>
                        </tr>
                        <tr>
                            <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Tugas</td>
                            <td style="padding: 6px 0;">:</td>
                            <td id="hapusTugas" style="padding: 6px 0;"></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-end p-3">
                    <button type="button" class="btn btn-secondary px-3 mr-1" data-dismiss="modal" style="background-color: #6e707e; border-color: #6e707e;">
                        <i class="fas fa-times mr-1"></i> Tutup
                    </button>
                    <button type="submit" class="btn btn-danger px-3">
                        <i class="fas fa-check mr-1"></i> OK
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#tableTugas').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
    });

    // Detail Action
    $('.btn-detail').on('click', function() {
        $('#detailNama').text($(this).data('nama'));
        $('#detailEmail').text($(this).data('email'));
        $('#detailTugas').text($(this).data('tugas'));
        $('#detailMulai').text($(this).data('mulai'));
        $('#detailSelesai').text($(this).data('selesai'));
    });

    // Hapus Action
    $('.btn-hapus').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('nama');
        const email = $(this).data('email');
        const tugas = $(this).data('tugas');
        
        $('#hapusNama').text(name);
        $('#hapusEmail').text(email);
        $('#hapusTugas').text(tugas);
        
        $('#formHapus').attr('action', '/admin/tugas/' + id);
    });
});
</script>
@endpush
