@extends('layouts.admin.app')
@section('title', 'Data User')

@push('styles')
<style>
    .badge-admin { background: #4e73df; }
    .badge-karyawan { background: #1cc88a; }
    .badge-ditugaskan { background: #1cc88a; }
    .badge-belum { background: #e74a3b; }
</style>
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-users mr-2"></i>Data User</h1>
    <div>
        <a href="{{ route('admin.user.export.pdf') }}" class="btn btn-sm btn-danger shadow-sm mr-1">
            <i class="fas fa-file-pdf fa-sm"></i> Export PDF
        </a>
        <a href="{{ route('admin.user.export.excel') }}" class="btn btn-sm btn-success shadow-sm mr-1">
            <i class="fas fa-file-excel fa-sm"></i> Export Excel
        </a>
        <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus fa-sm"></i> Tambah Data
        </button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableUser" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge badge-pill text-white badge-{{ $user->jabatan }}">
                                {{ ucfirst($user->jabatan) }}
                            </span>
                        </td>
                        <td>
                            @if($user->status === 'ditugaskan')
                                <span class="badge badge-pill text-white badge-ditugaskan">Ditugaskan</span>
                            @else
                                <span class="badge badge-pill text-white badge-belum">Belum Ditugaskan</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm btn-edit"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}"
                                data-jabatan="{{ $user->jabatan }}"
                                data-status="{{ $user->status }}"
                                data-toggle="modal" data-target="#modalEdit">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm btn-hapus"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-toggle="modal" data-target="#modalHapus">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus mr-1"></i> Tambah User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan <span class="text-danger">*</span></label>
                        <select name="jabatan" class="form-control" required>
                            <option value="">-- Pilih Jabatan --</option>
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control" required>
                            <option value="belum_ditugaskan">Belum Ditugaskan</option>
                            <option value="ditugaskan">Ditugaskan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required minlength="6">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formEdit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title"><i class="fas fa-edit mr-1"></i> Edit User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="editName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan <span class="text-danger">*</span></label>
                        <select name="jabatan" id="editJabatan" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select name="status" id="editStatus" class="form-control" required>
                            <option value="belum_ditugaskan">Belum Ditugaskan</option>
                            <option value="ditugaskan">Ditugaskan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password Baru <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                        <input type="password" name="password" class="form-control" minlength="6">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white"><i class="fas fa-save mr-1"></i>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-trash mr-1"></i> Hapus User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus user <strong id="hapusName"></strong>?</p>
                    <p class="text-danger"><small>Data yang dihapus tidak dapat dikembalikan.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash mr-1"></i>Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#tableUser').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' } });

    // Edit
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        $('#editName').val($(this).data('name'));
        $('#editEmail').val($(this).data('email'));
        $('#editJabatan').val($(this).data('jabatan'));
        $('#editStatus').val($(this).data('status'));
        $('#formEdit').attr('action', '/admin/user/' + id);
    });

    // Hapus
    $('.btn-hapus').on('click', function() {
        const id = $(this).data('id');
        $('#hapusName').text($(this).data('name'));
        $('#formHapus').attr('action', '/admin/user/' + id);
    });
});
</script>
@endpush
