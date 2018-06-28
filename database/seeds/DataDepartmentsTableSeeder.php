<?php

use Illuminate\Database\Seeder;

class DataDepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_departments')->delete();
        
        \DB::table('data_departments')->insert(array (
            0 => 
            array (
                'id' => 57,
                'department' => 'Managing Director',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 09:53:07',
                'updated_at' => '2014-11-26 09:53:07',
                'deleted_at' => '2014-11-26 09:53:07',
            ),
            1 => 
            array (
                'id' => 58,
                'department' => 'SMT',
                'manager_id' => 99,
                'ad_id' => 99,
                'created_at' => '2014-11-26 17:39:20',
                'updated_at' => '2014-11-26 17:39:20',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 59,
                'department' => 'Accounts',
                'manager_id' => 40,
                'ad_id' => 40,
                'created_at' => '2014-11-26 16:39:56',
                'updated_at' => '2014-11-26 16:39:56',
                'deleted_at' => '2014-11-26 16:39:56',
            ),
            3 => 
            array (
                'id' => 60,
                'department' => 'Corporate Services',
                'manager_id' => 37,
                'ad_id' => 31,
                'created_at' => '2015-03-04 10:10:52',
                'updated_at' => '2015-03-04 10:10:52',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 61,
                'department' => 'Marketing',
                'manager_id' => 90,
                'ad_id' => 90,
                'created_at' => '2014-11-26 17:45:08',
                'updated_at' => '2014-11-26 17:45:08',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 62,
                'department' => 'IT',
                'manager_id' => 102,
                'ad_id' => 31,
                'created_at' => '2014-11-26 17:42:46',
                'updated_at' => '2014-11-26 17:42:46',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 63,
                'department' => 'Quality',
                'manager_id' => 90,
                'ad_id' => 90,
                'created_at' => '2014-11-26 17:44:35',
                'updated_at' => '2014-11-26 17:44:35',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 64,
                'department' => 'Human Resources',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 17:26:20',
                'updated_at' => '2014-11-26 17:26:20',
                'deleted_at' => '2014-11-26 17:26:20',
            ),
            8 => 
            array (
                'id' => 65,
                'department' => 'Programme Administration',
                'manager_id' => 31,
                'ad_id' => 31,
                'created_at' => '2014-11-26 17:45:24',
                'updated_at' => '2014-11-26 17:45:24',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 66,
                'department' => 'Finance',
                'manager_id' => 31,
                'ad_id' => 31,
                'created_at' => '2014-11-26 17:25:53',
                'updated_at' => '2014-11-26 17:25:53',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 67,
                'department' => 'Middlewich',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2015-01-14 11:54:56',
                'updated_at' => '2015-01-14 11:54:56',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 68,
                'department' => 'Business and Administration & IT',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 17:02:51',
                'updated_at' => '2014-11-26 17:02:51',
                'deleted_at' => '2014-11-26 17:02:51',
            ),
            12 => 
            array (
                'id' => 69,
                'department' => 'Childcare',
                'manager_id' => 44,
                'ad_id' => 40,
                'created_at' => '2014-11-21 12:59:01',
                'updated_at' => '2015-10-26 12:53:45',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 70,
                'department' => 'Construction',
                'manager_id' => 63,
                'ad_id' => 40,
                'created_at' => '2014-11-26 20:31:04',
                'updated_at' => '2014-11-26 20:31:04',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 71,
                'department' => 'Management & Professional Services',
                'manager_id' => 101,
                'ad_id' => 40,
                'created_at' => '2014-11-26 17:41:13',
                'updated_at' => '2014-11-26 17:41:13',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 72,
                'department' => 'Dental',
                'manager_id' => 391,
                'ad_id' => 40,
                'created_at' => '2015-02-24 09:18:24',
                'updated_at' => '2015-02-24 09:18:24',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 73,
                'department' => 'Electrical',
                'manager_id' => 53,
                'ad_id' => 40,
                'created_at' => '2015-03-04 09:49:17',
                'updated_at' => '2015-03-04 09:49:17',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 74,
                'department' => 'Engineering',
                'manager_id' => 459,
                'ad_id' => 40,
                'created_at' => '2015-03-04 10:13:00',
                'updated_at' => '2015-03-04 10:13:00',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 75,
                'department' => 'Equestrian',
                'manager_id' => 111,
                'ad_id' => 40,
                'created_at' => '2015-03-04 10:11:02',
                'updated_at' => '2015-03-04 10:11:02',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 76,
                'department' => 'Hairdressing',
                'manager_id' => 430,
                'ad_id' => 40,
                'created_at' => '2014-12-17 10:44:14',
                'updated_at' => '2014-12-17 10:44:14',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 77,
                'department' => 'Health and Social Care',
                'manager_id' => 47,
                'ad_id' => 40,
                'created_at' => '2014-07-08 09:35:47',
                'updated_at' => '2014-07-08 08:35:47',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 78,
                'department' => 'Hospitality',
                'manager_id' => 45,
                'ad_id' => 40,
                'created_at' => '2015-03-04 10:11:10',
                'updated_at' => '2015-03-04 10:11:10',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 79,
                'department' => 'Management',
                'manager_id' => 40,
                'ad_id' => 40,
                'created_at' => '2014-11-26 17:40:35',
                'updated_at' => '2014-11-26 17:40:35',
                'deleted_at' => '2014-11-26 17:40:35',
            ),
            23 => 
            array (
                'id' => 80,
                'department' => 'Motor Vehicle',
                'manager_id' => 467,
                'ad_id' => 40,
                'created_at' => '2015-02-27 09:24:54',
                'updated_at' => '2015-02-27 09:24:54',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 81,
                'department' => 'Vehicle Parts',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 17:39:01',
                'updated_at' => '2014-11-26 17:39:01',
                'deleted_at' => '2014-11-26 17:39:01',
            ),
            25 => 
            array (
                'id' => 82,
                'department' => 'Retail',
                'manager_id' => 40,
                'ad_id' => 40,
                'created_at' => '2015-01-14 12:07:09',
                'updated_at' => '2015-01-14 12:07:09',
                'deleted_at' => '2015-01-14 12:07:09',
            ),
            26 => 
            array (
                'id' => 83,
                'department' => 'Warehousing',
                'manager_id' => 46,
                'ad_id' => 40,
                'created_at' => '2015-03-04 10:12:29',
                'updated_at' => '2015-03-04 10:12:29',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 84,
                'department' => 'Functional Skills',
                'manager_id' => 105,
                'ad_id' => 40,
                'created_at' => '2015-03-04 10:13:07',
                'updated_at' => '2015-03-04 10:13:07',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 85,
            'department' => 'Study Programme (North)',
                'manager_id' => 98,
                'ad_id' => 40,
                'created_at' => '2015-04-02 10:33:02',
                'updated_at' => '2015-04-02 09:33:02',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 86,
                'department' => 'Macclesfield',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 17:37:06',
                'updated_at' => '2014-11-26 17:37:06',
                'deleted_at' => '2014-11-26 17:37:06',
            ),
            30 => 
            array (
                'id' => 87,
                'department' => 'Market Drayton',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 17:37:12',
                'updated_at' => '2014-11-26 17:37:12',
                'deleted_at' => '2014-11-26 17:37:12',
            ),
            31 => 
            array (
                'id' => 88,
                'department' => 'Learning & Development',
                'manager_id' => 106,
                'ad_id' => 90,
                'created_at' => '2014-12-18 15:16:15',
                'updated_at' => '2014-12-18 15:16:15',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 89,
                'department' => 'Health and Safety',
                'manager_id' => 100,
                'ad_id' => 99,
                'created_at' => '2014-11-26 17:33:57',
                'updated_at' => '2014-11-26 17:33:57',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 90,
                'department' => 'Business Services',
                'manager_id' => 97,
                'ad_id' => 40,
                'created_at' => '2014-11-26 17:20:54',
                'updated_at' => '2014-11-26 17:20:54',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 91,
                'department' => 'Business Development',
                'manager_id' => 90,
                'ad_id' => 90,
                'created_at' => '2014-11-26 16:01:18',
                'updated_at' => '2014-11-26 16:01:18',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 92,
                'department' => 'Telford',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 17:37:58',
                'updated_at' => '2014-11-26 17:37:58',
                'deleted_at' => '2014-11-26 17:37:58',
            ),
            36 => 
            array (
                'id' => 93,
                'department' => 'South Cheshire College',
                'manager_id' => NULL,
                'ad_id' => NULL,
                'created_at' => '2014-11-26 17:37:34',
                'updated_at' => '2014-11-26 17:37:34',
                'deleted_at' => '2014-11-26 17:37:34',
            ),
            37 => 
            array (
                'id' => 94,
                'department' => 'ILT',
                'manager_id' => 103,
                'ad_id' => 90,
                'created_at' => '2014-11-26 22:57:20',
                'updated_at' => '2014-11-26 22:57:20',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 95,
                'department' => 'Audit',
                'manager_id' => 31,
                'ad_id' => 31,
                'created_at' => '2014-11-26 17:04:04',
                'updated_at' => '2014-11-26 17:04:04',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 96,
                'department' => 'Human Resources',
                'manager_id' => 388,
                'ad_id' => 90,
                'created_at' => '2015-03-04 10:11:51',
                'updated_at' => '2015-03-04 10:11:51',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 97,
                'department' => 'Recruitment & Engagement',
                'manager_id' => 1,
                'ad_id' => 90,
                'created_at' => '2014-11-26 10:14:22',
                'updated_at' => '2014-11-26 10:14:22',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 98,
                'department' => 'Accounts',
                'manager_id' => 1,
                'ad_id' => 31,
                'created_at' => '2014-11-26 16:10:11',
                'updated_at' => '2014-11-26 16:10:11',
                'deleted_at' => '2014-11-26 16:10:11',
            ),
            42 => 
            array (
                'id' => 99,
                'department' => 'Accounts23',
                'manager_id' => 1,
                'ad_id' => 31,
                'created_at' => '2014-11-27 10:27:15',
                'updated_at' => '2014-11-27 10:27:15',
                'deleted_at' => '2014-11-27 10:27:15',
            ),
            43 => 
            array (
                'id' => 100,
                'department' => 'Sub-contractor',
                'manager_id' => 410,
                'ad_id' => 90,
                'created_at' => '2014-11-26 16:20:38',
                'updated_at' => '2016-04-27 10:36:30',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 101,
                'department' => 'Performance Assessment',
                'manager_id' => 106,
                'ad_id' => 90,
                'created_at' => '2014-11-27 14:56:32',
                'updated_at' => '2014-11-27 14:56:32',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 102,
                'department' => 'Digital',
                'manager_id' => 580,
                'ad_id' => 90,
                'created_at' => '2015-01-14 10:51:03',
                'updated_at' => '2015-12-15 11:21:22',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 103,
                'department' => 'Engineering Training Centre',
                'manager_id' => 506,
                'ad_id' => 506,
                'created_at' => '2015-03-31 15:39:31',
                'updated_at' => '2015-03-31 14:39:31',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 104,
            'department' => 'Study Programme (Midlands)',
                'manager_id' => 63,
                'ad_id' => 40,
                'created_at' => '2015-04-02 09:32:42',
                'updated_at' => '2015-04-02 09:32:42',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 105,
                'department' => 'Wigan',
                'manager_id' => 565,
                'ad_id' => 40,
                'created_at' => '2016-01-13 09:45:36',
                'updated_at' => '2016-01-13 09:46:04',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 106,
                'department' => 'Safeguarding',
                'manager_id' => 103,
                'ad_id' => 90,
                'created_at' => '2016-01-29 14:59:19',
                'updated_at' => '2016-01-29 14:59:19',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 107,
                'department' => 'Estio',
                'manager_id' => 376,
                'ad_id' => 90,
                'created_at' => '2016-02-09 11:27:59',
                'updated_at' => '2016-02-09 11:27:59',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
