<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Offer;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                $offer = 
                    [
                        'title' => 'all men’s collection',
                        'discount' => '50% off',
                        'details' => 'Limited Time Offer',
                        'image' => 'offer-bg.png'
                    ];

                    Offer::create($offer);
            }
}
