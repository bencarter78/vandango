<?php

namespace App\Http\Requests\Blink;

use Illuminate\Foundation\Http\FormRequest;

class ApiEnquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_search' => 'required',
            'user_id' => 'required',
            'contact_search' => 'required',
            'contact_tel' => 'required_without:contact_email',
            'contact_email' => 'required_without:contact_tel',
            'organisation_search' => 'required',
            'organisation_location' => 'required',
            'note' => 'required',
        ];
    }
}
