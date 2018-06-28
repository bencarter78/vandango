<?php

use Illuminate\Database\Seeder;

class DataSectorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_sectors')->delete();
        
        \DB::table('data_sectors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'OM201',
                'name' => 'Management',
                'department_id' => 71,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2016-01-18 16:25:51',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'OM202',
                'name' => 'Business & Administration',
                'department_id' => 90,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:27:28',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'OM203',
                'name' => 'Retail',
                'department_id' => 71,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2015-01-14 11:34:23',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'OM204',
                'name' => 'Hospitality',
                'department_id' => 78,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:53:36',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'OM205',
                'name' => 'Hair & Beauty',
                'department_id' => 76,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:53:02',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'OM206',
                'name' => 'Dental Nursing',
                'department_id' => 72,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:59:57',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'OM207',
                'name' => 'Childcare',
                'department_id' => 69,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:58:35',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'OM208',
                'name' => 'Accounts',
                'department_id' => 90,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:40:23',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'OM209',
                'name' => 'Customer Service',
                'department_id' => 71,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:59:38',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'OM210',
                'name' => 'Equestrian',
                'department_id' => 75,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:52:40',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'OM301',
                'name' => 'Engineering',
                'department_id' => 74,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2015-08-17 10:33:04',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'OM303',
                'name' => 'Warehousing',
                'department_id' => 83,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:38:40',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'code' => 'OM304',
                'name' => 'Healthcare',
                'department_id' => 77,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:46:52',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'code' => 'OM306',
                'name' => 'Electrical',
                'department_id' => 73,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2015-08-17 10:32:54',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'code' => 'OM307',
                'name' => 'Motor Vehicle',
                'department_id' => 80,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:50:03',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'code' => 'OM308',
                'name' => 'Motor Vehicle Parts',
                'department_id' => 83,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:38:51',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'code' => 'OM150',
                'name' => 'Training & Development',
                'department_id' => 88,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:37:40',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 70,
                'code' => 'INT01',
                'name' => 'Internal',
                'department_id' => 88,
                'created_at' => '2013-08-12 15:55:52',
                'updated_at' => '2014-11-27 00:47:13',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 71,
                'code' => 'OM300',
                'name' => 'Construction',
                'department_id' => 70,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:00:13',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 83,
                'code' => 'LG101',
                'name' => 'FL Macclesfield',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:28:39',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 84,
                'code' => 'LG102',
                'name' => 'FL Crewe',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:28:33',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 85,
                'code' => 'LG103',
                'name' => 'Prospects Plus',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:50:22',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 86,
                'code' => 'LG104',
                'name' => 'FL Burslem',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:28:14',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 87,
                'code' => 'LG105',
                'name' => 'FL Telford',
                'department_id' => 104,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2015-04-02 09:33:38',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 88,
                'code' => 'LG108',
                'name' => 'FL Market Drayton',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:28:47',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 89,
                'code' => 'LG109',
                'name' => 'FL Burton',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:28:26',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 90,
                'code' => 'LG110',
                'name' => 'FL Middlewich',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:28:53',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 91,
                'code' => 'LG111',
                'name' => 'FL Warrington',
                'department_id' => 85,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:29:09',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 93,
                'code' => 'OM151',
                'name' => 'IAG',
                'department_id' => 88,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:54:00',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 104,
                'code' => 'OM212',
                'name' => 'ITQ',
                'department_id' => 90,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:47:18',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 105,
                'code' => 'OM213',
                'name' => 'Contact Centre',
                'department_id' => 71,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:58:56',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 106,
                'code' => 'OM215',
                'name' => 'North of England Training',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:37',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 107,
                'code' => 'OM216',
                'name' => 'Ford Retail',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:54:24',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 108,
                'code' => 'OM217',
                'name' => 'Payroll',
                'department_id' => 90,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:50:10',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 109,
                'code' => 'OM218',
                'name' => 'Sales & Telesales',
                'department_id' => 71,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:48:58',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 110,
                'code' => 'OM219',
                'name' => 'BIT',
                'department_id' => 90,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 17:00:28',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 118,
                'code' => 'OM400',
                'name' => 'Functional Skills',
                'department_id' => 84,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:52:48',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 119,
                'code' => 'OM502',
                'name' => 'Health & Safety',
                'department_id' => 89,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:53:10',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 120,
                'code' => 'OM508',
                'name' => 'Skillsfinder',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:42',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 121,
                'code' => 'OM510',
            'name' => 'Floortrain (GB) Limited',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:26:55',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 122,
                'code' => 'OM511',
                'name' => 'CR Training Solutions and Consultancy Ltd',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:25:23',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 123,
                'code' => 'OM512',
                'name' => 'The Apprentice Link',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:28:02',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 124,
                'code' => 'OM513',
                'name' => 'Economic Solutions Limited',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:25:30',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 125,
                'code' => 'OM514',
                'name' => 'Acamar Training Ltd',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:23:24',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 126,
                'code' => 'OM515',
                'name' => 'Globe',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 22:52:56',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 127,
                'code' => 'OM516',
                'name' => 'International School of Beauty',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:00',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 128,
                'code' => 'OM517',
                'name' => 'Warrington Borough Council',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:28:21',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 129,
                'code' => 'OM518',
                'name' => 'Kids Allowed',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:08',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 130,
                'code' => 'OM519',
                'name' => 'The Apprentice Academy Ltd',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:54',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 131,
                'code' => 'OM520',
                'name' => 'Education & Youth Services Limited',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:26:49',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 132,
                'code' => 'OM521',
                'name' => 'Mantra Learning Ltd',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:19',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 133,
                'code' => 'OM522',
                'name' => 'Care Assessment Training Services',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:24:54',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 134,
                'code' => 'OM523',
                'name' => 'Tangerine PR',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:49',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 135,
                'code' => 'OM524',
                'name' => 'Warrington Collegiate',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:28:28',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 136,
                'code' => 'OM525',
                'name' => 'MyFuturesBright',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:25',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 137,
                'code' => 'OM526',
                'name' => 'Total Training at Nefarious Hair',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:28:14',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 138,
                'code' => 'OM527',
                'name' => 'Barley Associates',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:23:48',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 139,
                'code' => 'OM528',
                'name' => 'Chief Assessments Limited',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:25:02',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 140,
                'code' => 'OM529',
                'name' => 'MyQual Ltd',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:27:31',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 141,
                'code' => 'OM530',
                'name' => 'ANS Group',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:24:19',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 142,
                'code' => 'OM531',
                'name' => 'The Nail Training Company',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:28:08',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 143,
                'code' => 'OM532',
                'name' => 'Build Skill Plus',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:24:48',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 144,
                'code' => 'OM533',
                'name' => 'Barlow Electrical Supplies Ltd',
                'department_id' => 100,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '2014-11-26 16:23:57',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 145,
                'code' => 'LG112',
                'name' => 'FL Winsford',
                'department_id' => 85,
                'created_at' => '2014-07-22 16:55:26',
                'updated_at' => '2015-04-02 09:54:41',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 146,
                'code' => 'TS011',
                'name' => 'Test Sector',
                'department_id' => 91,
                'created_at' => '2014-12-01 08:55:30',
                'updated_at' => '2014-12-01 08:55:42',
                'deleted_at' => '2014-12-01 08:55:42',
            ),
            65 => 
            array (
                'id' => 147,
                'code' => 'OM221',
                'name' => 'Social Media & Digital',
                'department_id' => 102,
                'created_at' => '2015-01-14 11:52:50',
                'updated_at' => '2016-01-06 10:01:41',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 148,
                'code' => 'OM222',
                'name' => 'CIPD & Recruitment',
                'department_id' => 88,
                'created_at' => '2015-01-14 11:53:04',
                'updated_at' => '2016-01-06 10:02:37',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 149,
                'code' => 'OM320',
                'name' => 'Engineering Workshop',
                'department_id' => 103,
                'created_at' => '2015-03-31 14:46:48',
                'updated_at' => '2015-03-31 14:46:48',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 150,
                'code' => 'LG113',
                'name' => 'FL Chester',
                'department_id' => 85,
                'created_at' => '2015-04-02 09:54:59',
                'updated_at' => '2015-04-02 09:54:59',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 151,
                'code' => 'REBUS',
                'name' => 'Rebus',
                'department_id' => 100,
                'created_at' => '2015-11-19 10:44:08',
                'updated_at' => '2015-11-19 10:44:08',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 152,
                'code' => 'OM536',
                'name' => 'Access To Employment',
                'department_id' => 100,
                'created_at' => '2015-11-19 10:44:41',
                'updated_at' => '2015-11-19 10:46:29',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 153,
                'code' => 'OM542',
                'name' => 'Blue Arrow',
                'department_id' => 100,
                'created_at' => '2015-11-19 10:45:10',
                'updated_at' => '2015-11-19 10:45:10',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 154,
                'code' => 'OM226',
                'name' => 'Wigan Centre',
                'department_id' => 105,
                'created_at' => '2016-01-21 15:51:20',
                'updated_at' => '2016-01-21 15:51:20',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 155,
                'code' => 'SGUAR',
                'name' => 'Safeguarding',
                'department_id' => 106,
                'created_at' => '2016-01-29 14:59:33',
                'updated_at' => '2016-01-29 14:59:33',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 157,
                'code' => 'om544',
                'name' => 'C P Assessments',
                'department_id' => 100,
                'created_at' => '2016-03-29 13:56:56',
                'updated_at' => '2016-03-29 13:56:56',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
