<?php

namespace Tests\Unit\Jobs\Blink;

use Tests\TestCase;
use App\Blink\Models\Contact;
use App\Blink\Models\Enquiry;
use App\Jobs\Blink\SaveEnquiry;
use App\Blink\Repositories\Enquiries;

/**
 * @group blink
 */
class SaveEnquiryTest extends TestCase
{
    public function contact()
    {
        $contact = $this->mock(Contact::class);
        $contact->shouldReceive('getAttribute')->with('id')->once();

        return $contact;
    }

    /** @test */
    public function it_returns_a_new_enquiry()
    {
        $repo = $this->mock(Enquiries::class);

        $repo->shouldReceive('add')->once()->andReturn(new Enquiry);

        $job = new SaveEnquiry([
            'contact' => $this->contact(),
            'location' => 'Testville',
            'referrer_id' => 1,
        ]);

        $this->assertInstanceOf(Enquiry::class, $job->handle($repo));
    }

    /** @test */
    public function it_returns_an_updated_enquiry()
    {
        $repo = $this->mock(Enquiries::class);
        $repo->shouldReceive('requireById')->once()->andReturn(new Enquiry);

        $job = new SaveEnquiry([
            'enquiry_id' => 1,
            'contact' => $this->contact(),
            'location' => 'Testville',
            'referrer_id' => 1,
        ]);
        $this->assertInstanceOf(Enquiry::class, $job->handle($repo));
    }
}
