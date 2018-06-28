<?php

use Illuminate\Database\Seeder;

class DataCoursesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_courses')->delete();
        
        \DB::table('data_courses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'sector_id' => 8,
                'title' => 'Accountancy',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            1 => 
            array (
                'id' => 2,
                'sector_id' => 10,
                'title' => 'Animal Care',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            2 => 
            array (
                'id' => 3,
                'sector_id' => 5,
                'title' => 'Barbering',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            3 => 
            array (
                'id' => 4,
                'sector_id' => 5,
                'title' => 'Beauty Therapy',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            4 => 
            array (
                'id' => 5,
                'sector_id' => 71,
                'title' => 'Bricklaying',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            5 => 
            array (
                'id' => 6,
                'sector_id' => 2,
                'title' => 'Business & Administration',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            6 => 
            array (
                'id' => 7,
                'sector_id' => 71,
                'title' => 'Carpentry and Joinery',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            7 => 
            array (
                'id' => 8,
                'sector_id' => 4,
                'title' => 'Chef - Professional Cookery',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            8 => 
            array (
                'id' => 9,
                'sector_id' => 7,
                'title' => 'Childcare',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            9 => 
            array (
                'id' => 10,
                'sector_id' => 9,
                'title' => 'Contact Centre',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            10 => 
            array (
                'id' => 11,
                'sector_id' => 9,
                'title' => 'Customer Service',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            11 => 
            array (
                'id' => 12,
                'sector_id' => 6,
                'title' => 'Dental Nursing',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            12 => 
            array (
                'id' => 13,
                'sector_id' => 14,
                'title' => 'Electrical',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            13 => 
            array (
                'id' => 14,
                'sector_id' => 11,
                'title' => 'Engineering',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            14 => 
            array (
                'id' => 15,
                'sector_id' => 10,
                'title' => 'Equestrian',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            15 => 
            array (
                'id' => 16,
                'sector_id' => 4,
                'title' => 'Food & Drink Service',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            16 => 
            array (
                'id' => 17,
                'sector_id' => 71,
                'title' => 'Furniture Manufacturing',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            17 => 
            array (
                'id' => 18,
                'sector_id' => 5,
                'title' => 'Hairdressing',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            18 => 
            array (
                'id' => 19,
                'sector_id' => 13,
                'title' => 'Health & Social Care',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            19 => 
            array (
                'id' => 20,
                'sector_id' => 4,
                'title' => 'Hospitality Supervision',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            20 => 
            array (
                'id' => 21,
                'sector_id' => 4,
                'title' => 'Housekeeping',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            21 => 
            array (
                'id' => 22,
                'sector_id' => 2,
                'title' => 'IT User',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            22 => 
            array (
                'id' => 23,
                'sector_id' => 2,
                'title' => 'IT Professional',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            23 => 
            array (
                'id' => 24,
                'sector_id' => 11,
                'title' => 'Lab Ops',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            24 => 
            array (
                'id' => 25,
                'sector_id' => 1,
                'title' => 'Management',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            25 => 
            array (
                'id' => 26,
                'sector_id' => 11,
                'title' => 'Manufacturing',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            26 => 
            array (
                'id' => 27,
                'sector_id' => 1,
                'title' => 'Marketing',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            27 => 
            array (
                'id' => 28,
                'sector_id' => 15,
                'title' => 'Motor Vehicle',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            28 => 
            array (
                'id' => 29,
                'sector_id' => 71,
                'title' => 'Painting and Decorating',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            29 => 
            array (
                'id' => 30,
                'sector_id' => 71,
                'title' => 'Plumbing',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            30 => 
            array (
                'id' => 31,
                'sector_id' => 4,
                'title' => 'Reception',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            31 => 
            array (
                'id' => 32,
                'sector_id' => 3,
                'title' => 'Retail',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            32 => 
            array (
                'id' => 33,
                'sector_id' => NULL,
                'title' => 'Sales & Telesales',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            33 => 
            array (
                'id' => 34,
                'sector_id' => NULL,
                'title' => 'Social Media',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            34 => 
            array (
                'id' => 35,
                'sector_id' => 17,
                'title' => 'Supporting Teaching and Learning',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            35 => 
            array (
                'id' => 36,
                'sector_id' => 16,
                'title' => 'Vehicle Parts Distribution',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            36 => 
            array (
                'id' => 37,
                'sector_id' => 12,
                'title' => 'Warehouse and Distribution',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
            37 => 
            array (
                'id' => 38,
                'sector_id' => 70,
                'title' => 'Business Development',
                'fwk_code' => NULL,
                'value' => NULL,
                'created_at' => '0000-00-00 00:00:00',
                'updated_at' => '0000-00-00 00:00:00',
            ),
        ));
        
        
    }
}
