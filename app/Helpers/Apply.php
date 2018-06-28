<?php

if ( ! function_exists('countSectorPipelineInYear')) {
    function countSectorPipelineInYear($data, $sectorId)
    {
        return $data->map(function ($period) use ($sectorId) {
            return $period->filter(function ($applicant) use ($sectorId) {
                return $applicant->sector_id == $sectorId;
            })->count();
        })->sum();
    }
}

if ( ! function_exists('countSectorStartsInYear')) {
    function countSectorStartsInYear($data, $sectorId)
    {
        return $data->map(function ($period) use ($sectorId) {
            return $period->filter(function ($applicant) use ($sectorId) {
                return $applicant->sector_id == $sectorId;
            })->filter->hasStarted()->count();
        })->sum();
    }
}

if ( ! function_exists('programmeTypes')) {
    function programmeTypes()
    {
        return [
            'Study Programme' => 'Study Programme',
            'Traineeship' => 'Traineeship',
            'Standard' => 'Standard',
            'Framework' => 'Framework',
            'ESF' => 'ESF',
            'Advanced Learner Loan' => 'Advanced Learner Loan',
            'Adult Education Budget (Classroom/WBL)' => 'Adult Education Budget (Classroom/WBL)',
            'Commercial' => 'Commercial',
        ];
    }
}

if ( ! function_exists('employedProgrammeTypes')) {
    function employedProgrammeTypes()
    {
        return [
            'Standard' => 'Standard',
            'Framework' => 'Framework',
            'ESF' => 'ESF',
            'Advanced Learner Loan' => 'Advanced Learner Loan',
            'Adult Education Budget (Classroom/WBL)' => 'Adult Education Budget (Classroom/WBL)',
            'Commercial' => 'Commercial',
        ];
    }
}

if ( ! function_exists('unemployedProgrammeTypes')) {
    function unemployedProgrammeTypes()
    {
        return [
            'Study Programme' => 'Study Programme',
            'Traineeship' => 'Traineeship',
            'ESF' => 'ESF',
        ];
    }
}

if ( ! function_exists('programmeGroups')) {
    function programmeGroups()
    {
        return [
            'Study Programme & Traineeship' => ['Study Programme', 'Traineeship'],
            'Standard & Framework' => ['Standard', 'Framework'],
            'Study Programme' => ['Study Programme'],
            'Traineeship' => ['Traineeship'],
            'Standard' => ['Standard'],
            'Framework' => ['Framework'],
            'ESF' => ['ESF'],
            'Advanced Learner Loan' => ['Advanced Learner Loan'],
            'Adult Education Budget (Classroom/WBL)' => ['Adult Education Budget (Classroom/WBL)'],
            'Commercial' => ['Commercial'],
        ];
    }
}