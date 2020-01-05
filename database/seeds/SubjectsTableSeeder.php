<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = array(
            'Bangla',
            'English',
            'Information & Communication Technology',
            'Accounting',
            'Business organization and Management',
            'Finance, Banking, and Insurance',
            'Production Management and Marketing',
            'Agricultural Education',
            'Economics',
            'Islamic History',
            'History',
            'Social Work',
            'Sociology',
            'Studies of Islam',
            'Logic',
            'Home Science',
            'Physics',
            'Chemistry',
            'Biology',
            'Higher Math',
            'History of Bangladesh Paper',
            'Science',
            'Business Initiative',
            'Geography and Environment',
            'Bangladesh and Global Studies',
            'Civics and Good Citizenship',
            'Finance and Banking',
        );

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert(['name' => $subject]);
        }
    }
}
