<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Override;

class StudentImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    #[Override]
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|max:11',
            'email' => 'required|email|unique:students,email',
            'batch' => 'required|string|max:100',
            'photo' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ];
    }

    // public function collection(Collection $rows)
    // {
    //     foreach ($rows as $key => $row) {
    //         Student::create([
    //             'name' => $row["name"],
    //             'phone' => $row["phone"],
    //             'email' => $row["email"],
    //             'batch' => $row["batch"],
    //             'photo' => $row["photo"],
    //             'status' => $row["status"]
    //         ]);
    //     }
    // }


    
    // advance 

    // public function collection(Collection $rows)
    // {
    //     $this->validRows = $rows;
    // }
    // public function getRows(): Collection
    // {
    //     return $this->validRows ?? collect();
    // }
}
