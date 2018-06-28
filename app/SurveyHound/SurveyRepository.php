<?php
namespace App\SurveyHound;

use App\Core\BaseRepository;

class SurveyRepository extends BaseRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * SurveyRepository constructor.
     *
     * @param $model
     */
    public function __construct(Survey $model)
    {
        $this->model = $model;
    }

    /**
     * @param $frequency
     * @return mixed
     */
    public function getByFrequency($frequency)
    {
        return $this->model->whereFrequency($frequency)->get();
    }

}