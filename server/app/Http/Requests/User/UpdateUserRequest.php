<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'           => ['required'],
            'gender'         => ['required'],
            'birth_date'     => ['required'],
            'address'        => ['required'],
            'blood_group_id' => ['required'],

            'email' => [
                'required',
                Rule::unique('users')->ignore($this->user),
            ],
            'phone_no' => [
                'required',
                Rule::unique('users')->ignore($this->user),
            ],
        ];
    }
}
