<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modarators = array(
            [
                'type' => 1,
                'first_name' => 'Eliza',
                'last_name' => 'Ahmed',
                'email' => 'elizarafee@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ],
            [
                'type' => 1,
                'first_name' => 'Hasan',
                'last_name' => 'Tareque',
                'email' => 'hmtareque@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]
        );

        DB::table('users')->insert($modarators);
    }
}
