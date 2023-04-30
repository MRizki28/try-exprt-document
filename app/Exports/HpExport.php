<?php

namespace App\Exports;

use App\Models\HpModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HpExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // ambil data dari database dan return sebagai collection
        return HpModel::all();
    }

    public function headings(): array
    {
        // set header kolom di file Excel
        return [
            'ID',
            'Uuid',
            'Merek',
            'Nama',
            'RAM',
            'Penyimpanan',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }
}
