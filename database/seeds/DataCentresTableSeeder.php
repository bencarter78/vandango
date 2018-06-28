<?php

use Illuminate\Database\Seeder;

class DataCentresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_centres')->delete();
        
        \DB::table('data_centres')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Burford House',
                'add1' => 'Burford House',
                'add2' => 'Prince Albert Street',
                'add3' => NULL,
                'add4' => 'Crewe',
                'add5' => 'Cheshire',
                'post_code' => 'CW1 2DJ',
                'tel' => '01270 251493',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Winsford',
                'add1' => 'Castle Court',
                'add2' => 'Nat Lane',
                'add3' => NULL,
                'add4' => 'Winsford',
                'add5' => 'Cheshire',
                'post_code' => 'CW7 3BS',
                'tel' => '01606 596606',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Burslem',
                'add1' => '10 Newcastle Street',
                'add2' => NULL,
                'add3' => 'Burslem',
                'add4' => 'Stoke-on-Trent',
                'add5' => 'Staffordshire',
                'post_code' => 'ST6 3QF',
                'tel' => '01782 525740',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Burton',
                'add1' => 'Burton Enterprise Centre',
                'add2' => 'Waterloo Street',
                'add3' => NULL,
                'add4' => 'Burton-upon-Trent',
                'add5' => 'Staffordshire',
                'post_code' => 'DE14 2NB',
                'tel' => '01283 510301',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'SCC',
                'add1' => 'South Cheshire College',
                'add2' => 'Dane Bank Avenue',
                'add3' => NULL,
                'add4' => 'Crewe',
                'add5' => 'Cheshire',
                'post_code' => 'CW2 8AB',
                'tel' => '01270 654620',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Macclesfield',
                'add1' => 'Sovereign Court',
                'add2' => 'King Edward Street',
                'add3' => NULL,
                'add4' => 'Macclesfield',
                'add5' => 'Cheshire',
                'post_code' => 'SK10 1AF',
                'tel' => '01625 618136',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Market Drayton',
                'add1' => 'Market Drayton Youth Centre',
                'add2' => 'Drayton Grove',
                'add3' => NULL,
                'add4' => 'Market Drayton',
                'add5' => 'Shropshire',
                'post_code' => 'TF9 3AD',
                'tel' => '07976 571325',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Group House',
                'add1' => 'King Street',
                'add2' => NULL,
                'add3' => NULL,
                'add4' => 'Middlewich',
                'add5' => 'Cheshire',
                'post_code' => 'CW10 9LZ',
                'tel' => '01606 734000',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Runcorn',
                'add1' => 'Suite 5 Second Floor',
                'add2' => 'Orange Zone, Halton 5',
                'add3' => 'Halton Lea',
                'add4' => 'Runcorn',
                'add5' => 'Cheshire',
                'post_code' => 'WA7 2HF',
                'tel' => '01928 712663',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Telford',
                'add1' => 'Unit F',
                'add2' => 'Halesfield',
                'add3' => NULL,
                'add4' => 'Telford',
                'add5' => 'Shropshire',
                'post_code' => 'TF7 4QR',
                'tel' => '01952 681030',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Warrington',
                'add1' => 'The Boultings, Ground Floor, Unit C',
                'add2' => 'Winwick Street',
                'add3' => '',
                'add4' => 'Warrington',
                'add5' => 'Cheshire',
                'post_code' => 'WA2 7TT',
                'tel' => '01606 734000',
                'created_at' => '2015-10-26 12:53:45',
                'updated_at' => '2015-10-26 12:53:45',
            ),
        ));
        
        
    }
}
