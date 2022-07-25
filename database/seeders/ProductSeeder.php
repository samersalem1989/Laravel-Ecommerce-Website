<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {

            $products = [
                [
                    'title' => 'Samsung Galaxy',
                    'description' => 'Samsung Brand',
                    'image' => 'https://dummyimage.com/200x300/000/fff&text=Samsung',
                    'price' => 100,
                    'category' => 'electronics'
                ],
    
                [
                    'title' => 'Samsung Galaxy',
                    'description' => 'Samsung Brand',
                    'image' => 'https://dummyimage.com/200x300/000/fff&text=Samsung',
                    'price' => 100,
                    'category' => 'electronics'
                ],
    
                [
                    'title' => 'Samsung Galaxy',
                    'description' => 'Samsung Brand',
                    'image' => 'https://dummyimage.com/200x300/000/fff&text=Samsung',
                    'price' => 100,
                    'category' => 'electronics'
    
                ],
    
                [
                    'title' => 'Samsung Galaxy',
                    'description' => 'Samsung Brand',
                    'image' => 'https://dummyimage.com/200x300/000/fff&text=Samsung',
                    'price' => 100,
                    'category' => 'electronics'
                ]
            ];
    
    
            foreach ($products as $key => $value) {
                Product::create($value);
            }
    
        }
    }
}
