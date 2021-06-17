<?php

namespace Database\Seeders;

use App\Models\category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $liquor = new Category();
        $liquor->title = 'Liquor';
        $liquor->real_depth = 0;
        $liquor->save();

        /*------------Liquor SubCategories---------*/
        $subCategory = new Category();
        $subCategory->title = 'Whiskey';
        $subCategory->parent_id = $liquor->id;
        $subCategory->real_depth = 1;
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->title = 'Vodka';
        $subCategory->parent_id = $liquor->idi;
        $subCategory->real_depth = 1;
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->title = 'Rum';
        $subCategory->parent_id = $liquor->id;
        $subCategory->real_depth = 1;
        $subCategory->save();
        /*------------Liquor SubCategories---------*/


        $beer = new Category();
        $beer->title = 'Beer';
        $beer->real_depth = 0;
        $beer->save();

        $wine = new Category();
        $wine->title = 'Wine';
        $wine->real_depth = 0;
        $wine->save();

        $mainCategory = new Category();
        $mainCategory->title = 'More';
        $mainCategory->real_depth = 0;
        $mainCategory->save();

        /*------------Wine SubCategories---------*/

        $subCategory = new Category();
        $subCategory->title = 'Red Wine';
//        $subCategory->parent_id = $wine->id;
        $subCategory->parent_id = 6;
        $subCategory->real_depth = 1;
        $subCategory->save();

        /*------------Redwine SubCategories---------*/

        $childCategory = new Category();
        $childCategory->title = 'Cabernet Saubignon';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Pinot Noir';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Red Blends';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Malbec';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();
        /*------------RedWine SubCategories---------*/


        $subCategory = new Category();
        $subCategory->title = 'White Wine';
//        $subCategory->parent_id = $wine->id;
        $subCategory->parent_id = 6;
        $subCategory->real_depth = 1;
        $subCategory->save();

        /*------------WhiteWine SubCategories---------*/
        $childCategory = new Category();
        $childCategory->title = 'Sauvignon Blanc';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Chardonnay';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Pinot Grigio';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Moscato';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();
        /*------------WhiteWine SubCategories---------*/

        $subCategory = new Category();
        $subCategory->title = 'Sparkling Wine';
//        $subCategory->parent_id = $wine->id;
        $subCategory->parent_id = 6;
        $subCategory->real_depth = 1;
        $subCategory->save();

        /*------------SparklingWine SubCategories---------*/
        $childCategory = new Category();
        $childCategory->title = 'Champagne';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Prosecco';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'American Sparkling';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();

        $childCategory = new Category();
        $childCategory->title = 'Sparkling Rose';
        $childCategory->parent_id = $subCategory->id;
        $childCategory->real_depth = 2;
        $childCategory->save();
        /*------------SparklingWine SubCategories---------*/
        /*------------Wine SubCategories---------*/


        /*------------Beer SubCategories---------*/
        $subCategory = new Category();
        $subCategory->title = 'IPA';
//        $subCategory->parent_id = $beer->id;
        $subCategory->parent_id = 5;
        $subCategory->real_depth = 1;
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->title = 'Lager';
//        $subCategory->parent_id = $beer->id;
        $subCategory->parent_id = 5;
        $subCategory->real_depth = 1;
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->title = 'Light Beer';
//        $subCategory->parent_id = $beer->id;
        $subCategory->parent_id = 5;
        $subCategory->real_depth = 1;
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->title = 'Ale';
//        $subCategory->parent_id = $beer->id;
        $subCategory->parent_id = 5;
        $subCategory->real_depth = 1;
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->title = 'Stout';
//        $subCategory->parent_id = $beer->id;
        $subCategory->parent_id = 5;
        $subCategory->real_depth = 1;
        $subCategory->save();

        $subCategory = new Category();
        $subCategory->title = 'Sour Beer';
//        $subCategory->parent_id = $beer->id;
        $subCategory->parent_id = 5;
        $subCategory->real_depth = 1;
        $subCategory->save();
        /*------------Beer SubCategories---------*/

    }
}
