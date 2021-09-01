<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class RegisteredUserController extends Controller
{
  public function store(Request $request)
  {
    $body = $request->validate([
      'name' => 'required',
      'email' => 'required',
      'username' => 'required|unique:users,username',
      'password' => 'required|confirmed'
    ], [], [
      'name' => 'Nama'
    ]);

    $user = User::create($body);

    $user->assingRole('user');

    return redirect()
      ->route('auth.login')
      ->with(
        'message',
        'Berhasil menambahkan pengguna, silahkan login'
      );
  }
}
