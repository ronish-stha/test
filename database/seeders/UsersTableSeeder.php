<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\SellerDetail;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('title', 'admin')->first();
        $customerRole = Role::where('title', 'customer')->first();
        $sellerRole = Role::where('title', 'seller')->first();

        $admin = new User();
        $admin->first_name = 'Super';
        $admin->last_name = 'Admin';
        $admin->email = 'superadmin@liquor.com';
        $admin->password = bcrypt('iamsuperadmin');
        $admin->status = 1;
        $admin->verified = 1;
        $admin->user_type_id = 1;
        $admin->save();
        $admin->roles()->attach($adminRole);

        $customer = new User();
        $customer->first_name = 'Test';
        $customer->last_name = 'Customer';
        $customer->email = 'customer@liquor.com';
        $customer->password = bcrypt('iamcustomer');
        $customer->address = 'New Baneshwor';
        $customer->city = 'Kathmandu';
        $customer->district = 'Kathmandu';
        $customer->zone = 'Bagmati';
        $customer->phone = 768428917;
        $customer->phone2 = 768327898;
        $customer->status = 1;
        $customer->verified = 1;
        $customer->user_type_id = 2;
        $customer->save();
        $customer->roles()->attach($customerRole);

        $customer = new User();
        $customer->first_name = 'Test';
        $customer->last_name = 'Customer2';
        $customer->email = 'customer2@liquor.com';
        $customer->password = bcrypt('iamcustomer2');
        $customer->address = 'Kamakashi';
        $customer->city = 'Kathmandu';
        $customer->district = 'Lalitpur';
        $customer->zone = 'Pulchowk';
        $customer->phone = 768428917;
        $customer->phone2 = 768327898;
        $customer->status = 1;
        $customer->verified = 1;
        $customer->user_type_id = 2;
        $customer->save();
        $customer->roles()->attach($customerRole);


        $seller = new User();
        $seller->first_name = 'KTM';
        $seller->last_name = 'Liquor';
        $seller->email = 'seller@liquor.com';
        $seller->password = bcrypt('iamseller');
        $seller->address = 'Kamaladi';
        $seller->district = 'Kathmandu';
        $seller->zone = 'Bagmati';
        $seller->phone = 768428917;
        $seller->phone2 = 768327898;
        $seller->status = 1;
        $seller->verified = 1;
        $seller->user_type_id = 3;
        $seller->save();
        $seller->roles()->attach($sellerRole);

        $sellerDetail = new SellerDetail();
        $sellerDetail->user_id = $seller->id;
        $sellerDetail->store_name = 'KTM Liquor';
        $sellerDetail->save();


        $seller = new User();
        $seller->first_name = 'Liquor';
        $seller->last_name = 'House';
        $seller->email = 'seller2@liquor.com';
        $seller->password = bcrypt('iamseller');
        $seller->address = 'Kamaladi';
        $seller->district = 'Kathmandu';
        $seller->zone = 'Bagmati';
        $seller->phone = 768428917;
        $seller->phone2 = 768327898;
        $seller->status = 1;
        $seller->verified = 1;
        $seller->user_type_id = 3;
        $seller->save();
        $seller->roles()->attach($sellerRole);

        $sellerDetail = new SellerDetail();
        $sellerDetail->user_id = $seller->id;
        $sellerDetail->store_name = 'Liquor House';
        $sellerDetail->save();


        $seller = new User();
        $seller->first_name = 'Drinks';
        $seller->last_name = 'Pasal';
        $seller->email = 'seller3@liquor.com';
        $seller->password = bcrypt('iamseller');
        $seller->address = 'Kamaladi';
        $seller->district = 'Kathmandu';
        $seller->zone = 'Bagmati';
        $seller->phone = 768428917;
        $seller->phone2 = 768327898;
        $seller->status = 0;
        $seller->verified = 0;
        $seller->user_type_id = 3;
        $seller->save();
        $seller->roles()->attach($sellerRole);

        $sellerDetail = new SellerDetail();
        $sellerDetail->user_id = $seller->id;
        $sellerDetail->store_name = 'Drinks Pasal';
        $sellerDetail->save();
    }
}
