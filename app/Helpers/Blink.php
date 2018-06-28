<?php

if ( ! function_exists('calculateRemainingOpportunities')) {
    function calculateRemainingOpportunities($data)
    {
        $namedStarts = $data
            ->flatMap(function ($opportunity) {
                return $opportunity->enquiry->applicants->filter(function ($applicant) use ($opportunity) {
                    return $applicant->sector_id === $opportunity->sector_id;
                });
            })
            ->reject(function ($opportunity) {
                return $opportunity->count() === 0;
            });

        $total = $data->sum->quantity - $namedStarts->count();

        return $total > 0 ? $total : '';
    }
}

if ( ! function_exists('calculateRemainingOpportunitiesInPeriod')) {
    function calculateRemainingOpportunitiesInPeriod($data)
    {
        $namedStarts = $data
            ->flatMap(function ($opportunity) {
                return $opportunity->enquiry->applicants;
            })
            ->reject(function ($opportunity) {
                return $opportunity->count() === 0;
            });

        $total = $data->sum->quantity - $namedStarts->count();

        return $total > 0 ? $total : '';
    }
}

if ( ! function_exists('calculateRemainingSectorOpportunitiesInYear')) {
    function calculateRemainingSectorOpportunitiesInYear($data, $sectorId)
    {
        $opportunities = $data->flatMap(function ($period) use ($sectorId) {
            return $period->filter(function ($opportunity) use ($sectorId) {
                return $opportunity->sector_id === $sectorId;
            });
        });

        $namedStarts = $opportunities
            ->flatMap(function ($opportunity) {
                return $opportunity->enquiry->applicants->filter(function ($applicant) use ($opportunity) {
                    return $applicant->sector_id === $opportunity->sector_id;
                });
            })
            ->reject(function ($opportunity) {
                return $opportunity->count() === 0;
            });

        return $opportunities->sum->quantity - $namedStarts->count();
    }
}

if ( ! function_exists('calculateRemainingOpportunitiesInYear')) {
    function calculateRemainingOpportunitiesInYear($data)
    {
        $namedStarts = $data
            ->flatMap(function ($opportunity) {
                return $opportunity->enquiry->applicants->filter(function ($applicant) use ($opportunity) {
                    return $applicant->sector_id === $opportunity->sector_id;
                });
            })
            ->reject(function ($opportunity) {
                return $opportunity->count() === 0;
            });

        return $data->sum->quantity - $namedStarts->count();
    }
}

if ( ! function_exists('enquiryNamedStartsBySector')) {
    function enquiryNamedStartsBySector($enquiry, $sectorId)
    {
        return $enquiry->applicants->filter(function ($applicant) use ($sectorId) {
            return $applicant->sector_id === $sectorId;
        });
    }
}

if ( ! function_exists('repopulateAutocomplete')) {
    function repopulateAutocomplete($old, $model)
    {
        return $old != '' ? $old : $model;
    }
}
