<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    public function run()
    {

        $products=[
            [
                'name'=>'Deneme Sistem',
                'description'=>'Deneme sistem açıklama metni',
                'summary'=>'Deneme sistem özet metni',
                'price'=>'100',
                'period'=>'3',
                'system_file'=>'product.zip',
            ]
        ];

        foreach ($products as $product) {
            Product::create([
                'name'=>$product['name'],
                'description'=>$product['description'],
                'summary'=>$product['summary'],
                'price'=>$product['price'],
                'period'=>$product['period'],
                'system_file'=>$product['system_file'],
            ]);

}



    }
}
