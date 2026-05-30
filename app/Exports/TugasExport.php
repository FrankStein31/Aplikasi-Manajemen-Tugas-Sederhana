<?php

namespace App\Exports;

use App\Models\Tugas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TugasExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Tugas::with('user')->get();
    }

    public function headings(): array
    {
        return ['No', 'Nama Karyawan', 'Tugas', 'Tgl Mulai', 'Tgl Selesai'];
    }

    public function map($tugas): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $tugas->user->name ?? '-',
            $tugas->tugas,
            $tugas->tgl_mulai ? $tugas->tgl_mulai->format('d/m/Y') : '-',
            $tugas->tgl_selesai ? $tugas->tgl_selesai->format('d/m/Y') : '-',
        ];
    }
}
