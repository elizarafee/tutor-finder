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
        $class = years_of_study();
        $institutes = array(
            'Shahjalal University of Science and Technology',
            'Sylhet Agricultural University',
            'Sylhet Engineering College',
            'Leading University',
            'Metropolitan University',
            'North East University',
            'Sylhet International University',
            'Sylhet Law College',
            'Metropolitan Law College',
            'Madan Mohan College',
            'Murari Chand College',
            'British Engineering College',
            'Sylhet Polytechnic Institute',
            'Islami Bank Institute of Technology',
            'Impt Medical technology College',
            'Sylhet MAG Osmani Medical College',
            'Jalalabad Ragib-Rabeya Medical College',
            'Sylhet Women\'s Medical College',
            'North East Medical College',
            'Park View Medical College',
            'Sylhet Central Dental College',
            );

            $schools = array(
                'Anandaniketan',
                'Banyan British School',
                'Cambridge Grammar School & College',
                'Oxford International School & College',
                'Presidency School & College',
                'Royal Institute of Smart Education',
                'Sylhet Grammar School',
                'Sylhet International School & College',
                'The Sylhet Khajanchibari International School & College',
                'Sunny Hill International School',
                'Kawsarabad International School',
                'British Bangladesh International School & College',
                'Jalalabad Cantonment Public School and College',
                'Sylhet Government Pilot High School',
                'Blue Bird School and College',
                'Scholarshome',
                'Government Agragami Girls High School',
                'Border Guard public School and College',
                'Shahjalal Jamia Islamia School and College',
                'Al-Amin Jamia Islamia School and College',
                'Sylhet Government Model School and College',
                'Sylhet Railway Government Primary School',
                'The Sylhet Khajanchi bari International School and College',
                'Beter Bazar Urban Slum Anando School',
                'Kishori Mohon Sorkari Prathomik Biddaloy',
                'Amberkhana Dorga Gate Govt Primary School',
                'Police Lines High School',
                'Syed Hatim Ali Government Primary School',
                'The Aided High School',
                );
        
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 10; $i++) {
            $type = rand(2, 3);

            $varified_profiles = [1,2,5,7];

            $completed_at = null;
            if ($i == 1) {
                $type = 2;
                $email = 'tutor@email.com';
            } elseif ($i == 2) {
                $type = 3;
                $email = 'student@email.com';
            }
            
            
            $user_id = DB::table('users')->insertGetId([
                'type' => $type,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'picture' => null,
                'proof_of_id' => null,
                'email' => (in_array($i, [1,2]))? $email : $faker->safeEmail,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'mobile' => '01711' . $faker->numberBetween(100000, 999999),
                'password' => Hash::make('111'),
                'completed_at' => date('Y-m-d H:i:s'),
                'reviewed' => in_array($i, $varified_profiles)? 1 : 0,
                'approved_at' => in_array($i, $varified_profiles)? date('Y-m-d H:i:s') : null,
                'approved_by' => 1
            ]);


            // Tutor
            if ($type == 2) {
                $tutor_id = DB::table('tutors')->insertGetId([
                    'user_id' => $user_id,
                    'bio' => $faker->realText(rand(100, 150)),
                    'gender' => $gender[rand(0, 1)],
                    'year_of_birth' => $faker->year('now'),
                    'locations' => locations(rand(1, 80)).', '.locations(rand(1, 80)).', '.locations(rand(1, 80)),
                    'covered_subjects' => tution_subjects(rand(1, 20)).', '.tution_subjects(rand(1, 20)).', '.tution_subjects(rand(1, 20)),
                    'covered_years' => $class[rand(1, count($class)-1)].', '.$class[rand(1, count($class)-1)].', '.$class[rand(1, count($class)-1)], 
                    'salary' => $faker->numberBetween(1000, 5000),
                ]);

                $level = 1;
                $subject = 'CSE';
                $institute_id = rand(0, count($institutes)-1);
                if($institute_id >= 0 && $institute_id <= 6) {
                    $level = 3;
                    $subject = 'CSE';
                } elseif($institute_id >= 7 && $institute_id <= 8) {
                    $level = 3;
                    $subject = 'LLB';
                } elseif($institute_id >= 9 && $institute_id <= 10) {
                    $level = 2;
                    $subject = 'Degree';
                } elseif($institute_id >= 11 && $institute_id <= 13) {
                    $level = 1;
                    $subject = 'Vocational';
                } else {
                    $level = 3;
                    $subject = 'MBBS';
                }

                DB::table('tutor_qualifications')->insertGetId([
                    'tutor_id' => $tutor_id,
                    'level' => $level,
                    'subject' => $subject,
                    'institute' => $institutes[$institute_id],
                    'status' => $status[rand(0, 1)],
                    'proof_of_doc' => null,
                    'note' => $faker->realText(rand(100, 200)),
                ]);


            // Student
            } elseif ($type == 3) {
                
                DB::table('students')->insertGetId([
                    'user_id' => $user_id,
                    'bio' => $faker->realText(rand(100, 150)),
                    'gender' => $gender[rand(0, 1)],
                    'year_of_birth' => $faker->year('now'),
                    'class' => rand(1, count($class)),
                    'institute' => $schools[rand(0, count($schools)-1)],
                    'location' => locations(rand(1, 80)),
                    'subjects' => tution_subjects(rand(1, 20)).', '.tution_subjects(rand(1, 20)).', '.tution_subjects(rand(1, 20)),
                    'requirements' => $faker->realText(rand(100, 200)),
                    'budget' => $faker->numberBetween(1000, 5000),
                ]);
            }
        }
    }
}




