<?php

return [
    // Core
    'site' => 'VanDango',
    'creator' => 'Total People',
    'email' => 'vandango@totalpeople.co.uk',
    'superAdminEmail' => 'ben.carter@totalpeople.co.uk',
    'superAdminName' => 'Ben Carter',

    'api' => [
        'external' => [
            'uri' => env('VANDANGO_API_EXTERNAL_URI'),
        ],
    ],

    'emails' => [
        'das' => env('TP_DAS_EMAIL'),
        'novus' => env('NOVUS_EMAIL'),
        'programmeAdmin' => env('TP_PROGRAMME_ADMIN'),
    ],

    'qualificationLevels' => [
        'Entry 1',
        'Entry 2',
        'Entry 3',
        'Level 1',
        'Level 2',
        'Level 3',
        'Level 4',
        'Level 5',
        'Level 7',
    ],

    // Apply
    'apply' => [
        'withdrawals' => [
            'duplicate' => 'Duplicate',
        ],
    ],

    // Ava
    'ava' => [
        'uri' => env('AVA_API_URI'),
        'apiKey' => env('AVA_API_KEY'),
        'disk' => env('AVA_DISK'),
    ],

    // Blink
    'blink' => [
        'admin' => [
            'email' => env('BLINK_ADMIN_EMAIL', 'marketing@totalpeople.co.uk'),
            'notificationDelay' => 15,
        ],
        'endpoints' => [
            'contacts' => [
                'index' => env('APP_API_URI') . '/blink/contacts/',
            ],
            'enquiries' => [
                'index' => env('APP_API_URI') . '/blink/enquiries/',
            ],
            'opportunities' => [
                'index' => env('APP_API_URI') . '/blink/opportunities/',
            ],
            'organisations' => [
                'index' => env('APP_API_URI') . '/blink/organisations/',
            ],
            'vacancies' => [
                'index' => env('APP_API_URI') . '/blink/vacancies/',
            ],
        ],
        'enquiries' => [
            'pending' => 'Stage 1 - Unassigned',
            'unqualified' => 'Stage 2 - Unqualified',
            'export-uri' => env('AVA_ENQUIRIES_URI', null),
        ],
        'nmw' => 3.5,
        'pagination' => 25,
        'roles' => [
            'approver' => 'Enquiries',
        ],
        'statuses' => [
            'pending' => 'Stage 1 - Unassigned',
            'unqualified' => 'Stage 2 - Unqualified',
            'qualified' => 'Stage 3 - Qualified',
            'completed' => 'Stage 8 - Completed',
            'vacancy-saved' => 'Draft',
            'vacancy-pending' => 'Pending Approval',
            'vacancy-approved' => 'Vacancy Approved',
            'vacancy-rejected' => 'Vacancy Rejected',
            'vacancy-live' => 'Vacancy Live',
            'vacancy-closed' => 'Vacancy Closed',
        ],
        'vacancies' => [
            'email' => 'vacancies@totalpeople.co.uk',
            'import-uri' => env('AVA_VACANCIES_URI', null),
            'pendingApprovalStatusId' => 12,
        ],
    ],

    'eportfolios' => [
        'email' => 'ilt@totalpeople.co.uk',
        'onefile' => [
            'base-url' => env('ONEFILE_BASE_URL'),
            'customer-token' => env('ONEFILE_CUSTOMER_TOKEN'),
            'customer-id' => env('ONEFILE_CUSTOMER_ID'),
            'default-classroom' => env('ONEFILE_DEFAULT_CLASSROOM'),
            'default-placement' => env('ONEFILE_DEFAULT_PLACEMENT'),
            'induction-id' => env('ONEFILE_INDUCTION_STANDARD_ID'),
        ],
    ],

    'helpdesk' => [
        'programmeAdmin' => 'pahelpdesk@totalpeople.co.uk',
    ],

    //Judi
    /**
     * @deprecated
     * Use the multi dimensional array below
     */
    'judiAdminName' => 'Sue Wrigglesworth',
    'judiAdminEmail' => 'sue.wrigglesworth@totalpeople.co.uk',
    'judiAdminSlug' => 'judiAdmin',
    'judiPaRoleName' => 'Performance Assessor',

    'judi' => [
        'assessments' => [
            'leadTime' => 6, // Number of months assessments should be generated before
        ],
        'admin' => [
            'name' => 'Sue Wrigglesworth',
            'email' => 'sue.wrigglesworth@totalpeople.co.uk',
            'slug' => 'judiAdmin',
            'team' => [
                'name' => 'Learning & Development',
            ],
        ],
        'criteria' => [
            'contentGradeName' => 'Content grade',
        ],
        'departments' => [
            'learningDevelopment' => 88,
        ],
        'disk' => env('JUDI_DISK', 'local'),
        'grades' => [
            'failed' => [3, 4],
            'insufficientEvidence' => [
                'name' => 'Insufficient Evidence',
            ],
        ],
        'paths' => [
            'summaries' => '/judi/assessments/',
        ],
        'processes' => [
            'excludedForProbation' => ['Health & Safety'],
            'progressReviewDesktopName' => 'Progress Review Desktop',
            'progressReviewIds' => [3, 10],
        ],
        'roles' => [
            'pa' => 'Performance Assessor',
        ],
        'summaries' => [
            'outcomeTrigger' => 'Training Required (L&D)',
        ],
    ],

    // NAS
    'nas' => [
        'api' => [
            'vacancy-management' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyManagement/VacancyManagement51.svc',
            'reference-data' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/ReferenceData/ReferenceData51.svc',
            'vacancy-details' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyDetails/VacancyDetails51.svc',
            'vacancy-summary' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancySummary/VacancySummary51.svc',
        ],
        'wsdl' => [
            'vacancy-management' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyManagement/VacancyManagement51.svc?WSDL',
            'reference-data' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/ReferenceData/ReferenceData51.svc?WSDL',
            'vacancy-details' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancyDetails/VacancyDetails51.svc?WSDL',
            'vacancy-summary' => 'https://soapapi.findapprenticeship.service.gov.uk/Services/VacancySummary/VacancySummary51.svc?WSDL',
        ],
        'mailingList' => [
            'PPritchard@novus.ac.uk',
            'MFlores@novus.ac.uk',
            'RFoye@novus.ac.uk',
            'JimT@novus.ac.uk',
            'Julie.Probert@hmps.gsi.gov.uk',
            'Julie.Cliffe2@hmps.gsi.gov.uk',
            'NMorgan@novus.ac.uk',
            'DFairhurst@novus.ac.uk',
            'LHigginbotham@novus.ac.uk',
            'julie.podesta@totalpeople.co.uk',
        ],
    ],

    // Papi
    'papiUrl' => "http://10.2.70.11/papi/public/api/v2/query",
    'papi' => [
        'base' => 'http://10.2.70.11/papi/public/api',
        'v2' => 'http://10.2.70.11/papi/public/api/v2/query',
        'v3' => 'http://10.2.70.11/papi/public/api/v3/query',
        'v4' => 'http://10.2.70.11/papi/public/api/v4/query',
    ],

    // PICS REST API
    'pics' => [
        'username' => env('TP_PICS_API_USERNAME'),
        'password' => env('TP_PICS_API_PASSWORD'),
        'api' => [
            'uri' => env('TP_PICS_API_BASE_URI'),
            'login' => env('TP_PICS_API_BASE_URI') . 'System/Login',
            'applicants' => env('TP_PICS_API_BASE_URI') . 'Applicants',
            'employers' => env('TP_PICS_API_BASE_URI') . 'Employers',
            'learners' => env('TP_PICS_API_BASE_URI') . 'Trainees',
        ],
    ],

    // Suggestion Box
    'suggestion-box' => [
        'url' => env('TP_SUGGESTION_BOX_URL'),
    ],

    // UserManager
    'usermanager' => [
        'departments' => [
            'directors' => [
                'name' => 'SMT',
            ],
            'manager' => [
                'name' => 'Department Manager',
            ],
        ],
    ],
];
