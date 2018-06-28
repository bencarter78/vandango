<?php

use Illuminate\Database\Seeder;

class DataApplicationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_applications')->delete();
        
        \DB::table('data_applications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'CRM',
                'slug' => 'crm',
                'icon' => 'leaf',
                'priority' => 9,
                'active' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'MatchMaker',
                'slug' => 'matchmaker',
                'icon' => 'heart',
                'priority' => NULL,
                'active' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Reports',
                'slug' => 'reports/adhoc',
                'icon' => 'bar-chart-o',
                'priority' => NULL,
                'active' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Bursary',
                'slug' => 'postcodes',
                'icon' => 'map-marker',
                'priority' => NULL,
                'active' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'UserManager',
                'slug' => 'usermanager',
                'icon' => 'group',
                'priority' => 9,
                'active' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'TextMate',
                'slug' => 'textmate',
                'icon' => 'mobile',
                'priority' => NULL,
                'active' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'eForms',
                'slug' => 'eforms',
                'icon' => 'desktop',
                'priority' => NULL,
                'active' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Leave',
                'slug' => 'leave',
                'icon' => 'calendar',
                'priority' => NULL,
                'active' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Jel',
                'slug' => 'jel',
                'icon' => 'bug',
                'priority' => NULL,
                'active' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Judi',
                'slug' => 'judi',
                'icon' => 'gavel',
                'priority' => NULL,
                'active' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'title' => 'Auditor',
                'slug' => 'auditor',
                'icon' => 'check-square-o',
                'priority' => NULL,
                'active' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'title' => 'Bolt',
                'slug' => 'bolt',
                'icon' => 'bolt',
                'priority' => NULL,
                'active' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'title' => 'SurveyHound',
                'slug' => 'surveyhound',
                'icon' => 'commenting-o',
                'priority' => NULL,
                'active' => 1,
            ),
        ));
        
        
    }
}
