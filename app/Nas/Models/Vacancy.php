<?php

namespace App\Nas\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    /**
     * @var string
     */
    protected $table = 'nas_vacancies';

    /**
     * @var array
     */
    protected $fillable = [
        'ApprenticeshipFramework',
        'ClosingDate',
//        'CreatedDateTime',
        'EmployerName',
        'LearningProviderName',
        'NumberOfPositions',
        'ShortDescription',
        'VacancyAddress',
        'VacancyLocationType',
        'VacancyReference',
        'VacancyTitle',
        'VacancyType',
        'VacancyUrl',
        'ContactPerson',
        'ContractOwner',
        'DeliveryOrganisation',
        'EmployerDescription',
        'EmployerWebsite',
        'ExpectedDuration',
        'FullDescription',
        'FutureProspects',
        'InterviewFromDate',
        'IsDisplayRecruitmentAgency',
        'IsSmallEmployerWageIncentive',
        'LearningProviderDesc',
        'LearningProviderSectorPassRate',
        'OtherImportantInformation',
        'PersonalQualities',
        'PossibleStartDate',
        'QualificationRequired',
        'SkillsRequired',
        'SupplementaryQuestion1',
        'SupplementaryQuestion2',
        'TrainingToBeProvided',
        'VacancyManager',
        'VacancyOwner',
        'Wage',
        'WageText',
        'WageType',
        'WorkingWeek',
    ];
}
