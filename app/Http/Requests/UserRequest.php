<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      $rules = [
        'name' => 'required',
        'username' => 'required',
        'phone_number' => 'required',
        'email' => 'required'
      ];

      if ($this->method() === 'POST' || $this->filled('password')) {
        $rules['password'] = 'required|confirmed';
      }

      if (($this->routeIs('admin.d.store') || $this->routeIs('admin.d.update'))
        && auth()->user()->id !== $this?->user?->id
      ) {
        $rules['permission'] = 'required';
      }

      return $rules;
    }

    public function passedValidation()
    {
      if ($this->filled('password')) {
        $this->merge([
          'password' => bcrypt($this->password)
        ]);
      }
    }

    public function attributes()
    {
      return [
        'name' => 'Nama',
        'phone_number' => 'Nomor telepon',
        'username' => 'Username',
        'email' => 'Alamat email',
        'password' => 'Kata sandi',
        'password_confirmation' => 'Konfirmasi kata sandi',
        'permission' => 'Akses pengguna'
      ];
    }
}
