<?php

namespace App\Http\Controllers\Api\V1\Blink;

use App\Blink\Models\Enquiry;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EnquirySearchController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $enquiries = Enquiry::with('contact.organisation', 'opportunities', 'currentOwner', 'statuses', 'vacancies.hires')
                            ->whereNull('deleted_at')
                            ->where(function ($q) {
                                $q->whereHas('contact', function ($q) {
                                    $q->where(DB::raw("CONCAT(first_name, ' ', surname)"), 'LIKE', '%' . request('q') . '%');
                                });
                                $q->orWhereHas('contact.organisation', function ($q) {
                                    $q->where('name', 'LIKE', '%' . request('q') . '%');
                                });
                                $q->orWhereHas('currentOwner', function ($q) {
                                    $q->where(DB::raw("CONCAT(first_name, ' ', surname)"), 'LIKE', '%' . request('q') . '%');
                                });
                            })
                            ->orderBy(request('sort_by'), request('sort_order'))
                            ->paginate(request('paginate') ?: config('vandango.blink.pagination'));

        return $this->response($enquiries);
    }
}
