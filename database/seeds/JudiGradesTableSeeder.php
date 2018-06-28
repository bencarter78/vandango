<?php

use Illuminate\Database\Seeder;

class JudiGradesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_grades')->delete();
        
        \DB::table('judi_grades')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Outstanding',
                'created_at' => '2014-12-03 16:33:50',
                'updated_at' => '2014-12-04 16:20:42',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Good',
                'created_at' => '2014-12-03 16:33:50',
                'updated_at' => '2014-12-03 16:33:50',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Requires Improvement',
                'created_at' => '2014-12-03 16:33:50',
                'updated_at' => '2014-12-03 16:33:50',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Inadequate',
                'created_at' => '2014-12-03 16:33:50',
                'updated_at' => '2014-12-03 16:33:50',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Probation',
                'created_at' => '2014-12-03 16:33:50',
                'updated_at' => '2014-12-03 16:33:50',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Not Graded',
                'created_at' => '2014-12-03 16:33:50',
                'updated_at' => '2014-12-03 16:33:50',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Test',
                'created_at' => '2014-12-04 14:49:18',
                'updated_at' => '2014-12-04 15:01:42',
                'deleted_at' => '2014-12-04 15:01:42',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Test Grade',
                'created_at' => '2014-12-04 15:14:07',
                'updated_at' => '2014-12-04 15:14:11',
                'deleted_at' => '2014-12-04 15:14:11',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Quality Assured - No further action',
                'created_at' => '2015-02-04 11:12:45',
                'updated_at' => '2015-02-04 11:16:41',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Quality Assured - PA required',
                'created_at' => '2015-02-04 11:15:02',
                'updated_at' => '2015-02-04 11:15:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
