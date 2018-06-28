<?php

namespace App\Blink\Summary;

abstract class Summary
{
    /**
     * @var
     */
    protected $enquiries;

    /**
     * @param $data
     * @return array
     */
    public function summarise($data)
    {
        return $data->map(function ($model) {
            $data = $this->filterEnquiries($model);
            $opportunities = $this->filterBy('opportunities', $data);

            return [
                'model' => $model,
                'enquiries' => $data,
                'opportunities' => $opportunities->sum->quantity,
                'projectedIncome' => $opportunities->sum->value,
                'vacancies' => $this->filterBy('vacancies', $data),
                'applicants' => $this->filterBy('applicants', $data),
            ];
        });
    }

    /**
     * @param $type
     * @param $data
     * @return mixed
     */
    public function filterBy($type, $data)
    {
        return $data->map->$type->filter(function ($e) {
            return ! is_null($e);
        })->flatten();
    }

    /**
     * @param $model
     * @return mixed
     */
    public function filterEnquiries($model)
    {
        return $this->enquiries
            ->map(function ($e) use ($model) {
                if ($e->owners->count() > 0 && $this->isMatch($e, $model)) {
                    return $e;
                }
            })
            ->reject(function ($e) {
                return is_null($e);
            })
            ->values();
    }

    /**
     * @param $enquiries
     * @return $this
     */
    public function setEnquiries($enquiries)
    {
        $this->enquiries = $enquiries;

        return $this;
    }
}