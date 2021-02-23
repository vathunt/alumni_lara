<?php

namespace App\Exports;

use App\Alumni;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AlumniExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Alumni::all();
    }

    public function headings(): array
    {
        return [
            // 'Nomor',
            'NIM',
            'Nama Alumni',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Alamat',
            // 'Tanggal Dibuat',
            // 'Tanggal Diubah'
        ];
    }

    public function map($alumni): array
    {
        return [
        	$alumni->nim,
            $alumni->nama_alumni,
            $alumni->tmp_lahir,
            Date::dateTimeToExcel($alumni->tgl_lahir),
            $alumni->jenis_kelamin ? 'Laki-laki' : 'Perempuan',
            $alumni->alamat
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }

    public function styles(Worksheet $sheet)
    {
    	$sheet->getStyle('A1:F1')->getFont()->setBold(true);
        // return [
        //     // Style the first row as bold text.
        //     1    => ['font' => ['bold' => true]],
        // ];
    }
}
