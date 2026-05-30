@extends('layouts.admin.app')
@section('title', 'Data Tugas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-clipboard-list mr-2"></i>Data Tugas</h1>
    <div>
        <a href="{{ route('admin.tugas.export.pdf') }}" class="btn btn-sm btn-danger shadow-sm mr-1">
            <i class="fas fa-file-pdf fa-sm"></i> Export PDF
        </a>
        <a href="{{ route('admin.tugas.export.excel') }}" class="btn btn-sm btn-success shadow-sm mr-1">
            <i class="fas fa-file-excel fa-sm"></i> Export Excel
        </a>
        <button class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus fa-sm"></i> Tambah Data
        </button>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tableTugas" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Tugas</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tugas as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $t->user->name ?? '-' }}</td>
                        <td>{{ Str::limit($t->tugas, 50) }}</td>
                        <td>{{ $t->tgl_mulai ? $t->tgl_mulai->format('d/m/Y') : '-' }}</td>
                        <td>{{ $t->tgl_selesai ? $t->tgl_selesai->format('d/m/Y') : '-' }}</td>
                        <td>
                            <button class="btn btn-info btn-sm btn-detail"
                                data-nama="{{ $t->user->name ?? '-' }}"
                                data-tugas="{{ $t->tugas }}"
                                data-mulai="{{ $t->tgl_mulai ? $t->tgl_mulai->format('d/m/Y') : '-' }}"
                                data-selesai="{{ $t->tgl_selesai ? $t->tgl_selesai->format('d/m/Y') : '-' }}"
                                data-toggle="modal" data-target="#modalDetail">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-warning btn-sm btn-edit"
                                data-id="{{ $t->id }}"
                                data-user_id="{{ $t->user_id }}"
                                data-tugas="{{ $t->tugas }}"
                                data-mulai="{{ $t->tgl_mulai ? $t->tgl_mulai->format('Y-m-d') : '' }}"
                                data-selesai="{{ $t->tgl_selesai ? $t->tgl_selesai->format('Y-m-d') : '' }}"
                                data-toggle="modal" data-target="#modalEdit">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm btn-hapus"
                                data-id="{{ $t->id }}"
                                data-nama="{{ $t->user->name ?? '-' }}"
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
            <form action="{{ route('admin.tugas.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus mr-1"></i> Tambah Tugas</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Karyawan <span class="text-danger">*</span></label>
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id }}">{{ $k->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Tugas <span class="text-danger">*</span></label>
                        <textarea name="tugas" class="form-control" rows="4" required placeholder="Masukkan deskripsi tugas..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_selesai" class="form-control" required>
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

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-eye mr-1"></i> Detail Tugas</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr><th width="140">Nama Karyawan</th><td id="detailNama"></td></tr>
                    <tr><th>Tugas</th><td id="detailTugas" style="white-space:pre-wrap;"></td></tr>
                    <tr><th>Tgl Mulai</th><td id="detailMulai"></td></tr>
                    <tr><th>Tgl Selesai</th><td id="detailSelesai"></td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
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
                    <h5 class="modal-title"><i class="fas fa-edit mr-1"></i> Edit Tugas</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Karyawan <span class="text-danger">*</span></label>
                        <select name="user_id" id="editUserId" class="form-control" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id }}">{{ $k->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Tugas <span class="text-danger">*</span></label>
                        <textarea name="tugas" id="editTugas" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_mulai" id="editMulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Selesai <span class="text-danger">*</span></label>
                        <input type="date" name="tgl_selesai" id="editSelesai" class="form-control" required>
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
                    <h5 class="modal-title"><i class="fas fa-trash mr-1"></i> Hapus Tugas</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Hapus tugas dari karyawan <strong id="hapusNama"></strong>?</p>
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
    $('#tableTugas').DataTable({ language: { url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json' } });

    // Detail
    $('.btn-detail').on('click', function() {
        $('#detailNama').text($(this).data('nama'));
        $('#detailTugas').text($(this).data('tugas'));
        $('#detailMulai').text($(this).data('mulai'));
        $('#detailSelesai').text($(this).data('selesai'));
    });

    // Edit
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        $('#editUserId').val($(this).data('user_id'));
        $('#editTugas').val($(this).data('tugas'));
        $('#editMulai').val($(this).data('mulai'));
        $('#editSelesai').val($(this).data('selesai'));
        $('#formEdit').attr('action', '/admin/tugas/' + id);
    });

    // Hapus
    $('.btn-hapus').on('click', function() {
        $('#hapusNama').text($(this).data('nama'));
        $('#formHapus').attr('action', '/admin/tugas/' + $(this).data('id'));
    });
});
</script>
@endpush
