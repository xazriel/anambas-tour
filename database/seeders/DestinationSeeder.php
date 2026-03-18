<?php

namespace Database\Seeders;

use App\Models\Destination; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        Destination::create([
            'name' => 'Pantai Padang Melang',
            'description' => 'Pantai terpanjang di Kepulauan Anambas dengan pasir putih yang halus.',
            'category' => 'Pantai',
            'price_info' => 'Gratis, biaya parkir Rp5.000',
        ]);

        Destination::create([
            'name' => 'Mie Tarempa',
            'description' => 'Kuliner khas Anambas dengan mie kenyal dan potongan ikan tongkol berbumbu pedas.',
            'category' => 'Kuliner',
            'price_info' => 'Rp15.000 - Rp25.000 per porsi',
        ]);
    }
}