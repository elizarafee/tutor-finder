<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ModaratorTableSeeder extends Seeder
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
                'type' => 3,
                'first_name' => 'Hasan',
                'last_name' => 'Tareque',
                'email' => 'hmtareque@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'type' => 3,
                'first_name' => 'Hasan',
                'last_name' => 'Tareque',
                'email' => 'hmtareque@gmail.com',
                'password' => Hash::make('password'),
            ]
        );

        DB::table('users')->insert($modarators);
    }
}
