<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleReviewRequest extends FormRequest
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
        $initialRules = [
            'origins' => 'required|array|min:1'
        ];

        if ($this->post('asn_available')) {
            $initialRules['employees'] = 'required|array|min:1';
        }

        return $initialRules;
    }


    public function attributes()
    {
        return [
            'employees' => 'Pegawai',
            'origins' => 'OPD'
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute wajib untuk dimasukan',
        ];
    }
}
