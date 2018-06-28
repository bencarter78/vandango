<?php

use Illuminate\Database\Seeder;

class JudiReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_reports')->delete();
        
        \DB::table('judi_reports')->insert(array (
            0 => 
            array (
                'id' => 17,
                'title' => 'IQA',
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. ',
                'created_at' => '2014-12-05 09:14:21',
                'updated_at' => '2014-12-05 09:14:21',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 18,
                'title' => 'Progress Review Observation',
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'created_at' => '2014-12-05 12:13:49',
                'updated_at' => '2014-12-05 12:13:49',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 19,
                'title' => 'Progress Review Desktop',
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'created_at' => '2014-12-05 12:37:00',
                'updated_at' => '2014-12-05 12:37:00',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 20,
                'title' => 'Observation of individual learning activity ',
                'description' => '',
                'created_at' => '2014-12-16 16:48:39',
                'updated_at' => '2015-01-13 12:38:49',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 21,
                'title' => 'Observation of teaching, learning and assessment ',
                'description' => '',
                'created_at' => '2014-12-16 16:51:38',
                'updated_at' => '2015-01-13 12:38:35',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 22,
                'title' => 'Observation of Instruction',
                'description' => '',
                'created_at' => '2015-01-13 12:38:16',
                'updated_at' => '2015-01-13 12:38:16',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 23,
                'title' => 'Health and Safety Monthly Audit',
                'description' => '',
                'created_at' => '2015-02-04 11:01:49',
                'updated_at' => '2015-02-04 11:01:49',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 24,
                'title' => 'Health and Safety Desktop',
                'description' => '',
                'created_at' => '2015-02-04 11:43:23',
                'updated_at' => '2015-02-04 11:43:23',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 25,
                'title' => 'Health and Safety Observation',
                'description' => '',
                'created_at' => '2015-02-04 11:43:51',
                'updated_at' => '2015-02-04 11:43:51',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
