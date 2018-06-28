<?php

use Illuminate\Database\Seeder;

class AuditorTasksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('auditor_tasks')->delete();
        
        \DB::table('auditor_tasks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Future Review Checker',
                'description' => 'Checks all learners for a future review date.',
                'sql' => 'select 
trainee.ident,
trainee.surname,
trainee.firstname,
trainee.birthdate as dob,
trainee.tr_start,
trainee.tr_end,
trainee.scheme,
itp_revu."type",
itp_revu.actual as review_date

from trainee
join itp_revu on itp_revu.ident = trainee.ident

where 
trainee.status in (\'C\',\'L\')
and itp_revu.actual > curdate() 
and (trainee.tr_end is null or trainee.tr_end > \'2013-07-31\')',
                'group_by' => NULL,
                'recipients' => 'ben.carter@totalpeople.co.uk',
                'notification' => '<p>Hello</p>
<p>Did you know that {firstname} has a review date in the future?</p>
<p>Thanks</p>',
                'run_frequency' => 'day',
                'ran_at' => NULL,
                'category' => 0,
                'draft' => 0,
                'created_at' => '2014-12-22 15:57:50',
                'updated_at' => '2015-01-07 16:36:37',
                'deleted_at' => '2015-01-07 16:36:37',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Overdue ESF Learners',
                'description' => 'ESF Learners who are overdue or who have an expected end in the next 35 days ',
                'sql' => 'select 
t.ident,
esf_lead.name as esf_lead,
concat(rtrim(t.firstname)+\' \',rtrim(t.surname)) as learner_name,
e.tr_expect,
o.forename as adviser,
o.surname,
o.email

from 
trainee t 
left join placemnt esf_lead on t.emp_ref = esf_lead.place
left join epidata e on t.ident = e.ident
left join officer o on t.main_off = o.code

where 
t.tr_end is null
and t."group" = \'D\'
and t.emp_ref in (\'CALDE1\',\'99140G\',\'C10011\',\'STOKEO\')
and t.status in (\'C\',\'L\')
and e.tr_expect <= curdate()+35
and t.main_off = \'RLAW\'

order by esf_lead.name',
                'group_by' => NULL,
                'recipients' => 'ben.carter@totalpeople.co.uk',
                'notification' => '<p><strong>Learner: {learner_name}<br /></strong><strong>ESF Lead: {esf_lead}</strong></p>
<p>Hello&nbsp;{adviser}</p>
<p>This is to let you know that {learner_name} has an end date of <strong>{tr_expect}</strong>.</p>
<p>Please ensure this learner is finished.</p>
<p>Thanks</p>
<p><strong>Auditor@VanDango</strong></p>',
                'run_frequency' => 'day',
                'ran_at' => NULL,
                'category' => 0,
                'draft' => 0,
                'created_at' => '2015-01-07 14:22:10',
                'updated_at' => '2015-01-12 09:04:41',
                'deleted_at' => '2015-01-12 09:04:41',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Test',
                'description' => 'test',
                'sql' => 'select
--count(evid) as counter
placemnt.company as Code_Head_Office,pcplevnt.place as Code_HSP1_linked_to,ucase(placemnt.tecplcid) as Sector
from 
pcplevnt
join placemnt on pcplevnt.place = placemnt.place  
where
pcplevnt."type" = \'H\'
and pcplevnt.place <> placemnt.company
and not(placemnt.place = \'GROSV1\')

order by placemnt.tecplcid',
                'group_by' => NULL,
                'recipients' => 'ben.carter@totalpeople.co.uk',
                'notification' => '<p>Hi Ollie,</p>
<p>&nbsp;</p>
<p>this is a test for {firstname}</p>
<p>&nbsp;</p>
<p>From</p>
<p>Ollie</p>
<p>&nbsp;</p>
<p>&nbsp;</p>',
                'run_frequency' => 'day',
                'ran_at' => NULL,
                'category' => 0,
                'draft' => 0,
                'created_at' => '2015-03-27 11:44:33',
                'updated_at' => '2016-03-08 15:10:38',
                'deleted_at' => '2016-03-08 15:10:38',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'H&S Part 1 has been attached to subsidiary company',
                'description' => 'Report highlighting where a Health & Safety Part 1 has been attached to a subsidiary company, rather than the head office ',
                'sql' => 'select 
p.company,
p.place,
p.name as CompanyName,
convert(pc.evactend,sql_date) as "date",
p.tecplcid as sector

from placemnt p
join pcplevnt pc on pc.place = p.place

where pc."type" = \'H\'
and p.company is not null
and convert(pc.evactend,sql_date) > \'2010-01-01\'

order by p.tecplcid, p.name',
                'group_by' => NULL,
                'recipients' => 'joanne.sartain@totalpeople.co.uk',
                'notification' => '<p>Hi Jo,</p>
<p>&nbsp;</p>
<p>Here is a list of all the company names who have had a Health &amp; Safety Part 1 incorrectly attached to them:</p>
<p>{CompanyName}</p>
<p>&nbsp;</p>
<p>Ollie</p>',
                'run_frequency' => 'week',
                'ran_at' => NULL,
                'category' => 0,
                'draft' => 0,
                'created_at' => '2015-04-09 10:20:18',
                'updated_at' => '2015-04-15 11:30:31',
                'deleted_at' => '2015-04-15 11:30:31',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'No adviser email linked to current learners',
                'description' => 'No adviser email is linked to a current learner',
                'sql' => 'select
t.ident as ident,
t.firstname as FirstName,
t.surname as Surname,
t.main_off,
o.email


from 
trainee t
join officer o on o.code = t.main_off


where
t.status in (\'C\',\'L\')
and (t.tr_end is null or t.tr_end >= \'2014-08-01\') 
and o.email is null


--select * from officer',
                'group_by' => NULL,
                'recipients' => 'joanne.sartain@totalpeople.co.uk',
                'notification' => '<p>Hi Jo,</p>
<p>The following learners have no adviser email linked to them:</p>
<p>{FirstName} {Surname}, {ident}&nbsp;</p>
<p>Auditor@VanDango</p>',
                'run_frequency' => 'week',
                'ran_at' => '2016-04-11 07:05:03',
                'category' => 0,
                'draft' => 0,
                'created_at' => '2015-04-09 11:13:37',
                'updated_at' => '2016-04-11 07:05:03',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'No TECPLCID code',
                'description' => 'No sector code linked to a live organisation',
                'sql' => 'select
trplace.ident,
trplace.place as emp_code,
left(trainee.site,5) as site,
head_off.ho as ho_code,
ucase(placemnt.tecplcid) as emp_lead_site,
ucase(ho.tecplcid) as ho_lead_site


from 
trplace
join placemnt on trplace.place = placemnt.place
join trainee on trplace.ident = trainee.ident

left join
(select ho.place,
case when ho.company is null then ho.place
else ho.company end ho
from placemnt ho) head_off
on trplace.place = head_off.place 	 

left join
(select ho.place,ho.tecplcid
from placemnt ho) ho
on ho.place = head_off.ho		


where 
trainee.tr_end is null
and (trplace."end" is null and trplace."type" = \'P\') 
and trainee.status in (\'C\',\'L\')
and not trainee."group" in (\'F\',\'[\')
and not trainee.fundorg = \'PRV1\' 
and trainee.suspended = \'N\'
--and hsp1.last_hsp1 is null
and (placemnt.tecplcid is null or ho.tecplcid is null)
',
                'group_by' => NULL,
                'recipients' => 'joanne.sartain@totalpeople.co.uk',
                'notification' => '<p>Hi Jo,</p>
<p>Here is a list of live organisations that have no sector code linked to them or to the head office (where applicable):</p>
<p>The organisation code is {emp_code} and its current TECPLCID value is "{emp_lead_site}". The head office code is {ho_code} (which may be the same) and its current TECPLCID value is "{ho_lead_site}"</p>
<p>The possible code is {site}.</p>
<p>Auditor@VanDango</p>',
                'run_frequency' => 'week',
                'ran_at' => '2016-05-09 07:05:04',
                'category' => 0,
                'draft' => 0,
                'created_at' => '2015-04-09 11:26:39',
                'updated_at' => '2016-05-09 07:05:04',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'ALSN Review added without a tick',
                'description' => 'ALSN Review added without a tick',
                'sql' => 'select  
itp.ident as ident,
itp.initials,
case when "type" = \'N\' then \'N: Progress Review\'
when "type" = \'C\' then \'C: Learner Contact\'
when "type" = \'M\' then \'M: H&S Part 2\'
when "type" = \'A\' then \'A: Assessment (from onefile)\'
when "type" = \'S\' then \'S: ALSN / 139a / HNS / EHCP\' end review_type,

itp.actual,
itp.user_def_1,
\'need to tick\' as note

from 
itp_revu as itp 
join trainee t on t.ident = itp.ident

where 
t.status in(\'C\',\'L\')
and itp."type" in (\'S\')
and (
itp.user_def_1 is null or not(

itp.user_def_1 like \'%9%\'
or itp.user_def_1 like \'%A%\'
or itp.user_def_1 like \'%E%\'
or itp.user_def_1 like \'%H%\'
or itp.user_def_1 like \'%4%\'
or itp.user_def_1 like \'%5%\'))
order by itp.ident

',
                    'group_by' => NULL,
                    'recipients' => 'joanne.sartain@totalpeople.co.uk',
                    'notification' => '<p>Hi Jo,</p>
<p>Here is a list of learner idents where an ALSN review has been submitted, but the review document type has not been ticked:</p>
<p>{ident}</p>
<p>Thanks</p>
<p>Auditor@VanDango</p>',
                    'run_frequency' => 'day',
                    'ran_at' => NULL,
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2015-04-10 09:13:54',
                    'updated_at' => '2016-02-26 14:02:24',
                    'deleted_at' => NULL,
                ),
                7 => 
                array (
                    'id' => 8,
                    'title' => 'ALSN review added with wrong document ticked',
                    'description' => 'ALSN review added with wrong document ticked',
                    'sql' => 'select ident

from itp_revu 

where "type" in (\'S\')
and (user_def_1 like \'%2%\'
or user_def_1 like \'%3%\'
or user_def_1 like \'%6%\'
or user_def_1 like \'%7%\'
or user_def_1 like \'%8%\')
order by ident',
                    'group_by' => NULL,
                    'recipients' => 'joanne.sartain@totalpeople.co.uk',
                    'notification' => '<p>Hi Jo,</p>
<p>Here is a list of learner idents where an ALSN review has been added, but the wrong document has been ticked</p>
<p>{ident}</p>
<p>Thanks,</p>
<p>Auditor@VanDango</p>',
                    'run_frequency' => 'day',
                    'ran_at' => NULL,
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2015-04-10 09:20:50',
                    'updated_at' => '2016-03-23 13:22:48',
                    'deleted_at' => NULL,
                ),
                8 => 
                array (
                    'id' => 9,
                    'title' => 'Kids Allowed GSCE Invoice Report',
                    'description' => 'Kids Allowed GSCE Invoice Report',
                    'sql' => 'select 
\'Kids Allowed GCSE Invoice Report\' as report,
t.ident as ident,
t.firstname as firstname,
t.surname as surname,
aim.vq_ref as ref,
qual.vqdesc as description,
aim.fundstart,

tr_age.age_at_start,

py.vqref,
py.actual,
py.actualamt,
py.payref,
py.descrip

from
trainee t
join pclscvq aim on t.ident = aim.ident
join pcqual qual on aim.vq_ref = qual.vqref 
left join pctrnpay py on (t.ident = py.ident and aim.vq_ref = py.vqref) 


//calculate age
left join 
(select tr.ident,
case when (month(tr.tr_start) < month(tr.birthdate))
then year(tr.tr_start) - year(tr.birthdate) - 1
when (month(tr.tr_start) = month(tr.birthdate) and dayofmonth(tr.tr_start) <= dayofmonth(tr.birthdate)) 
then year(tr.tr_start) - year(tr.birthdate) - 1
else year(tr.tr_start) - year(tr.birthdate) end age_at_start
from trainee tr) tr_age
on t.ident = tr_age.ident


where 
t.emp_ref = \'10977L\'
and tr_age.age_at_start >= 19
and qual.vqdesc like \'%GCSE%\'
and py.vqref is null
and aim.fundstart <= curdate()

order by t.surname, t.firstname, aim.vq_ref',
                    'group_by' => NULL,
                    'recipients' => 'accounts@totalpeople.co.uk',
                    'notification' => '<p>Hi All</p>
<p>The following learner has been added to Kids Allowed and is undertaking a GCSE qualification which is chargeable:</p>
<p>{firstname} {surname}, {ident} undertaking {ref}, {description}</p>
<p>Auditor@VanDango</p>',
                    'run_frequency' => 'week',
                    'ran_at' => '2016-05-09 07:05:12',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2015-04-22 08:31:05',
                    'updated_at' => '2016-05-09 07:05:12',
                    'deleted_at' => NULL,
                ),
                9 => 
                array (
                    'id' => 10,
                    'title' => 'No Proposed Reviews',
                    'description' => 'Notification where there is no proposed review set for a current learner where the Adviser is using the pdf electronic review',
                'sql' => 'select t.ident, curdate()+16 as proposed
from trainee t
join officer o on t.main_off = o.code
left join 
(	 	select 
rev.ident, 
rev.proposed 
from 
itp_revu rev
where
rev.actual is null
) revs on revs.ident = t.ident

where 
t.status in (\'C\',\'L\')
and t.tr_end is null
and o.cont_meth like \'%E%\'
and revs.proposed is null
and t.suspended = \'N\'',
                    'group_by' => NULL,
                    'recipients' => 'melissa.blakemore@totalpeople.co.uk, joanne.sartain@totalpeople.co.uk',
                    'notification' => '<p>Hello</p>
<p>This is a notification for the learner with PICS id {ident} as a new planned review is not set and their Adviser using the electronic review process.</p>
<p>Add a proposed review 8 weeks after last review or start date if recent. Date entered must be on or after {proposed|date:d/m/Y}</p>
<p>Auditor@VanDango</p>
<p>&nbsp;</p>',
                    'run_frequency' => 'day',
                    'ran_at' => '2016-05-09 07:03:02',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2015-12-09 14:09:07',
                    'updated_at' => '2016-05-09 07:03:02',
                    'deleted_at' => NULL,
                ),
                10 => 
                array (
                    'id' => 11,
                    'title' => '24+ Loan Coding Check',
                'description' => 'Checks that the correct SOF (=999) and ADL (=1) is set for 24+ Advanced learning Loans learners',
                    'sql' => 'select 
t.ident,
t."group"+t.subgrp as prg_grp,

case when aim.fefndsrc1 = \'0\' then \'okay:\'+aim.fefndsrc1
else aim.fefndsrc1+\' SOF should be 0 (use :na bottom one on list)\' end SOF_check,

case when aim.fm_adl is null then \'ADL should be set to 1\'
when aim.fm_adl = \'1\' then \'okay:\'+aim.fm_adl
else \'ADL should be set to 1\' end ADL_check

FROM trainee t 
join pclscvq aim on t.ident = aim.ident
where
--t.ident = \'81646\'

t."group"+t.subgrp = \'XV\'
and t.status in (\'C\',\'L\')
and (not(aim.fefndsrc1 = \'0\') or aim.fm_adl is null)
and (t.tr_end is null or t.tr_end > \'2015-07-31\')

',
                    'group_by' => NULL,
                    'recipients' => 'joanne.sartain@totalpeople.co.uk',
                    'notification' => '<p>Hi Jo</p>
<p>This is to let you know that learner with pics id <strong>{ident}</strong> doesn\'t have the correct code for either SOF or ADL set against the aim record on PICS - see below.&nbsp;</p>
<p>SOF: <strong>{SOF_check}</strong></p>
<p>ADL: <strong>{ADL_check}</strong></p>
<p>Thanks</p>
<p>Auditor@VanDango</p>',
                    'run_frequency' => 'week',
                    'ran_at' => '2016-05-09 07:05:13',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2015-12-18 16:00:41',
                    'updated_at' => '2016-05-09 07:05:13',
                    'deleted_at' => NULL,
                ),
                11 => 
                array (
                    'id' => 12,
                    'title' => 'Missing Learner email address',
                    'description' => 'Checks for current learners without an email address',
                    'sql' => '-- == missing learner emails == --

select
t.ident, 
--t."group"+t.subgrp+main_aim.vqlevel,
case when (t."group"+t.subgrp+main_aim.vqlevel) like \'FS%\' then \'Study Programme\'
when (t."group"+t.subgrp+main_aim.vqlevel) like \'FT%\' then \'Study Programme Traineeship\'
when (t."group"+t.subgrp+main_aim.vqlevel) like \'G%\'  then \'Prospects Plus\'
when (t."group"+t.subgrp+main_aim.vqlevel) like \'H%\'  then \'Commercial L\'+main_aim.vqlevel
when (t."group"+t.subgrp+main_aim.vqlevel) like \'K%\'  then \'K\'+main_aim.vqlevel
when (t."group"+t.subgrp+main_aim.vqlevel) like \'OA%\' then \'Advanced Apprenticeship\'
when (t."group"+t.subgrp+main_aim.vqlevel) like \'OH%\' then \'Higher Apprenticeship\'
when (t."group"+t.subgrp+main_aim.vqlevel) like \'OI%\' then \'Intermediate Apprenticeship\'
when (t."group"+t.subgrp+main_aim.vqlevel) like \'K%\'  then \'Wigan Schools\'
when (t."group"+t.subgrp+main_aim.vqlevel) like \'TW%\' then \'Workplace L\'+main_aim.vqlevel
when (t."group"+t.subgrp+main_aim.vqlevel) like \'XT%\' then \'Apprenticeship Trailblazer L\'+main_aim.vqlevel
when (t."group"+t.subgrp+main_aim.vqlevel) like \'XV%\' then \'24+ Loan L\'+main_aim.vqlevel
when (t."group"+t.subgrp+main_aim.vqlevel) like \'[C%\' then \'Classroom Based L\'+main_aim.vqlevel
when (t."group"+t.subgrp+main_aim.vqlevel) like \'[T%\' then \'19+ Traineeship\'
else (\'Not Found \'+t."group"+t.subgrp+main_aim.vqlevel) end programme,
rtrim(t.firstname)+\' \'+rtrim(t.surname) as lnr_name,
rtrim(o.forename) as adv_fname,
o.email as adv_email

from
trainee t
left join epidata e on t.ident = e.ident
left join pcqual main_aim on e.ini_ref = main_aim.vqref
left join officer o on t.main_off = o.code
left join pctrndet det on t.ident = det.ident
left join traintex tx on t.ident = tx.ident
where t.tr_end is null
and t.suspended = \'N\'
and t.status in (\'C\',\'L\')
and det.email is null
and not(t.site = \'OM215\' or t.site like \'OM5%\')
and not t."group" = \'K\'
and (tx.mcodes05 is null or tx.mcodes05 not like \'%M%\')
',
                    'group_by' => NULL,
                    'recipients' => '{adv_email}',
                    'notification' => '<p>Hi {adv_fname}</p>
<p>We have checked PICS and we don\'t currently hold an email address for {lnr_name} who is one of your learners.&nbsp;</p>
<p><strong>PICS ID:</strong> {ident}</p>
<p><strong>Programme:</strong> {programme}</p>
<p>If you have an email address for the learner, could you please forward it to your programme administrator so that the system can be updated. Please include the id of the learner which is shown above.</p>
<p>If the learner doesn\'t have an email address, please also notify your administrator so that we can note this on PICS and this&nbsp;<em>monthly&nbsp;</em>reminder will stop.</p>
<p>It is really important that we hold a valid email address for all our learners to ensure that we can communicate effectively with them.</p>
<p>Thanks</p>
<p>Auditor@VanDango</p>',
                    'run_frequency' => 'month',
                    'ran_at' => '2016-05-01 00:00:24',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2015-12-21 12:16:07',
                    'updated_at' => '2016-05-01 00:00:24',
                    'deleted_at' => NULL,
                ),
                12 => 
                array (
                    'id' => 13,
                    'title' => 'HS Part 1 not linked to Head Office record',
                    'description' => 'HS Part 1 activity not linked to the Head Office recorded for the organisation',
                    'sql' => 'select
--count(evid) as counter
placemnt.company as Code_Head_Office,pcplevnt.place as Code_HSP1_linked_to,ucase(placemnt.tecplcid) as Sector
from 
pcplevnt
join placemnt on pcplevnt.place = placemnt.place  
where
pcplevnt.type = \'H\'
and pcplevnt.place <> placemnt.company
and pcplevnt.evactend >= \'2010-08-01 00:00:00\'
and not(placemnt.place = \'GROSV1\')

order by placemnt.tecplcid',
                    'group_by' => NULL,
                    'recipients' => 'joanne.sartain@totalpeople.co.uk',
                    'notification' => '<p>Hi Jo</p>
<p>A HS Part 1 activity has been linked to {Code_HSP1_linked_to} which should be linked to the head office code recorded for the organisation which is {Code_Head_Office}.</p>
<p>Thanks</p>
<p>Auditor@VanDango</p>
<p>&nbsp;</p>',
                    'run_frequency' => 'day',
                    'ran_at' => '2016-05-09 07:03:09',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-01-21 12:08:42',
                    'updated_at' => '2016-05-09 07:03:09',
                    'deleted_at' => NULL,
                ),
                13 => 
                array (
                    'id' => 14,
                    'title' => 'HS Part 1 set to pending',
                    'description' => 'HS Part 1 activity recorded as pending',
                    'sql' => 'select
evid,
placemnt.company as Code_Head_Office,
pcplevnt.place as Code_HSP1_linked_to,
ucase(placemnt.tecplcid) as Sector,
pcplevnt.status

from 
pcplevnt
join placemnt on pcplevnt.place = placemnt.place  
where
pcplevnt."type" = \'H\'
and pcplevnt.evactend is null 
and pcplevnt.evexpstart >= \'2010-08-01 00:00:00\'
and not evid = (64490)

order by placemnt.tecplcid
',
                    'group_by' => NULL,
                    'recipients' => 'joanne.sartain@totalpeople.co.uk',
                    'notification' => '<p>Hi Jo</p>
<p>A HS Part 1 activity has been linked to {Code_HSP1_linked_to} and is set to pending without an actual end date.</p>
<p>Thanks</p>
<p>Auditor@VanDango</p>
<p>&nbsp;</p>',
                    'run_frequency' => 'day',
                    'ran_at' => '2016-04-14 07:03:04',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-01-21 13:12:08',
                    'updated_at' => '2016-04-14 07:03:04',
                    'deleted_at' => NULL,
                ),
                14 => 
                array (
                    'id' => 15,
                    'title' => 'Weekly check for Barlows learners registered on onefile for invoicing',
                    'description' => 'Checks to see if any Barlows learners have been added to onefile so that an invoice can be raised',
                    'sql' => 'select 
t.ident,
t.tr_start,
t.firstname,
t.surname,
det.eportype,
(rtrim(o.forename)+\' \'+rtrim(o.surname)) as adviser

from
trainee t 
join pctrndet det on t.ident = det.ident
join officer o on t.main_off = o.code
left join pctrnpay py on (t.ident = py.ident and py.periodcode = \'CONEF\') 

where
t.status in (\'C\',\'L\')
and py.periodcode is null
and t."group" = \'O\'
and t.emp_ref = \'BARLOW\'
and det.eportype = \'O\'

order by t.surname, t.firstname',
                    'group_by' => NULL,
                    'recipients' => 'accounts@totalpeople.co.uk',
                    'notification' => '<p>Hi All</p>
<p>This is just to let you know that the Barlows learner listed below is registered on onefile but the recharge has not been recorded in PICS.</p>
<p><strong>ID:&nbsp;</strong>{ident}</p>
<p><strong>Name:</strong>&nbsp;{firstname}<strong>&nbsp;</strong>{surname}</p>
<p><strong>Start Date:</strong>&nbsp;{tr_start}</p>
<p>Barlows should be re-charged &pound;20 for this registration and the invoice should be recorded in extras on PICS against the learner using code \'CONEF\'</p>
<p>Thanks</p>
<p>Auditor@VanDango</p>',
                    'run_frequency' => 'week',
                    'ran_at' => '2016-04-11 07:05:12',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-02-04 11:52:07',
                    'updated_at' => '2016-04-11 07:05:12',
                    'deleted_at' => NULL,
                ),
                15 => 
                array (
                    'id' => 16,
                'title' => 'Stats - Frameworks Achieved (All)',
                    'description' => 'Daily Update of Frameworks Achieved',
                'sql' => 'select count(ident) as all_frameworks from epidata where frm_achv is not null
',
                    'group_by' => NULL,
                    'recipients' => 'ben.carter@totalpeople.co.uk',
                    'notification' => '<p>Oh Hi Ben&nbsp;</p>
<p>Here is todays figure for the total number of Apprenticeship frameworks delivered {all_frameworks}.</p>
<p>Thanks</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>',
                    'run_frequency' => 'day',
                    'ran_at' => '2016-05-09 07:03:33',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-02-26 11:26:17',
                    'updated_at' => '2016-05-09 07:03:33',
                    'deleted_at' => NULL,
                ),
                16 => 
                array (
                    'id' => 17,
                    'title' => 'Stats - Frameworks Achieved 2015/16',
                    'description' => 'Report showing count of Frameworks Achieved in 2015/16',
                    'sql' => 'select 
count(ident) as frameworks_201516 

from epidata 

where frm_achv is not null
and frm_achv >= \'2015-08-01\' 
and frm_achv <= \'2016-07-31\'',
                    'group_by' => NULL,
                    'recipients' => 'ben.carter@totalpeople.co.uk',
                    'notification' => '<p>Oh Hi Ben&nbsp;</p>
<p>Here is todays figure for the total number of Apprenticeship frameworks delivered {frameworks_201516}.</p>
<p>Thanks</p>
<p>&nbsp;</p>
<p>&nbsp;</p>',
                    'run_frequency' => 'day',
                    'ran_at' => '2016-05-09 07:03:33',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-02-26 11:29:23',
                    'updated_at' => '2016-05-09 07:03:33',
                    'deleted_at' => NULL,
                ),
                17 => 
                array (
                    'id' => 18,
                    'title' => 'Break in Learning > 180 days',
                    'description' => 'Break in Learning exceeding 180 days where the reason is not maternity',
                    'sql' => 'select
t.ident,
t.firstname,
t.surname,

case when (t.site = \'OM215\' or left(t.site,3) = \'OM5\') then substring(site.descrip,7,25)
else trim(adv.forename)+\' \'+trim(adv.surname) end name,

adv.email as advemail,
mgr.email as mgremail,
susp.suspdate,
curdate() - susp.suspdate as days

from
trainee t
join officer adv on t.main_off = adv.code
left join officer mgr on adv.superior = mgr.code
left join traintex tx on tx.ident = t.ident
left join pcsite site on left(t.site,5) = site.code

join 
(	select trhist.ident,
max(trhist.change) as suspdate
from trhist
group by trhist.ident) susp
on susp.ident = t.ident

where
t.tr_end is null
and t.status in (\'C\',\'L\')
and t.suspended = \'Y\'
and (tx.txpick06 is null or not tx.txpick06 = \'00001\') and curdate() - susp.suspdate > 180

',
                    'group_by' => NULL,
                    'recipients' => '{advemail},{mgremail},joanne.sartain@totalpeople.co.uk,sheryl.keen@totalpeople.co.uk',
                    'notification' => '<p>Hi {name}</p>
<p><strong>{firstname} {surname}</strong> (id:{ident}) has been on an agreed break in learning which exceeds 180 days. The break commenced on {suspdate} ({days} days ago).</p>
<p>In accordance with our learner absence policy, the learner should now be left as at the last evidence date.</p>
<p>If you take no action, your programme administrator will arrange with you to leave the learner as at the last evidence date in the next few days and you will be required to complete the learner exit and progression review.</p>
<p>If you intend to re-instate the learner you should contact your programme administrator as soon as possible to delay this action but note that you will continue to receive this <em><strong>weekly</strong> </em>reminder until the learner is re-instated or left.</p>
<p>Learners who have been left may still be re-instated at a later date with an appropriate funding adjustment - please discuss with your programme administrator as required.</p>
<p><strong>Auditor@Vandango</strong></p>
<p>&nbsp;</p>
<p>&nbsp;</p>',
                    'run_frequency' => 'week',
                    'ran_at' => '2016-05-09 07:05:15',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-03-18 10:42:27',
                    'updated_at' => '2016-05-09 07:05:15',
                    'deleted_at' => NULL,
                ),
                18 => 
                array (
                    'id' => 19,
                    'title' => 'Break in Learning > 365 days, maternity',
                    'description' => 'Break in Learning exceeding 365 days where the reason is maternity',
                    'sql' => 'select
t.ident,
t.firstname,
t.surname,

case when (t.site = \'OM215\' or left(t.site,3) = \'OM5\') then substring(site.descrip,7,25)
else trim(adv.forename)+\' \'+trim(adv.surname) end name,

adv.email as advemail,
mgr.email as mgremail,
susp.suspdate,
curdate() - susp.suspdate as days

from
trainee t
join officer adv on t.main_off = adv.code
left join officer mgr on adv.superior = mgr.code
left join traintex tx on tx.ident = t.ident
left join pcsite site on left(t.site,5) = site.code

join 
(	select trhist.ident,
max(trhist.change) as suspdate
from trhist
group by trhist.ident) susp
on susp.ident = t.ident

where
t.tr_end is null
and t.status in (\'C\',\'L\')
and t.suspended = \'Y\'
and tx.txpick06 = \'00001\' and curdate() - susp.suspdate > 365',
                    'group_by' => NULL,
                    'recipients' => '{advemail},{mgremail},joanne.sartain@totalpeople.co.uk,sheryl.keen@totalpeople.co.uk',
                    'notification' => '<p>Hi {name}</p>
<p><strong>{firstname} {surname}</strong> (ID:{ident}) has been on an agreed break in learning with the reason of Maternity / Paternity which exceeds 365 days. The break commenced on {suspdate} ({days} days ago).</p>
<p>In accordance with our learner absence policy, the learner should now be left as at the last evidence date.</p>
<p>If you take no action, your programme administrator will arrange with you to leave the learner as at the last evidence date in the next few days and you will be required to complete the learner exit and progression review.</p>
<p>If you intend to re-instate the learner you should contact your programme administrator as soon as possible to delay this action but note that you will continue to receive this <em><strong>weekly</strong> </em>reminder until the learner is re-instated or left.</p>
<p>Learners who have been left may still be re-instated at a later date with an appropriate funding adjustment - please discuss with your programme administrator as required.</p>
<p><strong>Auditor@Vandango</strong></p>
<p>&nbsp;</p>',
                    'run_frequency' => 'week',
                    'ran_at' => '2016-05-09 07:05:16',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-03-18 11:17:58',
                    'updated_at' => '2016-05-09 07:05:16',
                    'deleted_at' => NULL,
                ),
                19 => 
                array (
                    'id' => 20,
                    'title' => 'Diagnostic Assessment is missing for English or Maths',
                    'description' => 'Missing English or Maths Diagnostic Assessment result',
                    'sql' => 'select 
sector.descrip as sector,
t.ident,
t.surname,
t.firstname,

case when (t."group"+t.subgrp+pcqual.natlevel) like \'FS%\' then \'Study Programme\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'FT%\' then \'Study Programme Traineeship\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'G%\'  then \'Prospects Plus\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'H%\'  then \'Commercial L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'K%\'  then \'K\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'OA%\' then \'Advanced Apprenticeship L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'OH%\' then \'Higher Apprenticeship L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'OI%\' then \'Intermediate Apprenticeship L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'K%\'  then \'Wigan Schools\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'TW%\' then \'Workplace L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'XT%\' then \'Apprenticeship Trailblazer L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'XV%\' then \'24+ Loan L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'[C%\' then \'Classroom Based L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'[T%\' then \'19+ Traineeship\'
else (\'Not Found \'+t."group"+t.subgrp+pcqual.natlevel) end prg_type,

o.forename as advfname,
o.surname as advsurname,
o.email as advemail,
mgr.email as mgremail,

pq.ba_lit_mr_res as diag_ass_literacy,
case when pq.ba_lit_mr_res is null then \'n\' else \'y\' end diag_lit_recorded,	
pq.ba_num_mr_res as diag_ass_numeracy,
case when pq.ba_num_mr_res is null then \'n\' else \'y\' end diag_num_recorded


from
trainee t
join pcsite sector on left(t.site,5) = sector.code
left join tredu pq on pq.ident = t.ident
left join placemnt sc on sc.place = t.emp_ref
join epidata e on e.ident = t.ident
left join pcqual on pcqual.vqref = e.ini_ref
left join officer o on t.main_off = o.code
left join officer mgr on o.superior = mgr.code 

where 
t.tr_start >= \'2015-08-01\'
and (t.tr_end is null or t.tr_end >= \'2015-08-01\')
and t.status in (\'C\',\'L\')
and t."group" in (\'O\') 
and (t.emp_ref is null or sc.category3 is null or not sc.category3 = \'PROVISION\')
and (t.emp_ref is null or not t.emp_ref = \'SCCAPP\')
and (pq.ba_lit_mr_res is null or pq.ba_num_mr_res is null)


',
                    'group_by' => NULL,
                    'recipients' => '{advemail},{mgremail}',
                    'notification' => '<p>Hi&nbsp;{advfname} {advsurname}</p>
<p><strong>{firstname} {surname}</strong> (id:{ident}) is missing one or both of their English and Maths diagnostic assessment results from their PICS record. They are on an {prg_type} programme.</p>
<p>In accordance with our Initial Assessment policy, the diagnostic assessment should be completed by all Apprentice learners within 6 weeks of their start date.</p>
<p><a href="http://10.2.70.5/intranet-new/procedures/td3-initial-assessment-procedure/">http://10.2.70.5/intranet-new/procedures/td3-initial-assessment-procedure/</a></p>
<p><strong>English Diagnostic Recorded: &nbsp; &nbsp;{diag_lit_recorded} &nbsp;</strong>{diag_ass_literacy}</p>
<p><strong>Maths Diagnostic Recorded: &nbsp; &nbsp; &nbsp;</strong><strong>{diag_num_recorded} &nbsp;</strong>{diag_ass_numeracy}</p>
<p>Please submit the missing diagnostic assessment results to your Programme Administrator as soon as possible.</p>
<p>Thanks</p>
<p><strong>Auditor@Vandango</strong></p>',
                    'run_frequency' => 'month',
                    'ran_at' => '2016-05-01 00:00:56',
                    'category' => 0,
                    'draft' => 0,
                    'created_at' => '2016-03-18 16:48:25',
                    'updated_at' => '2016-05-01 00:00:56',
                    'deleted_at' => NULL,
                ),
                20 => 
                array (
                    'id' => 21,
                    'title' => 'Diagnostic in the wrong box',
                    'description' => 'Diagnostic Assessment has been recorded in the top box rather than the middle one',
                    'sql' => 'select 
t.ident,
t.firstname,
t.surname,
t.site

from
trainee t
left join tredu pq on pq.ident = t.ident


where 
(t.tr_end is null or t.tr_end >= \'2015-08-01\')
and t.status in (\'C\',\'L\')
and t."group" in (\'O\',\'T\',\'[\',\'X\')
and 
(	(pq.ba_lit_res is not null and pq.ba_lit_mr_res is null)
or	(pq.ba_num_res is not null and pq.ba_num_mr_res is null)
or	(pq.ba_ict_res is not null and pq.ba_ict_mr_res is null)
)',
                'group_by' => NULL,
                'recipients' => 'joanne.sartain@totalpeople.co.uk, sheryl.keen@totalpeople.co.uk',
                'notification' => '<p>Hi</p>
<p>Learner {firstname} {surname} (id: {ident}) and sector code {site} has their diagnostic assessment results recorded in the wrong box on PICS.</p>
<p>Thanks</p>
<p>Vandango Reports</p>
<p>&nbsp;</p>',
                'run_frequency' => 'day',
                'ran_at' => '2016-05-09 07:03:34',
                'category' => 0,
                'draft' => 0,
                'created_at' => '2016-03-18 17:25:47',
                'updated_at' => '2016-05-09 07:03:34',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
            'title' => 'Diagnostic Assessment is missing for English or Maths (Study Programme)',
            'description' => 'Missing English or Maths Diagnostic Assessment result (Study Programme)',
                'sql' => 'select 
sector.descrip as sector,
t.ident,
t.surname,
t.firstname,

case when (t."group"+t.subgrp+pcqual.natlevel) like \'FS%\' then \'Study Programme\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'FT%\' then \'Study Programme Traineeship\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'G%\'  then \'Prospects Plus\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'H%\'  then \'Commercial L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'K%\'  then \'K\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'OA%\' then \'Advanced Apprenticeship L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'OH%\' then \'Higher Apprenticeship L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'OI%\' then \'Intermediate Apprenticeship L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'K%\'  then \'Wigan Schools\'
when (t."group"+t.subgrp+pcqual.natlevel) like \'TW%\' then \'Workplace L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'XT%\' then \'Apprenticeship Trailblazer L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'XV%\' then \'24+ Loan L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'[C%\' then \'Classroom Based L\'+pcqual.natlevel
when (t."group"+t.subgrp+pcqual.natlevel) like \'[T%\' then \'19+ Traineeship\'
else (\'Not Found \'+t."group"+t.subgrp+pcqual.natlevel) end prg_type,

o.forename as advfname,
o.surname as advsurname,
o.email as advemail,
mgr.email as mgremail,

pq.ba_lit_mr_res as diag_ass_literacy,
case when pq.ba_lit_mr_res is null then \'n\' else \'y\' end diag_lit_recorded,	
pq.ba_num_mr_res as diag_ass_numeracy,
case when pq.ba_num_mr_res is null then \'n\' else \'y\' end diag_num_recorded


from
trainee t
join pcsite sector on left(t.site,5) = sector.code
left join tredu pq on pq.ident = t.ident
left join placemnt sc on sc.place = t.emp_ref
join epidata e on e.ident = t.ident
left join pcqual on pcqual.vqref = e.ini_ref
left join officer o on t.main_off = o.code
left join officer mgr on o.superior = mgr.code 

where 
t.tr_start >= \'2015-08-01\'
and (t.tr_end is null or t.tr_end >= \'2015-08-01\')
and t.status in (\'C\',\'L\')
and t."group" in (\'F\') --,\'T\',\'[\',\'X\',\'F\')
and (t.emp_ref is null or sc.category3 is null or not sc.category3 = \'PROVISION\')
and (t.emp_ref is null or not t.emp_ref = \'SCCAPP\')
and (pq.ba_lit_mr_res is null or pq.ba_num_mr_res is null)
',
                'group_by' => NULL,
                'recipients' => '{advemail},{mgremail}',
                'notification' => '<p>Hi&nbsp;{advfname} {advsurname}</p>
<p><strong>{firstname} {surname}</strong> (id:{ident}) is missing one or both of their English and Maths diagnostic assessment results from their PICS record. They are on an {prg_type} programme.</p>
<p>In accordance with our Initial Assessment policy, the diagnostic assessment should be completed by all Study Programme learners within 6 weeks of their start date.</p>
<p><a href="http://10.2.70.5/intranet-new/procedures/td3-initial-assessment-procedure/">http://10.2.70.5/intranet-new/procedures/td3-initial-assessment-procedure/</a></p>
<p><strong>English Diagnostic Recorded: &nbsp; &nbsp;{diag_lit_recorded} &nbsp;</strong>{diag_ass_literacy}</p>
<p><strong>Maths Diagnostic Recorded: &nbsp; &nbsp; &nbsp;</strong><strong>{diag_num_recorded} &nbsp;</strong>{diag_ass_numeracy}</p>
<p>Please submit the missing diagnostic assessment results to your Programme Administrator as soon as possible.</p>
<p>Thanks</p>
<p><strong>Auditor@Vandango</strong></p>',
                'run_frequency' => 'week',
                'ran_at' => '2016-05-09 07:05:27',
                'category' => 0,
                'draft' => 0,
                'created_at' => '2016-03-24 09:50:12',
                'updated_at' => '2016-05-09 07:05:27',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'title' => 'Lab Ops not linked to Debbie Brunt',
                'description' => 'Checks where Lab Op aims are not linked to Debbie Brunt as the Second Adviser on PICS',
                'sql' => 'select 
t.ident,
t.main_off

from trainee t
join epidata e on t.ident = e.ident
where
e.ini_ref = \'50118699\'
and t.status in (\'C\',\'L\')
and t.tr_end is null
and e.off_train is null
',
                'group_by' => NULL,
                'recipients' => 'sean.simpson@totalpeople.co.uk, sheryl.hannon@totalpeople.co.uk',
                'notification' => '<p>Hi Sean</p>
<p>Learner with Ident: {ident} is undertaking Lab Ops but doesn\'t have Debbie Brunt (BRUNTDEB) set in the second officer field on PICS.</p>
<p>Could you please update the record?</p>
<p>Thanks</p>
<p>Auditor@VanDango</p>
<p>&nbsp;</p>',
                'run_frequency' => 'week',
                'ran_at' => NULL,
                'category' => 0,
                'draft' => 0,
                'created_at' => '2016-04-21 13:22:20',
                'updated_at' => '2016-04-21 13:23:40',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'title' => 'Vacancies - Missing NAS References',
                'description' => 'Picks up all vacancies where no NAS reference has been added.',
                'sql' => 'select 
pcPlcVac.title as title, 
placemnt.name as employer_name, 
pcPlcVac."close" as closing_date

from pcplcvac

left join placemnt 
on placemnt.place = pcplcvac.place

where JOBREFERENCE is null',
                'group_by' => NULL,
                'recipients' => 'marketing@totalpeople.co.uk',
                'notification' => '<p>Hi there</p>
<p>This is to let you know that the following vacancy on PICS does not have a NAS Reference.&nbsp;</p>
<ul>
<li><strong>Employer:</strong> {employer_name}</li>
<li><strong>Vacancy Title:</strong> {title}</li>
<li><strong>Closing Date:</strong> {closing_date|date:d/m/Y}</li>
</ul>
<p>Please check to see if it has one and update the vacancy on PICS.</p>
<p>Thanks</p>
<p><strong>Audior@VanDango</strong></p>',
                'run_frequency' => 'week',
                'ran_at' => '2016-05-09 07:05:28',
                'category' => 0,
                'draft' => 0,
                'created_at' => '2016-04-27 14:07:13',
                'updated_at' => '2016-05-09 07:05:28',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'title' => 'Vacancies - Closed over 1 month ',
                'description' => 'Notifies all Vacancy Managers of vacancies that closed more than 30 days previously and have a status of \'Open\'.',
                'sql' => 'select 
pcPlcVac.title as vacancy_title, 
pcPlcVac.status,
pcPlcVac."close" as closing_date,
pcPlcVac.jobreference as ref,
placemnt.name as employer_name,
officer.forename as vacancy_manger,
officer.email as vacancy_manger_email

from pcPlcVac

left join placemnt 
on placemnt.place = pcPlcVac.place

join officer
on officer.code = pcPlcVac.officer

where (curdate () - pcPlcVac."close") >= 30
and pcPlcVac.status = \'O\'',
                'group_by' => NULL,
                'recipients' => 'ben.carter@totalpeople.co.uk',
                'notification' => '<p>Hi {vacancy_manger}</p>
<p>PICS shows that you are the vacancy manager for the following vacancy which closed over 30 days ago:</p>
<ul>
<li><strong>Title:</strong> {vacancy_title}</li>
<li><strong>Employer:</strong> {employer_name}</li>
<li><strong>Closing Date:</strong> {closing_date|date:d/m/Y}</li>
</ul>
<p>If there is an update to this vacancy please contact the Marketing Team using the link below.</p>
<p><a href="mailto:marketing@totalpeople.co.uk?subject=Vacancy Update&amp;body=NAS Ref: {ref}%0AEmployer: {employer_name}%0AClosing Date: {closing_date|date:d/m/Y}">Update Vacancy</a></p>
<p>You will receive this email weekly until the vacancy has been completed (successfully/unsuccessfully).&nbsp;</p>
<p>Thanks</p>
<p><strong>Auditor@VanDango</strong>&nbsp;</p>',
                'run_frequency' => 'week',
                'ran_at' => '2016-04-27 16:09:01',
                'category' => 0,
                'draft' => 0,
                'created_at' => '2016-04-27 15:38:36',
                'updated_at' => '2016-04-28 07:38:03',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}
