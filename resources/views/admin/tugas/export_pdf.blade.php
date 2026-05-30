<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tugas - M-Tugas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 20px; }
        h2 { text-align: center; color: #2d3748; margin-bottom: 4px; }
        p.subtitle { text-align: center; color: #718096; margin-top: 0; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #4e73df; color: white; padding: 8px 10px; text-align: left; }
        td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; vertical-align: top; }
        tr:nth-child(even) td { background: #f8f9fc; }
        .footer { margin-top: 30px; text-align: center; color: #718096; font-size: 11px; }
    </style>
</head>
<body>
    <h2>M-Tugas - Data Tugas</h2>
    <p class="subtitle">Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tugas</th>
                <th>Tgl Mulai</th>
                <th>Tgl Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugas as $i => $t)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $t->user->name ?? '-' }}</td>
                <td>{{ $t->tugas }}</td>
                <td>{{ $t->tgl_mulai ? $t->tgl_mulai->format('d/m/Y') : '-' }}</td>
                <td>{{ $t->tgl_selesai ? $t->tgl_selesai->format('d/m/Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">Copyright &copy; M-Tugas {{ date('Y') }}</div>
</body>
</html>
