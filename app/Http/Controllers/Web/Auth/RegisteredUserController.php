<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class RegisteredUserController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required',
      'username' => 'required|unique:users,username',
      'phone_number' => 'required|numeric',
      'password' => 'required|confirmed'
    ], [], [
      'name' => 'Nama',
      'phone_number' => 'Nomor telepon'
    ]);

    $body = $request->merge([
        'password' => bcrypt($request->password)
    ]);

    $user = User::create($body->all());

    $user->assignRole('user');

    return redirect()
      ->route('auth.login')
      ->with(
        'message',
        'Berhasil menambahkan pengguna, silahkan login'
      );
  }
}
