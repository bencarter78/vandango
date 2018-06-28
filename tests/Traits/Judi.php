<?php

namespace Tests\Traits;

use Carbon\Carbon;
use App\Judi\Models\User;
use App\Judi\Models\Grade;
use App\Judi\Models\Report;
use App\Judi\Models\Process;
use App\Judi\Models\Summary;
use App\Judi\Models\Criteria;
use App\Judi\Models\Assessment;
use App\UserManager\Users\UserMeta;

trait Judi
{
    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function assessments($count = 1, $atts = [])
    {
        return $this->create(Assessment::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function grades($count = 1, $atts = [])
    {
        return $this->create(Grade::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function processes($count = 1, $atts = [])
    {
        return $this->create(Process::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function summaries($count = 1, $atts = [])
    {
        return $this->create(Summary::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function criteria($count = 5, $atts = [])
    {
        return $this->create(Criteria::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function reports($count = 5, $atts = [])
    {
        return $this->create(Report::class, $count, $atts);
    }

    /**
     * @param $manager
     * @param $sector
     * @return mixed
     */
    public function sectorSummaries($manager, $sector)
    {
        $grade = $this->grades();
        $grade->unguard();
        $grade->update(['id' => 3]);

        return $this->users([
            'departments' => $manager->departments->pluck('id')->all(),
            'sectors' => $sector->id,
        ], 5)->each(function ($user) use ($sector, $grade) {

            $assessment = $this->assessments(1, [
                'user_id' => $user->id,
                'sector_id' => $sector->id,
                'deleted_at' => Carbon::now(),
            ]);

            $this->summaries(1, [
                'assessment_id' => $assessment->id,
                'grade_id' => $grade->id,
                'deleted_at' => Carbon::now(),
            ]);
        });
    }

    /**
     * @param array $memberships
     * @return mixed
     */
    public function user($memberships = [])
    {
        $user = factory(User::class)->create();
        $user->meta()->save(factory(UserMeta::class)->make());

        foreach ($memberships as $k => $v) {
            $user->{$k}()->attach($v);
        }

        return $user;
    }

    /**
     * @param     $memberships
     * @param int $count
     * @return mixed
     */
    public function users($memberships, $count = 1)
    {
        for ($i = 0; $i < $count; $i++) {
            $users[] = $this->user($memberships);
        }

        return collect($users);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function pa($count = 1, $atts = [])
    {
        $users = collect();

        for ($i = 0; $i < $count; $i++) {
            $user = factory(User::class)->create();
            $user->meta()->save(factory(UserMeta::class)->make());
            $role = $this->roles(1, ['job_role' => 'Performance Assessor']);
            $atts['roles'][] = $role->id;

            foreach ($atts as $k => $v) {
                $user->{$k}()->attach($v);
            }

            $users->push($user);
        }

        if ($count == 1) {
            return $users->first();
        }

        return $users;
    }

}