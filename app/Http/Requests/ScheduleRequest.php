<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return true;
      // return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'room_id' => 'required',
        'title' => 'required',
        'desc' => 'required|max:200',
        'started_at' => 'required|date',
        'ended_at' => 'required|date'
      ];
    }


    public function attributes()
    {
      return [
        'room_id' => 'Ruangan',
        'title' => 'Judul',
        'desc' => 'Deskripsi',
        'started_at' => 'Waktu mulai',
        'ended_at' => 'Waktu akhir'
      ];
    }
}
