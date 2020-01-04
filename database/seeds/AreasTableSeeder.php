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
            'Purba Subidbazar',
            'Rajargali',
            'Dariapara',
            'Kazi Elias Para',
            'Lama Bazar',
            'Mirza Jangal',
            'Zindabazar',
            'Kajal Shah',
            'Keyapara',
            'Munshipara',
            'Subid Bazar',
            'Medical Police Line',
            'Ambarkhana',
            'Dattapara',
            'Housing Estate',
            'Lichu Bagan',
            'Mazumdari',
            'Barabazar',
            'Electric Supply',
            'Goypara',
            'khasdobir',
            'Badam Bagicha',
            'Choukidighi',
            'Eliaskandi',
            'Syedmogni',
            'Jalalabad',
            'West Pir Moholla',
            'Soyef Khan Road',
            'Subid Bazar',
            'Uttar pir moholla',
            'haji para',
            'BonKolapara',
            'Fazil Chisti',
            'Kalapara',
            'Mitali',
            'Londoni Road',
            'Brahman Shashan',
            'Hauldar Para',
            'Kucharpara',
            'Korarpar',
            'Noapara',
            'Panitala',
            'Pathantala',
            'Akhalia',
            'Baghibari',
            'Danukhter',
            'Kuliapar',
            'Madina Market',
            'Nehari Para',
            'Pathantala',
            'Sagardigir Par',
            'Dhar',
            'Gasitala',
            'Shamimabad',
            'Kanishail',
            'Kalapara',
            'Majumder Para',
            'Molla Para',
            'Nabab Road',
            'Wapda',
            'Bhatalia',
            'Bil Par',
            'Kajalshah',
            'Lala Dighirpar',
            'Madhu Shahid',
            'Noapara',
            'Rekabi Baza',
            'Bhangatikar',
            'Itakhola',
            'Kuarpar',
            'Saudagartala',
            'Sekhghat',
            'taltola south',
            'Itakhola',
            'Kuarpar',
            'Saudagartala',
            'tufkhana',
            'masudhighir par',
            'mirja jungle',
            'Bandar Bazar',
            'Brahmandi Bazar',
            'Chali Bandar Poschim',
            'Chararpar',
            'Hasan Market',
            'Dak Bangla Road',
            'Dhupra Dighirpar',
            'Jallar Par',
            'Jamtala',
            'Houkers Market',
            'Kastagarh',
            'Kamal Garh',
            'Kalighat',
            'Lal Dighirpar',
            'Paura Biponi',
            'Paura Mirzajangal',
            'Shah Chatt Road',
            'Uttar Talitala',
            'Bandar Bazar',
            'Baruth Khana',
            'Chali Bandar',
            'Churi Patti',
            'Hasan Market',
            'Jail Road',
            'Joynagar',
            'Jaiarpur',
            'Nayarpool',
            'Noapara',
            'Suphani Ghat',
            'Puran Lane',
            'Uttar Dhopa Dighirpar',
            'Charadigirpar',
            'Dhoper Digirpar',
            'Hauapara',
            'Kahan Daura',
            'Kumarpara',
            'Purba Zinda Bazar',
            'Naya Sarak',
            'Saudagar Tola',
            'Tantipara',
            'Kazitula',
            'Ambarkhana',
            'Mirboxtula',
            'Chondontula',
            'Chowhatta',
            'Uchasarak',
            'Kumarpara',
            'Brajahat Tila',
            'Evergreen',
            'Jharnarpar',
            'Jherjheri Para',
            'Kumar Para',
            'Mira Bazar',
            'Mousumi',
            'Sabuj Bagh',
            'Serak',
            'Shahi Eidgah',
            'Shakhari Para',
            'Chandani Tila',
            'Daptari Para',
            'Darjee Band',
            'Darjee Para',
            'Goner Para',
            'Kahar Para',
            'Raynagar',
            'Sonapara',
            'Balichhara South',
            'Kharadi Para',
            'Lama Para',
            'Majumder Para',
            'Roynagar',
            'Senpara',
            'Sonarpara',
            'Shibganj',
            'Shadipur',
            'Bhatatikr',
            'Brahman Para',
            'Gopal Tila',
            'Hatimbagh',
            'Lakri Para',
            'Sadipur',
            'Shaplabagh',
            'Tilaghar',
            'Sonar Para',
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
            'Shahjalal Uposhohor Bangladesh Bank Colony',
            'Machimpur',
            'Mehendibagh',
            'Hatimbagh',
            'Kushighat',
            'Lamapara',
            'Mirapara',
            'Sadatikar',
            'Saderpara',
            'Shapla Bagh',
            'Sadipur-2',
            'Tero Ratan',
            'Tultikar',
            'Purbo Sadatikar',
            'Barokhola',
            'Godrail',
            'Khojarkhola',
            'Mominkhola',
            'Musargoan',
            'Lawai',
            'Bharthokhola',
            'Chandnighat',
            'Jalopara',
            'Kadamtali',
            'Alampur',
            'Ganganagar',
            'Mejortila',
        ];

        $areas = array();
        
        foreach($list_of_area as $area) {
            $areas[] = [
                'name' => ucfirst($area),
            ];
        }

        DB::table('areas')->insert($areas);
    }
}