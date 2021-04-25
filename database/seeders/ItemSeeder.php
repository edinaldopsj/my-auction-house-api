<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Faker\Factory as Faker;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            $item = new Item();

            $item->name = $faker->name;
            $item->description = $faker->text;
            $item->price = $faker->numberBetween(100, 1000000);
            $item->end = $faker->dateTimeBetween('+1 days', '+2 days');
            $item->buyer_id = "0";

            $item->save();
        }
    }
}
