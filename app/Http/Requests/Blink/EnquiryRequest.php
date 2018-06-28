<?php

namespace App\Http\Requests\Blink;

use Illuminate\Foundation\Http\FormRequest;

class EnquiryRequest extends FormRequest
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
            'search.contact_id' => 'required',
            'contact_tel' => 'required_without:contact_email',
            'contact_email' => 'required_without:contact_tel|nullable|email',
            'search.organisation_id' => 'required',
            'organisation_location' => 'required',
            'organisation_size' => 'nullable|integer',
            'referrer_id' => 'required',
            'note' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'search.contact_id.required' => 'Please enter the contact\'s name',
            'contact_tel.required_without:contact_email' => 'Please enter a contact number or email',
            'contact_email.required_without:contact_tel' => 'Please enter a contact number or email',
            'contact_email.email' => 'Please enter a valid email address',
            'search.organisation_id.required' => 'Please enter the name of the organisation',
            'organisation_location.required' => 'Please give an indication of where this organisation is based',
            'organisation_size.integer' => 'Employee count must be a whole number only',
            'note.required' => 'Please give some details about the enquiry',
            'referrer_id.required' => 'Please select how they heard about us',
        ];
    }
}
