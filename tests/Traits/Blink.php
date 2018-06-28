<?php

namespace Tests\Traits;

use App\Blink\Models\Contact;
use App\Blink\Models\Enquiry;
use App\Blink\Models\Organisation;
use App\Blink\Models\Status;

trait Blink
{
    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function contacts($count = 1, $atts = [])
    {
        return $this->create(Contact::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function organisations($count = 1, $atts = [])
    {
        return $this->create(Organisation::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function enquiries($count = 1, $atts = [])
    {
        return $this->create(Enquiry::class, $count, $atts);
    }

    /**
     * @param int   $count
     * @param array $atts
     * @return mixed
     */
    public function statuses($count = 1, $atts = [])
    {
        return $this->create(Status::class, $count, $atts);
    }
}