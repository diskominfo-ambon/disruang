<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $keyword = $request->get('keyword', '');

    $users = User::role('user')
      ->where('name', 'like', "%{$keyword}%")
      ->paginate(20);

    return view('web::admin.users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('web::admin.users.new');
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

    $user->assignRole('user');

    return Redirect::route('admin.users.index')
      ->with(
        'message',
        "Berhasil menambahkan pengguna baru {$user->name}"
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
    return view('web::admin.users.edit', compact('user'));
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
    $body = collect($request->except(['_method', '_token']))
      ->filter(fn ($field) => Str::of($field)->isNotEmpty());

    $user->update(
      $body->toArray()
    );


    return Redirect::route('admin.users.index')
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
    abort_if(!auth()->user()->can('kominfo'), 401);
    $user->delete();


    return Redirect::back()
      ->with(
        'message',
        'Berhasil menghapus pengguna'
      );
  }
}
