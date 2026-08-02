<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class Invoice extends Controller
{
 function ShowInvoice(){

  $items=[
       ["id"=> 1, "name"=>"Laptop", "price"=>50000],
       ["id"=> 2, "name"=>"Mobile", "price"=>40000],
       ["id"=> 3, "name"=>"Desktop", "price"=>140000],
   ];
   $name= "Hasan";
    return view("invoice", compact("items", "name"));
 }



}
