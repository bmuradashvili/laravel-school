<?php

use App\Teacher;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::query()->truncate();
        $teachers = factory(Teacher::class, 50)->create();

        $faker = Faker::create();
        $imageUrl = $faker->imageUrl(640,480, null, false);

        foreach($teachers as $teacher){
            $teacher->addMediaFromUrl($imageUrl)->toMediaCollection('thumbnail');
        }
    }
}
