<?php

use App\Judi\Models\Grade;
use App\Judi\Repositories\RoleRepository;
use App\Judi\Repositories\GradeRepository;
use App\Judi\Repositories\CriteriaRepository;

if ( ! function_exists('isPaRole')) {
    function isPaRole($roleId)
    {
        $roles = app(RoleRepository::class)->getPaRoles();

        if (in_array($roleId, $roles->pluck('id'))) {
            return true;
        }
    }
}

if ( ! function_exists('getCriteriaOrder')) {
    function getCriteriaOrder($criteriaId, $report)
    {
        if (in_array($criteriaId, $report->criteria()->pluck('criteria_id')->all())) {
            foreach ($report->criteria as $criteria) {
                if ($criteria->pivot->criteria_id == $criteriaId) {
                    return $criteria->pivot->order;
                }
            }
        }
    }
}

if ( ! function_exists('gradeConverter')) {
    function gradeConverter($score)
    {
        $grade = Grade::withTrashed()->find($score);
        if ($grade) {
            return $grade->name;
        }

        return 'N/A';
    }
}

if ( ! function_exists('gradeConvertToStars')) {
    function gradeConvertToStars($grade)
    {
        $icon = "<i class='fa fa-star text-warning fa-2x'></i>";

        if ($grade == 'Outstanding') {
            return $icon . $icon . $icon . $icon . $icon;
        }

        if ($grade == 'Good') {
            return $icon . $icon . $icon . $icon;
        }

        if ($grade == 'Requires Improvement') {
            return $icon . $icon;
        }

        if ($grade == 'Inadequate') {
            return $icon;
        }
    }
}

if ( ! function_exists('getCriteriaName')) {
    function getCriteriaName($criteria)
    {
        $id = explode('_', $criteria);
        $repo = app(CriteriaRepository::class);
        $criteria = $repo->getById($id[1]);

        return $criteria->name;
    }
}

if ( ! function_exists('getJudiAdminEmail')) {
    function getJudiAdminEmail()
    {
        return Config::get('vandango.judiAdminEmail');
    }
}

if ( ! function_exists('getProcessTypes')) {
    function getProcessTypes()
    {
        return [
            'individual' => 'Individual',
            'instruction' => 'Instruction',
        ];
    }
}

if ( ! function_exists('getAssessmentProcessType')) {
    function getAssessmentProcessType($settings, $processId)
    {
        if ($settings) {
            foreach (json_decode($settings->settings) as $key => $value) {
                if ($processId == $key) {
                    return "<span class='label label-info'>" . ucwords($value) . "</span>";
                }
            }
        }
    }
}