<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_of_area = [
            'Ambarkhana',
            'Dargah Mahalla',
            'Darshan Deury',
            'Dargah Gate',
            'Jhornar Par',
            'Mirer Maidan',
            'Miah Fazil Chist',
            'Subidbazar',
            'Rajargali',
            'Dariapara',
            'Lama Bazar',
            'Mirza Jangal',
            'Zindabazar',
            'Kajal Shah',
            'Munshipara',
            'Medical Police Line',
            'Dattapara',
            'Housing Estate',
            'Lichu Bagan',
            'Mazumdari',
            'Electric Supply',
            'Badam Bagicha',
            'Choukidighi',
            'Pir Moholla',
            'Mitali',
            'Londoni Road',
            'Hauldar Para',
            'Pathantala',
            'Akhalia',
            'Baghbari',
            'Madina Market',
            'Sagardigir Par',
            'Shamimabad',
            'Kanishail',
            'Kalapara',
            'Majumder Para',
            'Nabab Road',
            'Wapda',
            'Bhatalia',
            'Lal Dighirpar',
            'Madhu Shahid',
            'Rekabi Bazar',
            'Sekhghat',
            'Taltola',
            'Saudagartala',
            'Tufkhana',
            'Bandar Bazar',
            'Chararpar',
            'Jallar Par',
            'Kalighat',
            'Baruth Khana',
            'Chali Bandar',
            'Jail Road',
            'Nayarpool',
            'Suphani Ghat',
            'Puran Lane',
            'Charadigirpar',
            'Kumarpara',
            'Zinda Bazar',
            'Naya Sarak',
            'Kazitula',
            'Mirboxtula',
            'Chowhatta',
            'Mira Bazar',
            'Mousumi',
            'Sabuj Bagh',
            'Shahi Eidgah',
            'Shakhari Para',
            'Darjee Para',
            'Raynagar',
            'Sonapara',
            'Shibganj',
            'Shadipur',
            'Gopal Tila',
            'Hatimbagh',
            'Lakri Para',
            'Sadipur',
            'Shaplabagh',
            'Tilaghar',
            'Uposhohor Block-A',
            'Uposhohor Block-B',
            'Uposhohor Block-C',
            'Uposhohor Block-D',
            'Uposhohor Block-E',
            'Uposhohor Block-F',
            'Uposhohor Block-G',
            'Uposhohor Block-H',
            'Uposhohor Block-I',
            'Uposhohor Block-J',
            'Tultikar',
            'Mejortila',
        ];

        $areas = array();
        
        foreach($list_of_area as $key => $area) {
            $areas[] = [
                'name' => ucfirst($area),
            ];
        }

        DB::table('areas')->insert($areas);
    }
}
