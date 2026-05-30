<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User - M-Tugas</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 20px; }
        h2 { text-align: center; color: #2d3748; margin-bottom: 4px; }
        p.subtitle { text-align: center; color: #718096; margin-top: 0; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #4e73df; color: white; padding: 8px 10px; text-align: left; }
        td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; }
        tr:nth-child(even) td { background: #f8f9fc; }
        .badge { padding: 3px 8px; border-radius: 12px; font-size: 11px; color: #fff; }
        .badge-admin { background: #4e73df; }
        .badge-karyawan { background: #1cc88a; }
        .badge-ditugaskan { background: #1cc88a; }
        .badge-belum { background: #e74a3b; }
        .footer { margin-top: 30px; text-align: center; color: #718096; font-size: 11px; }
    </style>
</head>
<body>
    <h2>M-Tugas - Data User</h2>
    <p class="subtitle">Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jabatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="badge badge-{{ $user->jabatan }}">{{ ucfirst($user->jabatan) }}</span></td>
                <td>
                    @if($user->status === 'ditugaskan')
                        <span class="badge badge-ditugaskan">Ditugaskan</span>
                    @else
                        <span class="badge badge-belum">Belum Ditugaskan</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">Copyright &copy; M-Tugas {{ date('Y') }}</div>
</body>
</html>
