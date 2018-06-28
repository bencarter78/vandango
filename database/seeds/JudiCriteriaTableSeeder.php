<?php

use Illuminate\Database\Seeder;

class JudiCriteriaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_criteria')->delete();
        
        \DB::table('judi_criteria')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Overall Grade',
                'description' => 'The overall grade for the performance assessment',
                'created_at' => '2014-12-04 15:51:53',
                'updated_at' => '2014-12-08 10:50:54',
                'deleted_at' => '2014-12-08 10:50:54',
            ),
            1 => 
            array (
                'id' => 2,
            'name' => 'IQA Planning (Paperbased / Onefile)',
                'description' => '',
                'created_at' => '2014-12-04 16:24:04',
                'updated_at' => '2014-12-04 16:24:04',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Observation Records',
                'description' => '',
                'created_at' => '2014-12-04 16:24:40',
                'updated_at' => '2014-12-04 16:41:59',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
            'name' => 'Sampling Reports (Paperbased / Onefile)',
                'description' => '',
                'created_at' => '2014-12-04 16:25:29',
                'updated_at' => '2014-12-04 16:25:34',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Learner Questionnaires',
                'description' => '',
                'created_at' => '2014-12-04 16:26:09',
                'updated_at' => '2014-12-04 16:26:09',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Employer Questionnaires',
                'description' => '',
                'created_at' => '2014-12-04 16:26:19',
                'updated_at' => '2014-12-04 16:26:19',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
            'name' => 'Completion of Assessor(s)/IQA TNAs',
                'description' => 'Complete only if applicable.',
                'created_at' => '2014-12-04 16:26:54',
                'updated_at' => '2014-12-04 16:26:54',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Accredited Centre Processes',
                'description' => '',
                'created_at' => '2014-12-04 16:27:05',
                'updated_at' => '2014-12-04 16:27:05',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Adherence to Sector Strategy',
                'description' => '',
                'created_at' => '2014-12-04 16:27:17',
                'updated_at' => '2014-12-04 16:27:17',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Review Participants',
                'description' => '',
                'created_at' => '2014-12-04 16:35:47',
                'updated_at' => '2014-12-04 16:35:47',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Review of previous actions and recording of progress',
                'description' => '',
                'created_at' => '2014-12-04 16:35:59',
                'updated_at' => '2014-12-04 16:35:59',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Training & Knowledge',
                'description' => '',
                'created_at' => '2014-12-04 16:36:08',
                'updated_at' => '2014-12-04 16:36:08',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Equality & Diversity',
                'description' => '',
                'created_at' => '2014-12-04 16:36:20',
                'updated_at' => '2014-12-04 16:36:20',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Health & Safety',
                'description' => '',
                'created_at' => '2014-12-04 16:36:30',
                'updated_at' => '2014-12-04 16:36:30',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Learning Support/Functional Skills',
                'description' => '',
                'created_at' => '2014-12-04 16:36:43',
                'updated_at' => '2014-12-04 16:36:43',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Forward planning and targets',
                'description' => '',
                'created_at' => '2014-12-04 16:37:01',
                'updated_at' => '2014-12-04 16:37:01',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Workplace training and opportunity for skills development',
                'description' => '',
                'created_at' => '2014-12-04 16:37:23',
                'updated_at' => '2014-12-04 16:37:23',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Information, Advice and Guidance',
                'description' => '',
                'created_at' => '2014-12-04 16:37:31',
                'updated_at' => '2014-12-04 16:37:31',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Attendance',
                'description' => '',
                'created_at' => '2014-12-04 16:37:41',
                'updated_at' => '2014-12-04 16:37:41',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Learner comment / engagement',
                'description' => '',
                'created_at' => '2014-12-04 16:37:51',
                'updated_at' => '2014-12-04 16:37:51',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Employer / Representative engagement',
                'description' => '',
                'created_at' => '2014-12-04 16:38:01',
                'updated_at' => '2014-12-04 16:38:01',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Review  planning and preparation',
                'description' => '',
                'created_at' => '2014-12-04 16:38:11',
                'updated_at' => '2014-12-04 16:38:11',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Communication and conduct of review',
                'description' => '',
                'created_at' => '2014-12-04 16:38:19',
                'updated_at' => '2014-12-04 16:38:19',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Effective questioning and discussion techniques used to suit learner',
                'description' => '',
                'created_at' => '2014-12-04 16:38:30',
                'updated_at' => '2014-12-04 16:38:30',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Pace of review delivery',
                'description' => '',
                'created_at' => '2014-12-04 16:38:40',
                'updated_at' => '2014-12-04 16:38:40',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Recap and summary of review',
                'description' => '',
                'created_at' => '2014-12-04 16:38:52',
                'updated_at' => '2014-12-04 16:38:52',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Content grade',
                'description' => '',
                'created_at' => '2014-12-04 16:39:25',
                'updated_at' => '2014-12-04 16:39:25',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Learner Details',
                'description' => '',
                'created_at' => '2014-12-04 16:39:34',
                'updated_at' => '2014-12-04 16:39:34',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Reviewing Your Progress',
                'description' => '',
                'created_at' => '2014-12-04 16:39:44',
                'updated_at' => '2014-12-04 16:39:44',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Progress recorded for all aspects of the functional skills / key skills status',
                'description' => '',
                'created_at' => '2014-12-04 16:40:14',
                'updated_at' => '2014-12-04 16:40:14',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Additional Learning and Social needs support',
                'description' => '',
                'created_at' => '2014-12-04 16:40:39',
                'updated_at' => '2014-12-04 16:40:39',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Scheme of Work',
                'description' => '',
                'created_at' => '2014-12-04 16:41:19',
                'updated_at' => '2014-12-04 16:41:19',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Session Plan',
                'description' => '',
                'created_at' => '2014-12-04 16:42:12',
                'updated_at' => '2014-12-04 16:42:12',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Learning Environment',
                'description' => '',
                'created_at' => '2014-12-04 16:42:21',
                'updated_at' => '2014-12-04 16:42:21',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => ' Safeguarding',
                'description' => '',
                'created_at' => '2014-12-04 16:42:29',
                'updated_at' => '2015-06-01 10:44:47',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Differentiation/inclusion',
                'description' => '',
                'created_at' => '2014-12-04 16:42:40',
                'updated_at' => '2015-06-01 10:36:22',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Introduction, session objectives',
                'description' => '',
                'created_at' => '2014-12-04 16:42:50',
                'updated_at' => '2014-12-04 16:42:50',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Learning Materials/resources',
                'description' => '',
                'created_at' => '2014-12-04 16:42:59',
                'updated_at' => '2014-12-04 16:42:59',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Use of questioning',
                'description' => '',
                'created_at' => '2014-12-04 16:43:08',
                'updated_at' => '2014-12-04 16:43:08',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Links in the learning',
                'description' => '',
                'created_at' => '2014-12-04 16:43:17',
                'updated_at' => '2014-12-04 16:43:17',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'English, Maths and ICT',
                'description' => '',
                'created_at' => '2014-12-04 16:43:25',
                'updated_at' => '2014-12-04 16:43:25',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Teaching methods',
                'description' => '',
                'created_at' => '2014-12-04 16:43:35',
                'updated_at' => '2014-12-04 16:43:35',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Management of learning',
                'description' => '',
                'created_at' => '2014-12-04 16:43:46',
                'updated_at' => '2014-12-04 16:43:46',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Pace of session delivery',
                'description' => '',
                'created_at' => '2014-12-04 16:43:56',
                'updated_at' => '2014-12-04 16:43:56',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Review, Recap  and Summary of learning',
                'description' => '',
                'created_at' => '2014-12-04 16:44:04',
                'updated_at' => '2014-12-04 16:44:04',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Independent Learning and responsibility',
                'description' => '',
                'created_at' => '2014-12-04 16:44:15',
                'updated_at' => '2014-12-04 16:44:15',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Assessment',
                'description' => '',
                'created_at' => '2014-12-04 16:44:25',
                'updated_at' => '2014-12-04 16:44:25',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Feedback from Learner',
                'description' => '',
                'created_at' => '2014-12-04 16:44:36',
                'updated_at' => '2014-12-04 16:44:36',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Standards of learning',
                'description' => '',
                'created_at' => '2014-12-04 16:44:47',
                'updated_at' => '2014-12-04 16:44:47',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
            'name' => 'Overall Training Plan (SoW)',
                'description' => '',
                'created_at' => '2014-12-04 16:45:15',
                'updated_at' => '2014-12-04 16:45:15',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Tutor/instructor style and coaching/instruction skills',
                'description' => '',
                'created_at' => '2015-01-13 12:34:17',
                'updated_at' => '2015-01-13 12:34:17',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Reviewing your progress',
                'description' => '',
                'created_at' => '2015-11-02 13:07:52',
                'updated_at' => '2015-11-02 14:15:33',
                'deleted_at' => '2015-11-02 14:15:33',
            ),
        ));
        
        
    }
}
