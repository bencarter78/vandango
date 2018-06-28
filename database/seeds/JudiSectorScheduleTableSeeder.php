<?php

use Illuminate\Database\Seeder;

class JudiSectorScheduleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_sector_schedule')->delete();
        
        \DB::table('judi_sector_schedule')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sector_id' => 8,
                'month' => 11,
                'created_at' => '2014-12-01 09:17:19',
                'updated_at' => '2016-04-04 15:50:10',
            ),
            1 => 
            array (
                'id' => 3,
                'sector_id' => 4,
                'month' => 4,
                'created_at' => '2014-12-03 09:44:18',
                'updated_at' => '2015-04-13 14:23:36',
            ),
            2 => 
            array (
                'id' => 4,
                'sector_id' => 5,
                'month' => 2,
                'created_at' => '2014-12-16 17:02:15',
                'updated_at' => '2014-12-16 17:02:15',
            ),
            3 => 
            array (
                'id' => 5,
                'sector_id' => 11,
                'month' => 10,
                'created_at' => '2014-12-23 10:03:13',
                'updated_at' => '2015-11-19 10:17:16',
            ),
            4 => 
            array (
                'id' => 6,
                'sector_id' => 2,
                'month' => 10,
                'created_at' => '2015-03-31 12:36:49',
                'updated_at' => '2015-11-19 10:08:38',
            ),
            5 => 
            array (
                'id' => 7,
                'sector_id' => 7,
                'month' => 1,
                'created_at' => '2015-03-31 12:38:20',
                'updated_at' => '2015-11-19 10:10:44',
            ),
            6 => 
            array (
                'id' => 8,
                'sector_id' => 71,
                'month' => 6,
                'created_at' => '2015-03-31 12:38:32',
                'updated_at' => '2015-11-19 10:11:47',
            ),
            7 => 
            array (
                'id' => 9,
                'sector_id' => 9,
                'month' => 1,
                'created_at' => '2015-03-31 12:38:46',
                'updated_at' => '2015-11-19 10:09:46',
            ),
            8 => 
            array (
                'id' => 10,
                'sector_id' => 6,
                'month' => 10,
                'created_at' => '2015-03-31 12:38:58',
                'updated_at' => '2015-11-19 10:08:54',
            ),
            9 => 
            array (
                'id' => 11,
                'sector_id' => 14,
                'month' => 9,
                'created_at' => '2015-03-31 12:39:19',
                'updated_at' => '2015-11-19 10:16:51',
            ),
            10 => 
            array (
                'id' => 12,
                'sector_id' => 10,
                'month' => 4,
                'created_at' => '2015-03-31 12:39:34',
                'updated_at' => '2015-04-13 14:23:23',
            ),
            11 => 
            array (
                'id' => 13,
                'sector_id' => 86,
                'month' => 11,
                'created_at' => '2015-03-31 12:39:53',
                'updated_at' => '2015-03-31 12:39:53',
            ),
            12 => 
            array (
                'id' => 14,
                'sector_id' => 84,
                'month' => 11,
                'created_at' => '2015-03-31 12:40:07',
                'updated_at' => '2015-03-31 12:40:07',
            ),
            13 => 
            array (
                'id' => 15,
                'sector_id' => 83,
                'month' => 12,
                'created_at' => '2015-03-31 12:40:19',
                'updated_at' => '2015-11-19 10:03:29',
            ),
            14 => 
            array (
                'id' => 16,
                'sector_id' => 88,
                'month' => 11,
                'created_at' => '2015-03-31 12:40:32',
                'updated_at' => '2015-03-31 12:40:32',
            ),
            15 => 
            array (
                'id' => 17,
                'sector_id' => 87,
                'month' => 11,
                'created_at' => '2015-03-31 12:40:43',
                'updated_at' => '2015-03-31 12:40:43',
            ),
            16 => 
            array (
                'id' => 18,
                'sector_id' => 118,
                'month' => 3,
                'created_at' => '2015-03-31 12:40:59',
                'updated_at' => '2016-01-04 15:20:45',
            ),
            17 => 
            array (
                'id' => 19,
                'sector_id' => 119,
                'month' => 7,
                'created_at' => '2015-03-31 12:41:14',
                'updated_at' => '2015-03-31 12:41:14',
            ),
            18 => 
            array (
                'id' => 20,
                'sector_id' => 13,
                'month' => 5,
                'created_at' => '2015-03-31 12:41:27',
                'updated_at' => '2015-04-13 14:21:50',
            ),
            19 => 
            array (
                'id' => 21,
                'sector_id' => 1,
                'month' => 3,
                'created_at' => '2015-03-31 12:42:21',
                'updated_at' => '2016-01-11 14:06:58',
            ),
            20 => 
            array (
                'id' => 22,
                'sector_id' => 15,
                'month' => 11,
                'created_at' => '2015-03-31 12:42:31',
                'updated_at' => '2015-11-19 10:06:31',
            ),
            21 => 
            array (
                'id' => 23,
                'sector_id' => 16,
                'month' => 11,
                'created_at' => '2015-03-31 12:42:41',
                'updated_at' => '2015-11-19 10:19:23',
            ),
            22 => 
            array (
                'id' => 24,
                'sector_id' => 85,
                'month' => 12,
                'created_at' => '2015-03-31 12:42:55',
                'updated_at' => '2015-03-31 12:42:55',
            ),
            23 => 
            array (
                'id' => 25,
                'sector_id' => 3,
                'month' => 1,
                'created_at' => '2015-03-31 12:43:08',
                'updated_at' => '2015-11-19 10:20:02',
            ),
            24 => 
            array (
                'id' => 26,
                'sector_id' => 12,
                'month' => 12,
                'created_at' => '2015-03-31 12:43:36',
                'updated_at' => '2015-11-19 10:11:32',
            ),
            25 => 
            array (
                'id' => 27,
                'sector_id' => 125,
                'month' => 0,
                'created_at' => '2015-03-31 12:45:04',
                'updated_at' => '2016-01-18 10:40:12',
            ),
            26 => 
            array (
                'id' => 28,
                'sector_id' => 141,
                'month' => 0,
                'created_at' => '2015-03-31 12:45:19',
                'updated_at' => '2016-01-18 10:40:25',
            ),
            27 => 
            array (
                'id' => 29,
                'sector_id' => 138,
                'month' => 0,
                'created_at' => '2015-03-31 12:45:45',
                'updated_at' => '2016-01-18 10:40:31',
            ),
            28 => 
            array (
                'id' => 30,
                'sector_id' => 133,
                'month' => 0,
                'created_at' => '2015-03-31 12:46:13',
                'updated_at' => '2016-01-18 10:40:59',
            ),
            29 => 
            array (
                'id' => 31,
                'sector_id' => 139,
                'month' => 0,
                'created_at' => '2015-03-31 12:46:40',
                'updated_at' => '2016-01-18 10:41:06',
            ),
            30 => 
            array (
                'id' => 32,
                'sector_id' => 105,
                'month' => 1,
                'created_at' => '2015-03-31 12:46:53',
                'updated_at' => '2015-11-19 10:09:36',
            ),
            31 => 
            array (
                'id' => 33,
                'sector_id' => 148,
                'month' => 6,
                'created_at' => '2015-03-31 12:48:16',
                'updated_at' => '2015-03-31 12:48:16',
            ),
            32 => 
            array (
                'id' => 34,
                'sector_id' => 121,
                'month' => 0,
                'created_at' => '2015-03-31 12:48:53',
                'updated_at' => '2016-01-18 10:41:25',
            ),
            33 => 
            array (
                'id' => 35,
                'sector_id' => 104,
                'month' => 10,
                'created_at' => '2015-03-31 12:49:42',
                'updated_at' => '2015-11-19 10:18:41',
            ),
            34 => 
            array (
                'id' => 36,
                'sector_id' => 129,
                'month' => 0,
                'created_at' => '2015-03-31 12:50:10',
                'updated_at' => '2016-01-18 10:41:40',
            ),
            35 => 
            array (
                'id' => 37,
                'sector_id' => 140,
                'month' => 2,
                'created_at' => '2015-03-31 12:50:34',
                'updated_at' => '2016-03-29 13:48:59',
            ),
            36 => 
            array (
                'id' => 38,
                'sector_id' => 136,
                'month' => 0,
                'created_at' => '2015-03-31 12:51:02',
                'updated_at' => '2016-01-18 10:41:50',
            ),
            37 => 
            array (
                'id' => 39,
                'sector_id' => 106,
                'month' => 0,
                'created_at' => '2015-03-31 12:51:24',
                'updated_at' => '2016-01-18 10:42:02',
            ),
            38 => 
            array (
                'id' => 40,
                'sector_id' => 147,
                'month' => 6,
                'created_at' => '2015-03-31 12:51:56',
                'updated_at' => '2015-03-31 12:51:56',
            ),
            39 => 
            array (
                'id' => 41,
                'sector_id' => 134,
                'month' => 0,
                'created_at' => '2015-03-31 12:52:17',
                'updated_at' => '2016-01-18 10:42:23',
            ),
            40 => 
            array (
                'id' => 42,
                'sector_id' => 130,
                'month' => 0,
                'created_at' => '2015-03-31 12:52:39',
                'updated_at' => '2016-01-18 10:42:30',
            ),
            41 => 
            array (
                'id' => 43,
                'sector_id' => 17,
                'month' => 9,
                'created_at' => '2015-03-31 12:53:07',
                'updated_at' => '2015-11-19 10:21:39',
            ),
            42 => 
            array (
                'id' => 44,
                'sector_id' => 149,
                'month' => 9,
                'created_at' => '2015-11-19 10:02:29',
                'updated_at' => '2015-11-19 10:02:29',
            ),
            43 => 
            array (
                'id' => 45,
                'sector_id' => 150,
                'month' => 12,
                'created_at' => '2015-11-19 10:03:16',
                'updated_at' => '2015-11-19 10:03:16',
            ),
            44 => 
            array (
                'id' => 46,
                'sector_id' => 90,
                'month' => 12,
                'created_at' => '2015-11-19 10:03:48',
                'updated_at' => '2015-11-19 10:03:48',
            ),
            45 => 
            array (
                'id' => 47,
                'sector_id' => 145,
                'month' => 11,
                'created_at' => '2015-11-19 10:04:06',
                'updated_at' => '2015-11-19 10:04:06',
            ),
            46 => 
            array (
                'id' => 48,
                'sector_id' => 144,
                'month' => 0,
                'created_at' => '2015-11-19 10:05:34',
                'updated_at' => '2016-01-18 10:40:37',
            ),
            47 => 
            array (
                'id' => 49,
                'sector_id' => 142,
                'month' => 4,
                'created_at' => '2015-11-19 10:20:59',
                'updated_at' => '2016-02-24 14:32:26',
            ),
            48 => 
            array (
                'id' => 50,
                'sector_id' => 153,
                'month' => 0,
                'created_at' => '2015-11-19 10:45:42',
                'updated_at' => '2016-01-18 10:40:44',
            ),
            49 => 
            array (
                'id' => 51,
                'sector_id' => 152,
                'month' => 0,
                'created_at' => '2015-11-19 10:45:59',
                'updated_at' => '2016-01-18 10:40:19',
            ),
            50 => 
            array (
                'id' => 52,
                'sector_id' => 151,
                'month' => 0,
                'created_at' => '2015-11-19 10:46:11',
                'updated_at' => '2016-01-18 10:42:10',
            ),
        ));
        
        
    }
}
