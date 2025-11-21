<?php

namespace App\Exports;

use App\Models\Cita;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CitasExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    public function collection()
    {
        return Cita::with('user')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Hora',
            'Cliente',
            'Estado',
            'Total',
        ];
    }

    public function map($cita): array
    {
        return [
            $cita->id,
            optional($cita->fecha)->format('Y-m-d') ?? $cita->fecha,
            $cita->hora,
            optional($cita->user)->name,
            strtoupper($cita->estado),
            $cita->total,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5'],
                ],
            ],
        ];
    }

    public function title(): string
    {
        return 'Citas';
    }
}
