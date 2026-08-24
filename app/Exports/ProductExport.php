<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
  

    public function headings():array{
       return ['id','name','price','qty', 'photo','description','status'];
    }
    public function collection()
    {
        return collect(Product::select('id','name','price','qty', 'photo','description','status')->
        where("status", 1)->get()) ;
    }
}
