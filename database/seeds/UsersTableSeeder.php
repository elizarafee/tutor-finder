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

            $varified_profiles = [23,25,31,72,75,79,80];

            $completed_at = null;
            if($i == 25) {
                $type = 2;
                $email = 'tutor@email.com';
                $completed_at = date('Y-m-d H:i:s');
            } elseif($i == 75) {
                $type = 3;
                $email = 'student@email.com';
                $completed_at = date('Y-m-d H:i:s');
            }
            
            
            $user_id = DB::table('users')->insertGetId([
                'type' => $type,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'picture' => null,
                'proof_of_id' => null,
                'email' => (in_array($i, [25,75]))? $email : $faker->safeEmail,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'mobile' => '01711' . $faker->numberBetween(100000, 999999),
                'password' => Hash::make('111'),
                'completed_at' => date('Y-m-d H:i:s'),
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
                    'locations' => locations(rand(1,200)).','.locations(rand(1,200)).','.locations(rand(1,200)),
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
                    'proof_of_doc' => null,
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
                    'location' => locations(rand(1,200)),
                    'subjects' => tution_subjects(rand(1,20)).', '.tution_subjects(rand(1,20)).', '.tution_subjects(rand(1,20)),
                    'requirements' => $faker->realText(rand(100, 200)),
                    'budget' => $faker->numberBetween(1000, 5000),
                ]);
            }
        }
    }
}
