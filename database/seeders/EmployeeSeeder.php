<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Employee;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++){
            Employee::create([
                'employeeId' => $faker->unique()->randomNumber(5),
                'username' => $faker->unique()->userName,
                'password' => bcrypt('password'),
                'employeeName' => $faker->name,
                'dateOfBirth' => $faker->date(),
                'employeePhone' => $faker->phoneNumber,
                'employeeEmail' => $faker->unique()->safeEmail,
                'profilePicture' => $faker->imageUrl(640, 480, 'people'),
                'position' => $faker->word,
                'department' => $faker->word,
                'hireDate' => $faker->date(),
                'terminationDate' => $faker->date(),
            ]);
        }
    }
}
