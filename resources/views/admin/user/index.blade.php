@extends('layouts.admin.app')
@section('title', 'Data User')

@push('styles')
<style>
    .badge-admin { background: #4e73df; }
    .badge-karyawan { background: #1cc88a; }
    .badge-ditugaskan { background: #1cc88a; }
    .badge-belum { background: #e74a3b; }
    
    /* DataTable header styling to match image */
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
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-user mr-2"></i>Data User</h1>
</div>

<div class="card shadow border-0 mb-4">
    <div class="card-body">
        
        {{-- Header Buttons --}}
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('admin.user.create') }}" class="btn btn-tambah px-3">
                <i class="fas fa-plus mr-1"></i> Tambah Data
            </a>
            <div>
                <a href="{{ route('admin.user.export.excel') }}" class="btn btn-excel px-3 mr-1">
                    <i class="fas fa-file-excel mr-1"></i> Excel
                </a>
                <a href="{{ route('admin.user.export.pdf') }}" class="btn btn-pdf px-3">
                    <i class="fas fa-file-pdf mr-1"></i> PDF
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="tableUser" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 100px;"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->jabatan === 'admin')
                                <span class="badge badge-pill text-white px-2 py-1" style="background-color: #5a5c69; font-size: 12px; border-radius: 12px;">Admin</span>
                            @else
                                <span class="badge badge-pill text-white px-2 py-1" style="background-color: #36b9cc; font-size: 12px; border-radius: 12px;">Karyawan</span>
                            @endif
                        </td>
                        <td>
                            @if($user->status === 'ditugaskan')
                                <span class="badge badge-pill text-white px-2 py-1 badge-ditugaskan" style="font-size: 12px; border-radius: 12px;">Ditugaskan</span>
                            @else
                                <span class="badge badge-pill text-white px-2 py-1 badge-belum" style="font-size: 12px; border-radius: 12px;">Belum Ditugaskan</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm text-white px-2 py-1 mr-1" style="background-color: #f6c23e; border-color: #f6c23e;">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm px-2 py-1 btn-hapus"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}"
                                data-jabatan="{{ $user->jabatan }}"
                                data-status="{{ $user->status }}"
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
                            <td id="hapusName" style="padding: 6px 0; font-weight: 500;"></td>
                        </tr>
                        <tr>
                            <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Email</td>
                            <td style="padding: 6px 0;">:</td>
                            <td id="hapusEmail" style="padding: 6px 0;"></td>
                        </tr>
                        <tr>
                            <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Jabatan</td>
                            <td style="padding: 6px 0;">:</td>
                            <td style="padding: 6px 0;">
                                <span id="hapusJabatan" class="badge text-white px-2 py-1" style="font-size: 12px; border-radius: 4px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray-600" style="padding: 6px 0; font-weight: 500;">Status</td>
                            <td style="padding: 6px 0;">:</td>
                            <td style="padding: 6px 0;">
                                <span id="hapusStatus" class="badge text-white px-2 py-1" style="font-size: 12px; border-radius: 4px;"></span>
                            </td>
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
    $('#tableUser').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
    });

    // Hapus Action
    $('.btn-hapus').on('click', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const jabatan = $(this).data('jabatan');
        const status = $(this).data('status');
        
        $('#hapusName').text(name);
        $('#hapusEmail').text(email);
        
        // Setup Jabatan Badge
        const jBadge = $('#hapusJabatan');
        jBadge.text(jabatan.charAt(0).toUpperCase() + jabatan.slice(1));
        if (jabatan === 'admin') {
            jBadge.css('background-color', '#5a5c69');
        } else {
            jBadge.css('background-color', '#36b9cc');
        }
        
        // Setup Status Badge
        const sBadge = $('#hapusStatus');
        if (status === 'ditugaskan') {
            sBadge.text('Ditugaskan').css('background-color', '#1cc88a');
        } else {
            sBadge.text('Belum Ditugaskan').css('background-color', '#e74a3b');
        }
        
        $('#formHapus').attr('action', '/admin/user/' + id);
    });
});
</script>
@endpush
