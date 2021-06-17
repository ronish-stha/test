<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = new Content();
        $content->title = 'Homepage 1';
        $content->heading1 = 'KEEP CALM DRINK BEER';
        $content->heading2 = 'We provide best service in liquor deliver';
        $content->image1 = 'img/home/131.png';
        $content->image2 = 'img/home/13.png';
        $content->position = 1;
        $content->status = 'active';
        $content->save();

        $content = new Content();
        $content->title = 'Homepage 2';
        $content->heading1 = 'Enter your address';
        $content->heading2 = '24/7 Support';
        $content->heading3 = 'Secure Payments';
        $content->content1 = "Let us know where you're at and we'll show you what's available in your area.";
        $content->content2 = 'We are available 24/7 to address your needs and requirements.';
        $content->content3 = 'We provide secure payments with cash on delivery options.';
        $content->image1 = 'img/home/26.png';
        $content->image2 = 'img/home/27.png';
        $content->image3 = 'img/home/28.png';
        $content->position = 2;
        $content->status = 'active';
        $content->save();

        $content = new Content();
        $content->title = 'Homepage 3';
        $content->heading1 = 'VERIFIED QUALITY';
        $content->heading2 = 'Summer Discount';
        $content->heading3 = 'Up to 30%';
        $content->content1 = 'Looking for the perfect last-minute gift? Want to schedule a delivery up to 2 weeks early? Send them bourbon, champagne and more and prepare for endless air-fives.';
        $content->image1 = 'img/home/cheers1.png';
        $content->position = 3;
        $content->button1 = 'Buy Now';
        $content->status = 'active';
        $content->save();

        $content = new Content();
        $content->title = 'Homepage 4';
        $content->heading1 = 'That drink you want?';
        $content->heading2 = 'We’ve got it';
        $content->content1 = 'Looking for the perfect last-minute gift? Want to schedule a delivery up to 2 weeks early? Send them bourbon, champagne and more and prepare for endless air-fives.';
        $content->image1 = 'img/home/liquor.png';
        $content->position = 4;
        $content->button1 = 'Buy Now';
        $content->status = 'active';
        $content->save();

        $content = new Content();
        $content->title = 'Homepage 5';
        $content->heading1 = 'Premium Quality';
        $content->heading2 = 'Delivery Service';
        $content->image1 = 'img/home/29.jpg';
        $content->position = 5;
        $content->button1 = 'LEARN MORE';
        $content->status = 'active';
        $content->save();
    }
}
