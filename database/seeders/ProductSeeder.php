<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            ['sku'=>'SKU-1001','name'=>'سكر 1 كغ','description'=>null,'quantity'=>12,'low_stock_threshold'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1002','name'=>'رز 5 كغ','description'=>null,'quantity'=>3,'low_stock_threshold'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1003','name'=>'زيت 1 لتر','description'=>null,'quantity'=>25,'low_stock_threshold'=>7,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1004','name'=>'طحين 2 كغ','description'=>null,'quantity'=>0,'low_stock_threshold'=>10,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1005','name'=>'معكرونة 500 غ','description'=>null,'quantity'=>8,'low_stock_threshold'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1006','name'=>'شاي 200 غ','description'=>null,'quantity'=>15,'low_stock_threshold'=>5,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1007','name'=>'قهوة 250 غ','description'=>null,'quantity'=>5,'low_stock_threshold'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1008','name'=>'ملح 1 كغ','description'=>null,'quantity'=>20,'low_stock_threshold'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1009','name'=>'فلفل أسود 100 غ','description'=>null,'quantity'=>2,'low_stock_threshold'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['sku'=>'SKU-1010','name'=>'قرفة 50 غ','description'=>null,'quantity'=>10,'low_stock_threshold'=>3,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}