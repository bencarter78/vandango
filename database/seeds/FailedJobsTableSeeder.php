<?php

use Illuminate\Database\Seeder;

class FailedJobsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('failed_jobs')->delete();
        
        \DB::table('failed_jobs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'connection' => 'beanstalkd',
                'queue' => 'default',
                'payload' => '{"job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","data":{"command":"O:44:\\"App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\":9:{s:50:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000task\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":2:{s:5:\\"class\\";s:22:\\"App\\\\Auditor\\\\Tasks\\\\Task\\";s:2:\\"id\\";i:16;}s:10:\\"\\u0000*\\u0000message\\";N;s:13:\\"\\u0000*\\u0000recipients\\";a:0:{}s:54:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000picsData\\";O:8:\\"stdClass\\":1:{s:14:\\"all_frameworks\\";s:5:\\"16004\\";}s:52:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000parser\\";O:26:\\"App\\\\Services\\\\MessageParser\\":1:{s:35:\\"\\u0000App\\\\Services\\\\MessageParser\\u0000message\\";N;}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:5:\\"delay\\";N;s:6:\\"\\u0000*\\u0000job\\";N;}"}}',
                'failed_at' => '2016-05-06 15:14:18',
            ),
            1 => 
            array (
                'id' => 2,
                'connection' => 'beanstalkd',
                'queue' => 'default',
                'payload' => '{"job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","data":{"command":"O:44:\\"App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\":9:{s:50:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000task\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":2:{s:5:\\"class\\";s:22:\\"App\\\\Auditor\\\\Tasks\\\\Task\\";s:2:\\"id\\";i:16;}s:10:\\"\\u0000*\\u0000message\\";N;s:13:\\"\\u0000*\\u0000recipients\\";a:0:{}s:54:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000picsData\\";O:8:\\"stdClass\\":1:{s:14:\\"all_frameworks\\";s:5:\\"16004\\";}s:52:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000parser\\";O:26:\\"App\\\\Services\\\\MessageParser\\":1:{s:35:\\"\\u0000App\\\\Services\\\\MessageParser\\u0000message\\";N;}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:5:\\"delay\\";N;s:6:\\"\\u0000*\\u0000job\\";N;}"}}',
                'failed_at' => '2016-05-06 15:16:34',
            ),
            2 => 
            array (
                'id' => 3,
                'connection' => 'beanstalkd',
                'queue' => 'default',
                'payload' => '{"job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","data":{"command":"O:44:\\"App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\":9:{s:50:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000task\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":2:{s:5:\\"class\\";s:22:\\"App\\\\Auditor\\\\Tasks\\\\Task\\";s:2:\\"id\\";i:16;}s:10:\\"\\u0000*\\u0000message\\";N;s:13:\\"\\u0000*\\u0000recipients\\";a:0:{}s:54:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000picsData\\";O:8:\\"stdClass\\":1:{s:14:\\"all_frameworks\\";s:5:\\"16004\\";}s:52:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000parser\\";O:26:\\"App\\\\Services\\\\MessageParser\\":1:{s:35:\\"\\u0000App\\\\Services\\\\MessageParser\\u0000message\\";N;}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:5:\\"delay\\";N;s:6:\\"\\u0000*\\u0000job\\";N;}"}}',
                'failed_at' => '2016-05-06 15:16:51',
            ),
            3 => 
            array (
                'id' => 4,
                'connection' => 'beanstalkd',
                'queue' => 'default',
                'payload' => '{"job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","data":{"command":"O:44:\\"App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\":9:{s:50:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000task\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":2:{s:5:\\"class\\";s:22:\\"App\\\\Auditor\\\\Tasks\\\\Task\\";s:2:\\"id\\";i:16;}s:10:\\"\\u0000*\\u0000message\\";N;s:13:\\"\\u0000*\\u0000recipients\\";a:0:{}s:54:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000picsData\\";O:8:\\"stdClass\\":1:{s:14:\\"all_frameworks\\";s:5:\\"16004\\";}s:52:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000parser\\";O:26:\\"App\\\\Services\\\\MessageParser\\":1:{s:35:\\"\\u0000App\\\\Services\\\\MessageParser\\u0000message\\";N;}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:5:\\"delay\\";N;s:6:\\"\\u0000*\\u0000job\\";N;}"}}',
                'failed_at' => '2016-05-06 15:17:37',
            ),
            4 => 
            array (
                'id' => 5,
                'connection' => 'beanstalkd',
                'queue' => 'default',
                'payload' => '{"job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","data":{"command":"O:44:\\"App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\":9:{s:50:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000task\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":2:{s:5:\\"class\\";s:22:\\"App\\\\Auditor\\\\Tasks\\\\Task\\";s:2:\\"id\\";i:16;}s:10:\\"\\u0000*\\u0000message\\";N;s:13:\\"\\u0000*\\u0000recipients\\";a:0:{}s:54:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000picsData\\";O:8:\\"stdClass\\":1:{s:14:\\"all_frameworks\\";s:5:\\"16004\\";}s:52:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000parser\\";O:26:\\"App\\\\Services\\\\MessageParser\\":1:{s:35:\\"\\u0000App\\\\Services\\\\MessageParser\\u0000message\\";N;}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:5:\\"delay\\";N;s:6:\\"\\u0000*\\u0000job\\";N;}"}}',
                'failed_at' => '2016-05-06 15:17:57',
            ),
            5 => 
            array (
                'id' => 6,
                'connection' => 'beanstalkd',
                'queue' => 'default',
                'payload' => '{"job":"Illuminate\\\\Queue\\\\CallQueuedHandler@call","data":{"command":"O:44:\\"App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\":9:{s:50:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000task\\";O:45:\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\":2:{s:5:\\"class\\";s:22:\\"App\\\\Auditor\\\\Tasks\\\\Task\\";s:2:\\"id\\";i:16;}s:10:\\"\\u0000*\\u0000message\\";N;s:13:\\"\\u0000*\\u0000recipients\\";a:0:{}s:54:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000picsData\\";O:8:\\"stdClass\\":1:{s:14:\\"all_frameworks\\";s:5:\\"16004\\";}s:52:\\"\\u0000App\\\\Jobs\\\\Auditor\\\\SendAuditResultNotification\\u0000parser\\";O:26:\\"App\\\\Services\\\\MessageParser\\":1:{s:35:\\"\\u0000App\\\\Services\\\\MessageParser\\u0000message\\";N;}s:10:\\"connection\\";N;s:5:\\"queue\\";N;s:5:\\"delay\\";N;s:6:\\"\\u0000*\\u0000job\\";N;}"}}',
                'failed_at' => '2016-05-06 15:18:10',
            ),
        ));
        
        
    }
}
