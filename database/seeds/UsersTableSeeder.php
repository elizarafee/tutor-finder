<?php

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
        $gender = ['Male', 'Female'];
        $status = ['Studying', 'Completed'];
        $years = ['Year 1', 'Year 2', 'Year 3', 'Year 4', 'Year 5', 'Year 6', 'Year 7', 'Year 8', 'Year 9', 'Year 10', 'HSC - Year 1', 'HSC - Year 2'];
        $faker = \Faker\Factory::create();

        for($i=1; $i<=100; $i++) {

            $type = rand(2,3);

            $user_id = DB::table('users')->insertGetId([
                'type' => $type,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'picture' => $faker->imageUrl($width = 200, $height = 200),
                'proof_of_id' => $faker->imageUrl($width = 640, $height = 480),
                'email' => $faker->safeEmail,
                'mobile' => '01711'.$faker->numberBetween(100000, 999999),
                'bio' => $faker->realText(rand(150,200)),
                'gender' => $gender[rand(0,1)],
                'doy' => $faker->year('now'),
                'password' => Hash::make('password')
            ]);


            // Tutor
            if($type == 2) {

                $tutor_id = DB::table('tutors')->insertGetId([
                    'user_id' => $user_id,
                    'covered_area' => $faker->city.','.$faker->city.','.$faker->city,
                    'covered_subjects' => $faker->realText(rand(150,200)),
                    'covered_years' => $faker->realText(rand(150,200)),
                    'salary' => $faker->numberBetween(1000, 5000),
                ]);

                DB::table('tutor_qualifications')->insertGetId([
                    'tutor_id' => $tutor_id,
                    'level' => rand(1,5),
                    'subject' => $faker->text(20),
                    'institute' => $faker->company,
                    'status' => $status[rand(0,1)],
                    'proof_of_doc' => $faker->imageUrl($width = 640, $height = 480),
                    'note' => $faker->realText(rand(100,200)),
                ]);

               

            // Student
            } elseif($type == 3) {
                DB::table('students')->insertGetId([
                    'user_id' => $user_id,
                    'year' => $years[rand(0, count($years)-1)],
                    'institute' => $faker->company,
                    'location' => $faker->city,
                    'subjects' => $faker->realText(rand(150,200)),
                    'requirements' => $faker->realText(rand(100,200)),
                    'budget' => $faker->numberBetween(1000, 5000),
                ]);
            }
        }
    }
}
