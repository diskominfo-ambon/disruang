<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;
use App\Http\Requests\UserRequest;

class SuperUsersController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $keyword = $request->get('keyword', '');

    $users = User::role('admin')
      ->where('name', 'like', "%{$keyword}%")
      ->paginate(20);

    return view('web::admin.super-users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('web::admin.super-users.new');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserRequest $request)
  {
    $user = User::create(
      $request->all()
    );

    $user->assignRole('admin');

    $permission = $request->permission;

    $user->syncPermissions(
      $permission
    );
    

    return Redirect::route('admin.d.index')
      ->with(
        'message',
        "Berhasil menambahkan pengguna {$user->name}"
      );
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    return view('web::admin.super-users.edit', compact('user'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(UserRequest $request, User $user)
  {
    $user->update(
      $request->all()
    );

    $permission = $request->permission;

    $user->syncPermissions(
      $permission
    );    

    return Redirect::route('admin.d.index')
      ->with(
        'message',
        'Berhasil menyimpan perubahan'
      );
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    $user->delete();

    return Redirect::back()
      ->with(
        'message',
        'Berhasil menghapus super pengguna'
      );
  }
}
