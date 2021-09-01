<?php

return [
  'accepted' => ':attribute harus disetujui/terima.',
  'boolean' => ':attribute harus berupa benar atau salah.',
  'confirmed' => 'Bidang konformasi :attribute tidak benar.',
  'current_password' => 'Kata sandi tidak benar.',
  'date' => ':attribute bukan tanggal yang valid.',
  'date_equals' => ':attribute harus berupa tanggal dan harus sama dengan :date.',
  'date_format' => ':attribute tidak memiliki kecocokan dengan :format.',
  'email' => ':attribute harus berupa alamat email valid.',
  'exists' => ':attribute yang dipilih tidak valid.',
  'file' => ':attribute harus berupa file.',
  'image' => ':attribute harus berupa file gambar.',
  'integer' => 'The :attribute must be an integer.',
  'mimes' => ':attribute harus herupa file dengan format tipe :values.',
  'mimetypes' => ':attribute harus herupa file dengan format tipe :values.',
  'min' => [
    'numeric' => ':attribute setidaknya minimal :min.',
    'file' => ':attribute ukurannya setidaknya minimal :min kilobytes.',
    'array' => ':attribute setidaknya berisi minimal :min item.',
  ],
  'numeric' => ':attribute harus berupa angka.',
  'password' => 'Kata sandi tidak benar.',
  'required' => ':attribute harus wajib dimasukan',
  'required_if' => 'The :attribute field is required when :other is :value.',
  'required_unless' => 'The :attribute field is required unless :other is in :values.',
  'required_with' => 'The :attribute field is required when :values is present.',
  'required_with_all' => 'The :attribute field is required when :values are present.',
  'required_without' => 'The :attribute field is required when :values is not present.',
  'required_without_all' => 'The :attribute field is required when none of :values are present.',
  'string' => ':attribute harus berupa text.',
  'unique' => ':attribute sudah digunakan.',
  'uploaded' => 'Terjadi kegagalan saat mengupload :attribute',
  'uuid' => ':attribute harus berupa UUID yang valid.',

  /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

  'custom' => [
    'attribute-name' => [
      'rule-name' => 'custom-message',
    ],
  ],

  /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

  'attributes' => [],

];
