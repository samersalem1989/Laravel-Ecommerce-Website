<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $categories = [
                [
                    'name' => 'shoes',
                    'image' => 'f-p-1.jpg'
                ],

                [
                    'name' => 'purses',
                    'image' => 'f-p-2.jpg'
                ],

                [
                    'name' => 'watches',
                    'image' => 'f-p-3.jpg'

                ],

                [
                    'name' => 'clothes',
                    'image' => 'i2.jpg'
                ]
            ];


            foreach ($categories as $key => $value) {
                Category::create($value);
            }

    }

    
}
