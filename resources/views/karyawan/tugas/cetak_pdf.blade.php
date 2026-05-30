<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tugas - {{ $user->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 40px 50px;
        }
        h1.judul {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin: 0 0 10px 0;
        }
        .tanggal-cetak {
            text-align: center;
            font-size: 13px;
            margin-bottom: 12px;
        }
        .tanggal-cetak span {
            font-weight: bold;
        }
        hr.garis {
            border: none;
            border-top: 1.5px solid #000;
            margin: 0 0 20px 0;
        }
        table.detail {
            width: 100%;
            border-collapse: collapse;
        }
        table.detail tr td {
            padding: 6px 0;
            vertical-align: top;
            font-size: 14px;
        }
        table.detail tr td:first-child {
            width: 200px;
            font-weight: normal;
        }
        table.detail tr td.colon {
            width: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1 class="judul">Data Tugas</h1>

    <p class="tanggal-cetak">
        <span>Tanggal Cetak :</span> {{ now()->format('d-m-Y H.i.s') }}
    </p>

    <hr class="garis">

    @if($tugas->count() === 0)
        <p style="text-align:center; margin-top:40px;">Tidak ada data tugas.</p>
    @else
        @foreach($tugas as $t)
        <table class="detail" style="{{ !$loop->last ? 'margin-bottom:24px; border-bottom:1px solid #ccc; padding-bottom:16px;' : '' }}">
            <tbody>
                <tr>
                    <td>Nama</td>
                    <td class="colon">:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td class="colon">:</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td class="colon">:</td>
                    <td>Karyawan</td>
                </tr>
                <tr>
                    <td>Tugas</td>
                    <td class="colon">:</td>
                    <td>{{ $t->tugas }}</td>
                </tr>
                <tr>
                    <td>Tanggal Mulai</td>
                    <td class="colon">:</td>
                    <td>{{ $t->tgl_mulai ? $t->tgl_mulai->format('Y-m-d') : '-' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Selesai</td>
                    <td class="colon">:</td>
                    <td>{{ $t->tgl_selesai ? $t->tgl_selesai->format('Y-m-d') : '-' }}</td>
                </tr>
            </tbody>
        </table>
        @endforeach
    @endif

</body>
</html>
