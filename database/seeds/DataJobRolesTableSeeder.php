<?php

use Illuminate\Database\Seeder;

class DataJobRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_job_roles')->delete();
        
        \DB::table('data_job_roles')->insert(array (
            0 => 
            array (
                'id' => 13,
                'job_role' => 'Training Adviser',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 14,
                'job_role' => 'Assessor',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 16,
                'job_role' => 'Administrator',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 26,
                'job_role' => 'Performance Assessor',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 30,
                'job_role' => 'Trainer/Tutor',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-12-02 11:34:17',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 32,
                'job_role' => 'Adviser',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-27 15:00:23',
                'deleted_at' => '2014-11-27 15:00:23',
            ),
            6 => 
            array (
                'id' => 36,
                'job_role' => 'Curriculum Programme Co-Ordinator',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2015-04-02 10:03:21',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 37,
                'job_role' => 'Instructor',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 40,
                'job_role' => 'Tutor',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-12-02 11:34:05',
                'deleted_at' => '2014-12-02 11:34:05',
            ),
            9 => 
            array (
                'id' => 65,
                'job_role' => 'Department Manager',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 66,
                'job_role' => 'First Aider',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 67,
                'job_role' => 'VPC',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 68,
                'job_role' => 'IQA',
                'created_at' => '2014-11-26 22:04:08',
                'updated_at' => '2014-11-26 22:04:08',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 69,
                'job_role' => 'Lead IQA',
                'created_at' => '2014-11-26 22:12:49',
                'updated_at' => '2014-11-26 22:12:49',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 70,
                'job_role' => 'Test',
                'created_at' => '2014-11-26 22:16:42',
                'updated_at' => '2014-11-27 00:36:27',
                'deleted_at' => '2014-11-27 00:36:27',
            ),
            15 => 
            array (
                'id' => 71,
                'job_role' => 'Recruitment',
                'created_at' => '2015-04-02 09:55:41',
                'updated_at' => '2015-04-02 09:55:41',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 72,
                'job_role' => 'Safeguarding',
                'created_at' => '2015-04-02 10:01:02',
                'updated_at' => '2015-04-02 10:01:02',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 73,
                'job_role' => 'Placement Officer',
                'created_at' => '2016-01-12 16:09:00',
                'updated_at' => '2016-01-12 16:09:00',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 74,
                'job_role' => 'Contract Owner',
                'created_at' => '2016-04-27 10:36:49',
                'updated_at' => '2016-04-27 10:36:49',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
