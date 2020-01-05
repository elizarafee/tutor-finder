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

        for ($i = 1; $i <= 100; $i++) {

            $type = rand(2, 3);

            $varified_profiles = [6,8,9,11,17,18,23,25,31,37,41,47,49,53,55,57,61,68,69,72,75,79,80,81,88,71,96,91,92,97];

            $user_id = DB::table('users')->insertGetId([
                'type' => $type,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'picture' => $faker->imageUrl($width = 200, $height = 200),
                'proof_of_id' => $faker->imageUrl($width = 640, $height = 480),
                'email' => $faker->safeEmail,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'mobile' => '01711' . $faker->numberBetween(100000, 999999),
                'password' => Hash::make('password'),
                'approved_at' => in_array($i, $varified_profiles)? date('Y-m-d H:i:s') : null,
                'approved_by' => 1
            ]);


            // Tutor
            if ($type == 2) {

                $tutor_id = DB::table('tutors')->insertGetId([
                    'user_id' => $user_id,
                    'bio' => $faker->realText(rand(150, 200)),
                    'gender' => $gender[rand(0, 1)],
                    'doy' => $faker->year('now'),
                    'covered_area' => rand(1,200),
                    'covered_subjects' => tution_subjects(rand(1,20)).', '.tution_subjects(rand(1,20)).', '.tution_subjects(rand(1,20)),
                    'covered_years' => $faker->realText(rand(150, 200)),
                    'salary' => $faker->numberBetween(1000, 5000),
                ]);

                DB::table('tutor_qualifications')->insertGetId([
                    'tutor_id' => $tutor_id,
                    'level' => rand(1, 5),
                    'subject' => $faker->text(20),
                    'institute' => $faker->company,
                    'status' => $status[rand(0, 1)],
                    'proof_of_doc' => $faker->imageUrl($width = 640, $height = 480),
                    'note' => $faker->realText(rand(100, 200)),
                ]);


            // Student
            } elseif ($type == 3) {
                $class = years_of_study();
                DB::table('students')->insertGetId([
                    'user_id' => $user_id,
                    'bio' => $faker->realText(rand(150, 200)),
                    'gender' => $gender[rand(0, 1)],
                    'doy' => $faker->year('now'),
                    'class' => rand(1, count($class)),
                    'institute' => $faker->company,
                    'location' => rand(1,200),
                    'subjects' => tution_subjects(rand(1,20)).', '.tution_subjects(rand(1,20)).', '.tution_subjects(rand(1,20)),
                    'requirements' => $faker->realText(rand(100, 200)),
                    'budget' => $faker->numberBetween(1000, 5000),
                ]);
            }
        }
    }
}
