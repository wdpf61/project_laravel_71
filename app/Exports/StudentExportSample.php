<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Override;

class StudentExportSample implements FromCollection, WithHeadings
{

     public function __construct(private array $rows=[])
     {
        
     }

     public function headings(): array
     {
        return [
            'name',
            'phone',
            'email',
            'batch',
            'photo',
            'status',
            "validation_errors"
        ];
     }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->rows ?: [
            [
            'Rashed',
            '012222',
            'abc@gmail.com',
            'batch71',
            'abc.jpg',
            '0'
        ]
       ]) ;
    }
}
