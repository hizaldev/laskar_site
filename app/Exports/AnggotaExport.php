<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnggotaExport extends DefaultValueBinder implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $i = 1;

    public function collection()
    {
            return Member::with(['unit', 'size', 'status', 'dpc', 'dpd'])->get();

    }

    public function map($anggota): array
    {
        // $question 

        return [
            $this->i++,
            $anggota->no_anggota,
            $anggota->nama_lengkap,
            $anggota->nipeg,
            $anggota->jenis_kelamin,
            $anggota->tempat_lahir,
            $anggota->tgl_lahir,
            $anggota->alamat,
            $anggota->email,
            $anggota->agama,
            $anggota->grade,
            $anggota->no_telpon,
            $anggota->golongan_darah,
            $anggota->bank->bank,
            $anggota->no_rekening,
            $anggota->unit->unit,
            $anggota->no_pendaftaran,
            $anggota->tgl_anggota,
            $anggota->tgl_pendaftaran,
            $anggota->size->ukuran,
            $anggota->dpd->dpd,
            $anggota->dpc->dpc,
            $anggota->status->status,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'No Anggota',
            'Nama Lengkap',
            'Nipeg',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tgl Lahir',
            'Alamat',
            'Email',
            'Agama',
            'Grade',
            'No Telpon',
            'Golongan Darah',
            'Bank',
            'No Rekening',
            'Unit',
            'No Pendaftaran',
            'Tgl Anggota',
            'No Pendaftaran',
            'Ukuran Baju',
            'DPD',
            'DPC',
            'Status Anggota',
        ];
    }

    public function styles(Worksheet $sheet) {
        return [ 1 => ['font' => ['bold' => true ]]];
    }

    public function columnFormats(): array
    {
        return [
            // untuk membuat format no anggota full angka karena jumlah angka yang kepanjangan excel suka merubah formatnya
            'B' => '0',
            'L' => '0'
        ];
    }
}
