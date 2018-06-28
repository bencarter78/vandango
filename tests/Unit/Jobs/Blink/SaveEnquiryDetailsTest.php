<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use App\Jobs\Blink\SaveContact;
use App\Jobs\Blink\SaveEnquiry;
use App\Jobs\Blink\SaveActivity;
use App\Jobs\Blink\SaveOrganisation;
use App\Events\Blink\EnquiryWasAdded;
use App\Jobs\Blink\SaveEnquiryDetails;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group blink
 */
class SaveEnquiryDetailsTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->dbSetUp();
    }

    /** @test */
    public function it_dispatches_jobs_for_an_enquiry_to_be_saved()
    {
        $this->expectsJobs([
            SaveOrganisation::class,
            SaveContact::class,
            SaveEnquiry::class,
            SaveActivity::class,
        ]);

        $this->expectsEvents(EnquiryWasAdded::class);

        $job = new SaveEnquiryDetails([
            'organisation_location' => 'UK',
            'contact_tel' => '01234567890',
            'contact_email' => 'test@email.com',
            'search' => ['contact_id' => 'Test McTest', 'organisation_id' => 'ABC Ltd'],
        ], null);
        $job->handle();
    }
}
