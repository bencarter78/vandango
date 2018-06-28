<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('groups')->delete();
        
        \DB::table('groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Users',
                'slug' => 'users',
                'created_at' => '2013-08-21 11:49:29',
                'updated_at' => '2013-08-21 11:49:29',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Admins',
                'slug' => 'admin',
                'created_at' => '2013-08-21 11:49:29',
                'updated_at' => '2013-08-21 11:49:29',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'CRM',
                'slug' => 'crm',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Line Manager',
                'slug' => 'lineManager',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Ops Group',
                'slug' => 'ops',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'AD',
                'slug' => 'ad',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'MD',
                'slug' => 'md',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Operational',
                'slug' => 'operational',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Support',
                'slug' => 'support',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'SMT',
                'slug' => 'smt',
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'HR',
                'slug' => 'hr',
                'created_at' => '2013-08-21 11:49:29',
                'updated_at' => '2013-08-21 11:49:29',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'MatchMaker',
                'slug' => 'mm',
                'created_at' => '2014-07-25 09:28:35',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'MatchMaker Admin',
                'slug' => 'mmAdmin',
                'created_at' => '2014-09-02 10:55:16',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Judi',
                'slug' => 'judi',
                'created_at' => '2014-11-27 11:31:38',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Judi Admin',
                'slug' => 'judiAdmin',
                'created_at' => '2014-11-27 11:31:38',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Judi Sector Manager',
                'slug' => 'judiSM',
                'created_at' => '2015-01-13 12:33:09',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Auditor',
                'slug' => 'auditor',
                'created_at' => '2015-03-27 11:36:40',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Auditor Admin',
                'slug' => 'auditorAdmin',
                'created_at' => '2015-03-27 11:36:55',
                'updated_at' => '2015-10-26 12:53:45',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Judi PA',
                'slug' => 'judiPa',
                'created_at' => '2015-10-26 12:54:53',
                'updated_at' => '2015-10-26 12:54:53',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'SurveyHound Admin',
                'slug' => 'surveyHoundAdmin',
                'created_at' => '2015-11-23 16:59:17',
                'updated_at' => '2015-11-23 16:59:17',
            ),
        ));
        
        
    }
}
