<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImportErrorExport implements FromCollection, WithHeadings
{
    public function __construct(private array $errors = []) {}

    public function headings(): array
    {
        return ['row', 'error',];
    }
    public function collection(): Collection
    {
        return collect($this->errors);
    }
}
