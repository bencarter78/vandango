<?php

namespace App\Http\Requests\UserManager;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
{
    /**
     * @var array
     */
    protected $rules = [
        'general' => [
            'first_name' => 'alpha_dash|required',
            'surname' => 'alpha_dash|required',
            'email' => 'email|required',
        ],
        'password' => [
            'oldPassword' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ],
        'expenses' => [
            'home' => 'required',
            'base' => 'required',
            'reg_number' => 'required',
            'engine_size' => 'required',
            'cover_type' => 'required',
            'car_allowance' => 'required',
            'tax_scheme' => 'required',
        ],
        'hr' => [
            'start_date' => 'date_format:d/m/Y|size:10',
            'probation_end_date' => 'nullable|date_format:d/m/Y|size:10',
            'appraisal_date' => 'nullable|date_format:d/m/Y|size:10',
        ],
    ];

    /**
     * @var array
     */
    protected $messages = [
        'general' => [
            'first_name.required' => 'Please provide a valid first name',
            'last_name.required' => 'Please provide a valid surname',
            'email.required' => 'Please provide a valid email address',
            'email.unique' => 'Sorry, that email address has already been registered',
        ],
        'password' => [
            'oldPassword.required' => 'Please provide your current password.',
            'password.required' => 'Please enter a new password for your account.',
            'password_confirmation.required' => 'Please enter your password again (just to make sure).',
            'password_confirmation.min' => 'Your password must be at least 6 characters in length.',
            'password_confirmation.confirmed' => 'Please confirm your new password.',
        ],
    ];

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
        return $this->hasRuleSet()
            ? $this->rules[$this->request->get('ruleset')]
            : [];
    }

    /**
     * @return bool
     */
    private function hasRuleSet()
    {
        return isset($this->rules[$this->request->get('ruleset')]);
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->hasMessageSet()
            ? $this->messages[$this->request->get('ruleset')]
            : [];
    }

    /**
     * @return bool
     */
    private function hasMessageSet()
    {
        return isset($this->messages[$this->request->get('ruleset')]);
    }

}