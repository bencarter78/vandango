<?php

namespace Tests\Unit\Jobs\UserManager\Users;

use Tests\TestCase;
use App\UserManager\Users\UserMeta;

/**
 * @group usermanager
 */
class UserMetaPresenterTest extends TestCase
{
    /** @test */
    public function it_returns_a_formatted_tel()
    {
        $meta = new UserMeta;
        $meta->tel = '01606734000';
        $meta->mobile = '01606734000';
        $this->assertEquals('01606 734000', $meta->present()->formatTel);
        $this->assertEquals('01606 734000', $meta->present()->formatMobile);
    }

    /** @test */
    public function it_returns_a_formatted_probation_end_date()
    {
        $meta = new UserMeta;
        $meta->probation_end_date = date('Y-m-d');
        $this->assertEquals('<span class="badge badge-warning"><small>Probation</small></span>', $meta->present()->onProbation);
    }

}
