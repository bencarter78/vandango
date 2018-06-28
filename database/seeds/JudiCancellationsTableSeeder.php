<?php

use Illuminate\Database\Seeder;

class JudiCancellationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_cancellations')->delete();
        
        \DB::table('judi_cancellations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'type' => 'Test Reason',
                'created_at' => '2014-12-09 12:24:13',
                'updated_at' => '2014-12-09 14:29:15',
                'deleted_at' => '2014-12-09 14:29:15',
            ),
            1 => 
            array (
                'id' => 2,
                'type' => 'Leaver',
                'created_at' => '2014-12-09 14:29:44',
                'updated_at' => '2014-12-09 14:29:44',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'type' => 'Posted in error',
                'created_at' => '2014-12-11 15:22:26',
                'updated_at' => '2014-12-11 15:22:26',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'type' => 'Maternity',
                'created_at' => '2014-12-18 15:52:46',
                'updated_at' => '2014-12-18 15:52:46',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'type' => 'Long Term Sick',
                'created_at' => '2014-12-18 15:53:05',
                'updated_at' => '2014-12-18 15:53:05',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'type' => 'Not required this year',
                'created_at' => '2015-01-13 12:00:52',
                'updated_at' => '2015-01-13 12:31:38',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
