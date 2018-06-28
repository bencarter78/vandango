<?php

use Illuminate\Database\Seeder;

class JudiProcessesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_processes')->delete();
        
        \DB::table('judi_processes')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Test Process',
                'trigger_week' => 17,
                'created_at' => '2014-11-27 12:45:50',
                'updated_at' => '2014-12-04 15:43:23',
                'deleted_at' => '2014-12-04 15:43:23',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Progress Review Desktop',
                'trigger_week' => 21,
                'created_at' => '2014-11-27 12:48:32',
                'updated_at' => '2016-01-06 14:10:35',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Health & Safety',
                'trigger_week' => 17,
                'created_at' => '2014-11-27 12:48:48',
                'updated_at' => '2014-11-27 12:48:48',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Initial Assessment',
                'trigger_week' => 21,
                'created_at' => '2014-11-27 12:48:59',
                'updated_at' => '2016-03-09 11:50:07',
                'deleted_at' => '2016-03-09 11:50:07',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Teaching & Learning',
                'trigger_week' => 21,
                'created_at' => '2014-11-27 12:49:10',
                'updated_at' => '2016-01-06 14:09:48',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Internal Quality Assurance',
                'trigger_week' => 17,
                'created_at' => '2014-11-27 12:49:28',
                'updated_at' => '2014-11-27 12:49:28',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'Instruction',
                'trigger_week' => 21,
                'created_at' => '2014-11-27 12:49:36',
                'updated_at' => '2016-01-06 14:10:15',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'Performance Assessor',
                'trigger_week' => 17,
                'created_at' => '2014-11-27 12:49:50',
                'updated_at' => '2016-03-09 11:50:12',
                'deleted_at' => '2016-03-09 11:50:12',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'Progress Review Observation',
                'trigger_week' => 21,
                'created_at' => '2015-01-14 17:02:55',
                'updated_at' => '2016-01-06 14:10:44',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
