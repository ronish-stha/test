<?php

namespace Database\Seeders;

use App\Banner;
use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addBanner('slide1.jpg', 'promotion');
        $this->addBanner('adbanner1.jpg', 'promotion');
        $this->addBanner('adbanner2.jpg', 'promotion');
    }

    public function addBanner($image, $type) {
        $banner = new Banner();
        $banner->image = $image;
        $banner->type = $type;
        $banner->save();
    }
}
