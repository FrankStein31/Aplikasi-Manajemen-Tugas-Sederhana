<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return ['No', 'Nama', 'Email', 'Jabatan', 'Status'];
    }

    public function map($user): array
    {
        static $no = 0;
        $no++;
        return [
            $no,
            $user->name,
            $user->email,
            ucfirst($user->jabatan),
            $user->status === 'ditugaskan' ? 'Ditugaskan' : 'Belum Ditugaskan',
        ];
    }
}
