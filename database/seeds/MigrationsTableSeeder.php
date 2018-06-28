<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'migration' => '2014_03_21_111059_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'migration' => '2015_03_21_111059_create_data_applications_table',
                'batch' => 1,
            ),
            3 => 
            array (
                'migration' => '2015_03_21_111059_create_data_centres_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'migration' => '2015_03_21_111059_create_data_courses_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'migration' => '2015_03_21_111059_create_data_departments_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'migration' => '2015_03_21_111059_create_data_job_roles_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'migration' => '2015_03_21_111059_create_data_sectors_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'migration' => '2015_03_21_111059_create_groups_table',
                'batch' => 1,
            ),
            9 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_assessments_table',
                'batch' => 1,
            ),
            10 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_cancellations_table',
                'batch' => 1,
            ),
            11 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_criteria_report_table',
                'batch' => 1,
            ),
            12 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_criteria_table',
                'batch' => 1,
            ),
            13 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_grades_table',
                'batch' => 1,
            ),
            14 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_process_report_table',
                'batch' => 1,
            ),
            15 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_process_user_table',
                'batch' => 1,
            ),
            16 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_processes_table',
                'batch' => 1,
            ),
            17 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_reports_table',
                'batch' => 1,
            ),
            18 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_role_process_table',
                'batch' => 1,
            ),
            19 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_sector_schedule_table',
                'batch' => 1,
            ),
            20 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_summaries_table',
                'batch' => 1,
            ),
            21 => 
            array (
                'migration' => '2015_03_21_111059_create_portal_dept_import_map_table',
                'batch' => 1,
            ),
            22 => 
            array (
                'migration' => '2015_03_21_111059_create_portal_user_imports_table',
                'batch' => 1,
            ),
            23 => 
            array (
                'migration' => '2015_03_21_111059_create_users_departments_table',
                'batch' => 1,
            ),
            24 => 
            array (
                'migration' => '2015_03_21_111059_create_users_groups_table',
                'batch' => 1,
            ),
            25 => 
            array (
                'migration' => '2015_03_21_111059_create_users_meta_table',
                'batch' => 1,
            ),
            26 => 
            array (
                'migration' => '2015_03_21_111059_create_users_roles_table',
                'batch' => 1,
            ),
            27 => 
            array (
                'migration' => '2015_03_21_111059_create_users_sectors_table',
                'batch' => 1,
            ),
            28 => 
            array (
                'migration' => '2015_08_26_100209_create_judi_documents_table',
                'batch' => 1,
            ),
            29 => 
            array (
                'migration' => '2015_08_28_144643_create_auditor_tasks_table',
                'batch' => 1,
            ),
            30 => 
            array (
                'migration' => '2015_09_02_094358_create_surveyhound_surveys_table',
                'batch' => 1,
            ),
            31 => 
            array (
                'migration' => '2016_03_15_155314_create_jobs_table',
                'batch' => 1,
            ),
            32 => 
            array (
                'migration' => '2016_04_11_132529_create_failed_jobs_table',
                'batch' => 1,
            ),
            33 => 
            array (
                'migration' => '2016_05_10_134856_create_auditor_categories_table',
                'batch' => 1,
            ),
            34 => 
            array (
                'migration' => '2014_03_21_111059_create_users_table',
                'batch' => 1,
            ),
            35 => 
            array (
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            36 => 
            array (
                'migration' => '2015_03_21_111059_create_data_applications_table',
                'batch' => 1,
            ),
            37 => 
            array (
                'migration' => '2015_03_21_111059_create_data_centres_table',
                'batch' => 1,
            ),
            38 => 
            array (
                'migration' => '2015_03_21_111059_create_data_courses_table',
                'batch' => 1,
            ),
            39 => 
            array (
                'migration' => '2015_03_21_111059_create_data_departments_table',
                'batch' => 1,
            ),
            40 => 
            array (
                'migration' => '2015_03_21_111059_create_data_job_roles_table',
                'batch' => 1,
            ),
            41 => 
            array (
                'migration' => '2015_03_21_111059_create_data_post_towns_table',
                'batch' => 1,
            ),
            42 => 
            array (
                'migration' => '2015_03_21_111059_create_data_sectors_table',
                'batch' => 1,
            ),
            43 => 
            array (
                'migration' => '2015_03_21_111059_create_groups_table',
                'batch' => 1,
            ),
            44 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_assessments_table',
                'batch' => 1,
            ),
            45 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_cancellations_table',
                'batch' => 1,
            ),
            46 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_criteria_report_table',
                'batch' => 1,
            ),
            47 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_criteria_table',
                'batch' => 1,
            ),
            48 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_grades_table',
                'batch' => 1,
            ),
            49 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_process_report_table',
                'batch' => 1,
            ),
            50 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_process_user_table',
                'batch' => 1,
            ),
            51 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_processes_table',
                'batch' => 1,
            ),
            52 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_reports_table',
                'batch' => 1,
            ),
            53 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_role_process_table',
                'batch' => 1,
            ),
            54 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_sector_schedule_table',
                'batch' => 1,
            ),
            55 => 
            array (
                'migration' => '2015_03_21_111059_create_judi_summaries_table',
                'batch' => 1,
            ),
            56 => 
            array (
                'migration' => '2015_03_21_111059_create_portal_dept_import_map_table',
                'batch' => 1,
            ),
            57 => 
            array (
                'migration' => '2015_03_21_111059_create_portal_user_imports_table',
                'batch' => 1,
            ),
            58 => 
            array (
                'migration' => '2015_03_21_111059_create_reports_table',
                'batch' => 1,
            ),
            59 => 
            array (
                'migration' => '2015_03_21_111059_create_users_departments_table',
                'batch' => 1,
            ),
            60 => 
            array (
                'migration' => '2015_03_21_111059_create_users_groups_table',
                'batch' => 1,
            ),
            61 => 
            array (
                'migration' => '2015_03_21_111059_create_users_meta_table',
                'batch' => 1,
            ),
            62 => 
            array (
                'migration' => '2015_03_21_111059_create_users_roles_table',
                'batch' => 1,
            ),
            63 => 
            array (
                'migration' => '2015_03_21_111059_create_users_sectors_table',
                'batch' => 1,
            ),
            64 => 
            array (
                'migration' => '2015_03_21_111100_add_foreign_keys_to_judi_criteria_report_table',
                'batch' => 1,
            ),
            65 => 
            array (
                'migration' => '2015_03_21_111100_add_foreign_keys_to_judi_process_report_table',
                'batch' => 1,
            ),
            66 => 
            array (
                'migration' => '2015_03_21_111100_add_foreign_keys_to_judi_process_user_table',
                'batch' => 1,
            ),
            67 => 
            array (
                'migration' => '2015_03_21_111100_add_foreign_keys_to_judi_sector_schedule_table',
                'batch' => 1,
            ),
            68 => 
            array (
                'migration' => '2015_08_26_100209_create_judi_documents_table',
                'batch' => 1,
            ),
            69 => 
            array (
                'migration' => '2015_08_28_144643_create_auditor_tasks_table',
                'batch' => 1,
            ),
            70 => 
            array (
                'migration' => '2015_09_02_094358_create_surveyhound_surveys_table',
                'batch' => 1,
            ),
            71 => 
            array (
                'migration' => '2016_03_03_170515_create_failed_jobs_table',
                'batch' => 2,
            ),
            72 => 
            array (
                'migration' => '2016_03_15_155314_create_jobs_table',
                'batch' => 3,
            ),
        ));
        
        
    }
}
