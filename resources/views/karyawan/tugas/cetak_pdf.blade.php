<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas Saya - {{ $user->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 30px; color: #2d3748; }
        .header { text-align: center; border-bottom: 3px solid #4e73df; padding-bottom: 16px; margin-bottom: 20px; }
        .header h2 { color: #4e73df; margin: 0 0 4px 0; font-size: 22px; }
        .header p { margin: 0; color: #718096; font-size: 12px; }
        .info-box { background: #f8f9fc; border-left: 4px solid #4e73df; padding: 10px 14px; margin-bottom: 20px; border-radius: 4px; }
        .info-box strong { color: #4e73df; }
        .tugas-card { border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 16px; overflow: hidden; }
        .tugas-card-header { background: #4e73df; color: #fff; padding: 8px 14px; font-weight: bold; font-size: 13px; }
        .tugas-card-body { padding: 12px 14px; }
        .tugas-meta { color: #718096; font-size: 11px; margin-top: 8px; }
        .footer { text-align: center; margin-top: 30px; padding-top: 14px; border-top: 1px solid #e2e8f0; color: #718096; font-size: 11px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>M-Tugas — Laporan Tugas Karyawan</h2>
        <p>Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info-box">
        <strong>Nama:</strong> {{ $user->name }} &nbsp;|&nbsp;
        <strong>Email:</strong> {{ $user->email }} &nbsp;|&nbsp;
        <strong>Jabatan:</strong> Karyawan
    </div>

    @if($tugas->count() === 0)
        <p style="text-align:center; color:#718096; margin-top:40px;">Tidak ada data tugas.</p>
    @else
        @foreach($tugas as $i => $t)
        <div class="tugas-card">
            <div class="tugas-card-header">Tugas #{{ $i + 1 }}</div>
            <div class="tugas-card-body">
                <p style="margin:0 0 8px 0;">{{ $t->tugas }}</p>
                <div class="tugas-meta">
                    <strong>Tanggal Mulai:</strong> {{ $t->tgl_mulai ? $t->tgl_mulai->format('d/m/Y') : '-' }}
                    &nbsp;&nbsp;
                    <strong>Tanggal Selesai:</strong> {{ $t->tgl_selesai ? $t->tgl_selesai->format('d/m/Y') : '-' }}
                </div>
            </div>
        </div>
        @endforeach
    @endif

    <div class="footer">Copyright &copy; M-Tugas {{ date('Y') }} — Aplikasi Manajemen Tugas</div>
</body>
</html>
