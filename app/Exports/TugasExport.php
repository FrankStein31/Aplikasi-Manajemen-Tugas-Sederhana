<?php

namespace App\Exports;

use App\Models\Tugas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class TugasExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithEvents
{
    public function collection()
    {
        return Tugas::with('user')->get();
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function headings(): array
    {
        return ['Nama', 'Tugas', 'Tanggal Mulai', 'Tanggal Selesai'];
    }

    public function map($tugas): array
    {
        return [
            $tugas->user->name ?? '-',
            $tugas->tugas,
            $tugas->tgl_mulai ? $tugas->tgl_mulai->format('Y-m-d') : '-',
            $tugas->tgl_selesai ? $tugas->tgl_selesai->format('Y-m-d') : '-',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                
                // Merge header rows
                $sheet->mergeCells('A1:D1');
                $sheet->mergeCells('A2:D2');
                
                // Write values
                $sheet->setCellValue('A1', 'Data Tugas');
                $sheet->setCellValue('A2', now()->format('d-m-Y H.i.s'));
                
                // Header style (Row 1-3)
                $styleHeader = [
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFFFFFF'],
                        'size' => 11,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF2E59D9'], // Blue background
                    ]
                ];
                
                $sheet->getStyle('A1:D3')->applyFromArray($styleHeader);
                
                // Row heights
                $sheet->getRowDimension('1')->setRowHeight(24);
                $sheet->getRowDimension('2')->setRowHeight(20);
                $sheet->getRowDimension('3')->setRowHeight(20);
                
                // Column widths (Auto fit)
                foreach (range('A', 'D') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
