<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tugas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 30px;
        }
        h1 {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin: 0 0 14px 0;
        }
        .subtitle {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #555;
        }
        th, td {
            border: 1px solid #555;
            padding: 8px 10px;
            font-size: 14px;
        }
        th {
            background-color: #2e59d9;
            color: white;
            font-weight: bold;
            text-align: center;
        }
        tr td:nth-child(1), tr td:nth-child(2) {
            text-align: left;
        }
        tr td:nth-child(3), tr td:nth-child(4) {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Data Tugas</h1>
    <div class="subtitle">{{ now()->format('d-m-Y H.i.s') }}</div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tugas</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tugas as $t)
            <tr>
                <td>{{ $t->user->name ?? '-' }}</td>
                <td>{{ $t->tugas }}</td>
                <td>{{ $t->tgl_mulai ? $t->tgl_mulai->format('Y-m-d') : '-' }}</td>
                <td>{{ $t->tgl_selesai ? $t->tgl_selesai->format('Y-m-d') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
