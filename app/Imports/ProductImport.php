<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
   use SkipsFailures;

     public function rules(): array{
        return [
            "name" => "required|unique:products,name",
            "price" => "required",
            "qty" => "required",
            "photo" => "nullable|image|mimes:png,jpg,jpeg|max:5000",
            "status" => "nullable",
            "description" => "nullable",
        ];
     }



     public function headings():array{
       return ['name','price','qty', 'photo','description','status'];
    }


    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {

           Product::create([
            'name' => $row["name"],
            'price' => $row["price"],
            'qty' => $row["qty"], 
            'photo' => $row["photo"],
            'description' => $row["description"],
            'status' => $row["status"]
           ]);

           
        }
    }
}
