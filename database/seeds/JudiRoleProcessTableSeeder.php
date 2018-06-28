<?php

use Illuminate\Database\Seeder;

class JudiRoleProcessTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_role_process')->delete();
        
        \DB::table('judi_role_process')->insert(array (
            0 => 
            array (
                'id' => 11,
                'process_id' => 7,
                'role_id' => 69,
                'created_at' => '2014-12-01 15:45:07',
                'updated_at' => '2015-10-26 12:53:46',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 17,
                'process_id' => 5,
                'role_id' => 13,
                'created_at' => '2014-12-01 16:03:53',
                'updated_at' => '2015-10-26 12:53:46',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 18,
                'process_id' => 8,
                'role_id' => 37,
                'created_at' => '2014-12-01 16:04:02',
                'updated_at' => '2015-10-26 12:53:46',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 19,
                'process_id' => 9,
                'role_id' => 26,
                'created_at' => '2014-12-01 16:04:12',
                'updated_at' => '2015-10-26 12:53:46',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 21,
                'process_id' => 6,
                'role_id' => 30,
                'created_at' => '2014-12-01 16:04:33',
                'updated_at' => '2015-10-26 12:53:46',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 27,
                'process_id' => 3,
                'role_id' => 13,
                'created_at' => '2014-12-05 12:57:41',
                'updated_at' => '2015-10-26 12:53:46',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 28,
                'process_id' => 10,
                'role_id' => 13,
                'created_at' => '2015-01-14 17:02:55',
                'updated_at' => '2015-10-26 12:53:46',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
