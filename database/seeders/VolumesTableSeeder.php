<?php

namespace Database\Seeders;

use App\Models\Volume;
use Illuminate\Database\Seeder;

class VolumesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $volumes = [
            [
                'volume' => '180ml',
                'quantity' => 1
            ],
            [
                'volume' => '250ml',
                'quantity' => 1
            ],
            [
                'volume' => '330ml',
                'quantity' => 1
            ],
            [
                'volume' => '355ml',
                'quantity' => 1
            ],
            [
                'volume' => '385ml',
                'quantity' => 1
            ],
            [
                'volume' => '350ml',
                'quantity' => 1
            ],
            [
                'volume' => '375ml',
                'quantity' => 1
            ],
            [
                'volume' => '473ml',
                'quantity' => 1
            ],
            [
                'volume' => '500ml',
                'quantity' => 1
            ],
            [
                'volume' => '650ml',
                'quantity' => 1
            ],
            [
                'volume' => '700ml',
                'quantity' => 1
            ],
            [
                'volume' => '720ml',
                'quantity' => 1
            ],
            [
                'volume' => '750ml',
                'quantity' => 1
            ],
            [
                'volume' => '1000ml',
                'quantity' => 1
            ],
            [
                'volume' => '1500ml',
                'quantity' => 1
            ],
            [
                'volume' => '1800ml',
                'quantity' => 1
            ],
            [
                'volume' => '2000ml',
                'quantity' => 1
            ],
            [
                'volume' => '3000ml',
                'quantity' => 1
            ],
            [
                'volume' => '4000ml',
                'quantity' => 1
            ],
            [
                'volume' => '5000ml',
                'quantity' => 1
            ],
            [
                'volume' => '6x330ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x330ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x330ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x330ml',
                'quantity' => 20
            ],
            [
                'volume' => '24x330ml',
                'quantity' => 24
            ],
            [
                'volume' => '6x355ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x355ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x355ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x355ml',
                'quantity' => 20
            ],
            [
                'volume' => '24x355ml',
                'quantity' => 24
            ],
            [
                'volume' => '6x473ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x473ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x473ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x473ml',
                'quantity' => 20
            ],
            [
                'volume' => '24x473ml',
                'quantity' => 24
            ],
            [
                'volume' => '6x500ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x500ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x500ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x500ml',
                'quantity' => 20
            ],
            [
                'volume' => '24x500ml',
                'quantity' => 24
            ],
            [
                'volume' => '6x650ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x650ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x650ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x650ml',
                'quantity' => 20
            ],
            [
                'volume' => '24x650ml',
                'quantity' => 24
            ],
            [
                'volume' => '6x500ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x500ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x500ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x500ml',
                'quantity' => 20
            ],
            [
                'volume' => '6x650ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x650ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x650ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x650ml',
                'quantity' => 20
            ],
            [
                'volume' => '24x650ml',
                'quantity' => 24
            ],
            [
                'volume' => '24x500ml',
                'quantity' => 24
            ],
            [
                'volume' => '6x710ml',
                'quantity' => 6
            ],
            [
                'volume' => '12x710ml',
                'quantity' => 12
            ],
            [
                'volume' => '18x710ml',
                'quantity' => 18
            ],
            [
                'volume' => '20x710ml',
                'quantity' => 20
            ],
            [
                'volume' => '24x710ml',
                'quantity' => 24
            ]
        ];

        Volume::insert($volumes);
    }
}
