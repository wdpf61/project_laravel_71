<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return  [
            "id",
            'name',
            'phone',
            'email',
            'batch',
            'photo',
            'status'
        ];
    }

    public function collection()
    {
        return collect(Student::select(
            "id",
            'name',
            'phone',
            'email',
            'batch',
            'photo',
            'status'
            )->get()) ;
    }
}
