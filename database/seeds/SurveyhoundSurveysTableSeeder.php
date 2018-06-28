<?php

use Illuminate\Database\Seeder;

class SurveyhoundSurveysTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('surveyhound_surveys')->delete();
        
        \DB::table('surveyhound_surveys')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Learner Voice - Induction',
                'description' => 'This survey goes to every learner once they\'ve been on the course for 90 days. To gauge how the course in going from a Total People perspective.',
                'frequency' => 'day',
                'subject' => 'Total People want to hear from you',
                'message' => '<p>Hi {firstname},</p>
<p>It\'s been 3 months since you started with Total People and we wanted to see how your programme is going. All we\'re going to ask is&nbsp;for is a couple of details and then 5 questions, this is aimed to help improve the programmes that we offer you and all responses go directly to our Quality Team.&nbsp;</p>
<p>Please <a href="http://learnerzone.totalpeople.co.uk/surveyzone/learner-voice-3-months/" target="_blank">click here&nbsp;</a>&nbsp;to complete the short survey.</p>
<p>Thank you in advance for your honest thoughts.</p>
<p>Regards&nbsp;&nbsp;</p>
<p>The Quality Team at Total People&nbsp;</p>
<p>Head office: Group House, King Street, Middlewich, Cheshire, CW10 9LZ</p>
<p><strong>Tel</strong>: 01606 734000 <strong>Fax</strong>: 01606 734001 <strong>Web</strong>: <a href="http://www.totalpeople.co.uk/">www.totalpeople.co.uk</a></p>
<p>&nbsp;</p>',
                'sql' => 'select 
trainee.firstname as firstname,
trainee.surname,
pctrndet.email

from trainee
join pctrndet on pctrndet.ident = trainee.ident

where trainee.status in (\'C\',\'L\')
and trainee.tr_end is null
and (curdate () - trainee.tr_start) = 90
and pctrndet.email is not null',
                'created_at' => '2016-03-08 17:47:05',
                'updated_at' => '2016-04-21 14:06:28',
                'deleted_at' => '2016-04-21 14:06:28',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Learner Voice - In programme',
                'description' => 'Survey to gauge the opinion of learner during their programme. at 9 months, 18 months etc.',
                'frequency' => 'day',
                'subject' => 'Total People want to hear from you',
                'message' => '<p>Hi {firstname},</p>
<p>You should be now into your programme with&nbsp;Total People and we wanted to see how it&nbsp;is going. All we\'re going to ask is&nbsp;for is a couple of details and then 5 questions, this is aimed to help improve the programmes that we offer you and all responses go directly to our Quality Team.&nbsp;</p>
<p>Please <a href="http://learnerzone.totalpeople.co.uk/surveyzone/learner-voice-in-programme/" target="_blank">click here</a>&nbsp;to complete the short survey.</p>
<p>Thank you in advance for your honest thoughts.</p>
<p>Regards&nbsp;</p>
<p>The Quality Team at Total People&nbsp;</p>
<p>Head office: Group House, King Street, Middlewich, Cheshire, CW10 9LZ</p>
<p><strong>Tel</strong>: 01606 734000 <strong>Fax</strong>: 01606 734001 <strong>Web</strong>: <a href="http://www.totalpeople.co.uk/">www.totalpeople.co.uk</a></p>
<p>&nbsp;</p>',
                'sql' => 'select 
trainee.firstname as firstname,
trainee.surname,
pctrndet.email

from trainee
join pctrndet on pctrndet.ident = trainee.ident

where trainee.status in (\'C\',\'L\')
and trainee.tr_end is null
and (curdate () - trainee.tr_start = 270
or curdate () - trainee.tr_start = 540
or curdate () - trainee.tr_start = 810
or curdate () - trainee.tr_start = 1080
or curdate () - trainee.tr_start = 1350
or curdate () - trainee.tr_start = 1620
or curdate () - trainee.tr_start = 1890)
and pctrndet.email is not null',
                'created_at' => '2016-03-08 18:03:13',
                'updated_at' => '2016-04-21 14:08:02',
                'deleted_at' => '2016-04-21 14:08:02',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Learner Voice - Completion',
                'description' => 'This survey goes to every learner once they\'ve completed the course. To gauge how the course in going from a Total People perspective and destintion',
                'frequency' => 'day',
                'subject' => 'Total People want to hear from you',
                'message' => '<p>Hi {firstname},</p>
<p>Our records show that you\'ve completed your programme&nbsp;with Total People and we wanted to see how your programme is going. All we\'re going to ask is&nbsp;for is a couple of details and then 5 questions, this is aimed to help improve the programmes that we offer you and all responses go directly to our Quality Team.&nbsp;</p>
<p>Please <a href="http://learnerzone.totalpeople.co.uk/surveyzone/learner-voice-completion/" target="_blank">click here&nbsp;</a>to complete the short survey.</p>
<p>Thank you in advance for your honest thoughts.</p>
<p>Regards&nbsp;</p>
<p>The Quality Team at Total People&nbsp;</p>
<p>Head office: Group House, King Street, Middlewich, Cheshire, CW10 9LZ</p>
<p><strong>Tel</strong>: 01606 734000 <strong>Fax</strong>: 01606 734001 <strong>Web</strong>: <a href="http://www.totalpeople.co.uk/">www.totalpeople.co.uk</a></p>',
                'sql' => 'select 
trainee.firstname as firstname,
trainee.surname,
pctrndet.email as email

from trainee
join pctrndet on pctrndet.ident = trainee.ident
join traintex on traintex.ident = trainee.ident
join epidata on epidata.ident = trainee.ident

where 
trainee.status in (\'C\',\'L\')
and traintex.date05 = curdate ()
and epidata.fulfil_itp = \'1\'
and email is not null',
                'created_at' => '2016-03-08 18:31:26',
                'updated_at' => '2016-04-21 14:09:08',
                'deleted_at' => '2016-04-21 14:09:08',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Test Survey',
                'description' => '',
                'frequency' => 'week',
                'subject' => 'This is a test',
                'message' => '<p>Hi {trainee.firstname},</p>
<p>It\'s been 3 months since you started with Total People and we wanted to see how your programme is going. All we\'re going to ask is&nbsp;for is a couple of details and then 5 questions, this is aimed to help improve the programmes that we offer you and all responses go directly to our Quality Team.&nbsp;</p>
<p>Please <a href="http://learnerzone.totalpeople.co.uk/surveyzone/learner-voice-3-months/" target="_blank">click here&nbsp;</a>&nbsp;to complete the short survey.</p>
<p>Thank you in advance for your honest thoughts.</p>
<p>Regards&nbsp;&nbsp;</p>
<p>The Quality Team at Total People&nbsp;</p>
<p>Head office: Group House, King Street, Middlewich, Cheshire, CW10 9LZ</p>
<p><strong>Tel</strong>: 01606 734000 <strong>Fax</strong>: 01606 734001 <strong>Web</strong>: <a href="http://www.totalpeople.co.uk/">www.totalpeople.co.uk</a></p>',
                'sql' => 'select 
trainee.firstname,
trainee.surname,
pctrndet.email

from trainee
join pctrndet on pctrndet.ident = trainee.ident

where trainee.status in (\'C\',\'L\')
and trainee.tr_end is null
and (curdate () - trainee.tr_start) = 90
and pctrndet.email is not null',
                'created_at' => '2016-03-14 12:37:52',
                'updated_at' => '2016-03-16 17:23:21',
                'deleted_at' => '2016-03-16 17:23:21',
            ),
        ));
        
        
    }
}
