<?php

use App\Models\Student as StudentModel;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
class StudentSeeder extends Seeder
{
    public function run() {
        $faker = Faker::create();
        Model::unguard();

        StudentModel::truncate();

        foreach (range(1,50) as $index) {

            //Main
            $student = StudentModel::create([
                'creator_user_id' => $faker->numberBetween(2,3),
                'first_name'=> $faker->firstName,
                'last_name'=> $faker->lastName,
                'email' => $faker->email,
                'mobile_number' => $faker->e164PhoneNumber,
                'address' => $faker->address,
                'user_id' => null
            ]);

        }

        Model::reguard();
    }
}