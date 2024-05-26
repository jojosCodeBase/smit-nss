<?php

namespace Database\Seeders;

use App\Models\Volunteer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            Volunteer::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'course' => $faker->randomElement([0, 14]),
                'batch' => $faker->randomElement([1,2]),
                'drives_participated' => 0,
                'absent' => 0,
                'gender' => $faker->randomElement(['M', 'F', 'O']),
                'date_of_birth' => $faker->date(),
                'category' => $faker->randomElement(['SC', 'ST', 'OBC', 'GENERAL']),
                'nationality' => $faker->randomElement(['I', 'N']),
                'document_number' => $faker->numerify('############'),
            ]);
        }
    }
}
