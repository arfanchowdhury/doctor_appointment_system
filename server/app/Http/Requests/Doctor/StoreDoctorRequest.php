<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone_no' => ['required', 'digits:11', 'unique:users,phone_no'],
            'address' => ['required'],
            'specialities' => ['present', 'array']
        ];
    }
}
