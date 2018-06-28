<?php

namespace Tests\Unit\Apply\Models;

use Carbon\Carbon;
use Tests\TestCase;
use App\Apply\Models\ContractYear;

/**
 * @group apply
 */
class ContractYearTest extends TestCase
{
    /** @test */
    public function it_returns_the_contract_year_from_a_given_past_date()
    {
        $contractYear = new ContractYear(Carbon::parse('3rd January 1999'));

        $this->assertEquals($contractYear->dateRange(), collect([
            Carbon::parse('1st August 1998'),
            Carbon::parse('31st July 1999')->endOfDay(),
        ]));
    }

    /** @test */
    public function it_returns_the_contract_year_from_a_given_future_date()
    {
        $contractYear = new ContractYear(Carbon::parse('2nd December 2020'));

        $this->assertEquals($contractYear->dateRange(), collect([
            Carbon::parse('1st August 2020'),
            Carbon::parse('31st July 2021')->endOfDay(),
        ]));
    }

    /** @test */
    public function it_returns_all_the_current_years_periods()
    {
        $date = Carbon::parse('1st August 2017');

        $contractYear = new ContractYear($date);

        $dates = collect([
            ['period' => 1, 'start' => $date->copy(), 'end' => $date->copy()->endOfMonth()],
            ['period' => 2, 'start' => $date->copy()->addMonth(), 'end' => $date->copy()->addMonth()->endOfMonth()],
            ['period' => 3, 'start' => $date->copy()->addMonths(2), 'end' => $date->copy()->addMonths(2)->endOfMonth()],
            ['period' => 4, 'start' => $date->copy()->addMonths(3), 'end' => $date->copy()->addMonths(3)->endOfMonth()],
            ['period' => 5, 'start' => $date->copy()->addMonths(4), 'end' => $date->copy()->addMonths(4)->endOfMonth()],
            ['period' => 6, 'start' => $date->copy()->addMonths(5), 'end' => $date->copy()->addMonths(5)->endOfMonth()],
            ['period' => 7, 'start' => $date->copy()->addMonths(6), 'end' => $date->copy()->addMonths(6)->endOfMonth()],
            ['period' => 8, 'start' => $date->copy()->addMonths(7), 'end' => $date->copy()->addMonths(7)->endOfMonth()],
            ['period' => 9, 'start' => $date->copy()->addMonths(8), 'end' => $date->copy()->addMonths(8)->endOfMonth()],
            ['period' => 10, 'start' => $date->copy()->addMonths(9), 'end' => $date->copy()->addMonths(9)->endOfMonth()],
            ['period' => 11, 'start' => $date->copy()->addMonths(10), 'end' => $date->copy()->addMonths(10)->endOfMonth()],
            ['period' => 12, 'start' => $date->copy()->addMonths(11), 'end' => $date->copy()->addMonths(11)->endOfMonth()],
        ]);

        $this->assertEquals($contractYear->periods(), $dates);
    }

    /** @test */
    public function it_returns_the_start_and_end_date_of_the_contract_year()
    {
        $contactYear = new ContractYear();
        $this->assertEquals('08-01', $contactYear->getYearStart()->format('m-d'));
        $this->assertEquals('07-31', $contactYear->getYearEnd()->format('m-d'));
    }
}