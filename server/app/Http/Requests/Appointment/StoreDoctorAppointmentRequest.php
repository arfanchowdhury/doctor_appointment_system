<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorAppointmentRequest extends FormRequest
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
            'patient_id'       => ['required'],
            'appointment_date' => ['required', 'date', 'after:yesterday'],
            'start_at'         => ['required'],
            'end_at'           => ['required', 'after:start_at'],
        ];
    }
}
