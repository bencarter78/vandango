<?php

use Illuminate\Database\Seeder;

class JudiDocumentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('judi_documents')->delete();
        
        \DB::table('judi_documents')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Observation of Individual Learner',
                'number' => 'PT8a FM2',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/PT8A-FM2-Observation-of-Individual-Learning-1.3.15.docx',
                'created_at' => '2015-11-02 11:33:51',
                'updated_at' => '2015-11-02 11:33:51',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Teaching observation',
                'number' => 'PT8 FM2',
                'url' => 'pt8a_fm2_teaching_observation-1.3.15.docx',
                'created_at' => '2015-11-02 11:45:11',
                'updated_at' => '2015-11-02 11:45:23',
                'deleted_at' => '2015-11-02 11:45:23',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Teaching, Learning & Assessment Observation ',
                'number' => 'PT8a FM2',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm2_teaching_observation-1.3.15.docx',
                'created_at' => '2015-11-02 11:48:38',
                'updated_at' => '2015-11-02 11:48:38',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Tips-for-Performance-Assessment-Observation-of-teaching',
                'number' => 'N/A',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/Tips-for-Performance-Assessment-Observation-of-teaching.docx',
                'created_at' => '2015-11-02 11:50:02',
                'updated_at' => '2015-11-02 11:50:02',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Health and Safety grading criteria',
                'number' => 'PT8 FM4 ',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm4_hs.docx',
                'created_at' => '2015-11-02 11:51:13',
                'updated_at' => '2015-11-02 11:52:31',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Health and Safety part 2 observation',
                'number' => 'PT8A FM2',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm2_hs2-12.3.12.docx',
                'created_at' => '2015-11-02 11:53:50',
                'updated_at' => '2015-11-02 11:53:50',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Health and Safety part 1 observation',
                'number' => 'PT8A FM2',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm2_hs1.doc',
                'created_at' => '2015-11-02 11:54:43',
                'updated_at' => '2015-11-02 11:54:43',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'IQA desktop',
                'number' => 'PT8a FM4',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm4_iv.docx',
                'created_at' => '2015-11-02 12:18:46',
                'updated_at' => '2015-11-02 12:19:05',
                'deleted_at' => '2015-11-02 12:19:05',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'IQA desktop',
                'number' => 'PT8a FM1',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm1_IQA-6.1.12.docx',
                'created_at' => '2015-11-02 12:19:48',
                'updated_at' => '2015-11-02 12:19:48',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Instruction observation',
                'number' => 'PT8a FM2',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm2_instruction_observation.doc',
                'created_at' => '2015-11-02 12:22:17',
                'updated_at' => '2015-11-02 12:22:17',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'title' => 'Progress review observation',
                'number' => 'PT8a FM2',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm2_progress_review.docx',
                'created_at' => '2015-11-02 12:23:23',
                'updated_at' => '2015-11-02 12:23:45',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'title' => 'Progress review desktop',
                'number' => 'PT8a FM1',
                'url' => 'http://10.2.70.5/intranet-new/wp-content/uploads/2011/08/pt8a_fm1_progress_review.docx',
                'created_at' => '2015-11-02 12:24:29',
                'updated_at' => '2015-11-02 12:24:29',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
