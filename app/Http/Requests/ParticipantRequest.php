<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\IsScheduleAvailable;

class ParticipantRequest extends FormRequest
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
      'name' => 'required',
      'gender' => 'required',
      'phoneNumber' => 'required',
      'signatureFile' => 'required',
      'schedule_id' => ['required', new IsScheduleAvailable()]
    ];
  }

  public function attributes()
  {
    return [
      'name' => 'Nama lengkap',
      'gender' => 'Jenis kelamin',
      'email' => 'Alamat email',
      'phoneNumber' => 'Nomor telepon',
      'signatureFile' => 'Tanda tangan',
      'schedule_id' => 'Kegiatan'
    ];
  }


  public function passedValidation()
  {
    if ($this->filled('asn.origin') && $this->filled('asn.jobTitle')) {
      $this->merge([
        'origin' => $this->asn['origin'],
        'origin_job_title' => $this->asn['jobTitle'],
      ]);
    }

    $this->merge([
      'phone_number' => $this->phoneNumber,
    ]);
  }
}
