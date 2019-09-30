<?php

use App\Director;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DirectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Director::query()->truncate();
        $directors = factory(Director::class, 50)->create();

        $faker = Faker::create();
        $imageUrl = $faker->imageUrl(640,480, null, false);

        foreach($directors as $director){
            $director->addMediaFromUrl($imageUrl)->toMediaCollection('director_thumbnails');
        }
    }
}
