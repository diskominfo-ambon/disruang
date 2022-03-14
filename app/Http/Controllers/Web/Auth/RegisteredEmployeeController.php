<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Origin;
use App\Models\User;

class RegisteredEmployeeController extends Controller
{
    public function store(Request $request)
    {
        $body = $request->validate([
            'origin_id' => 'required',
            'job_position' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'phone_number' => 'required|numeric',
            'password' => 'required|confirmed'
          ], [], [
            'name' => 'Nama',
            'origin_id' => 'OPD pengguna',
            'job_position' => 'Status pengguna',
            'phone_number' => 'Nomor telepon',
            'unique' => 'username sudah digunakan oleh pengguna lain'
          ]);
        $origin = Origin::findOrFail($request->origin_id);

        if ($origin->employees->count() > 0 ) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message', 'Maaf pengguna ADMIN dari OPD '. strtoupper($origin->title) . ' telah dibuat sebelumnya.');
        }

        $body = array_merge($body, [
            'origin_id' => (int) $body['origin_id'],
            'origin_job_title ' => $body['job_position'],
            'password' => bcrypt($request->password),
            'name' => 'ADMIN '.strtoupper($origin->title)
        ]);
        
        $user = User::create($body);
    
        $user->assignRole('user');
    
        return redirect()
        ->route('auth.login')
        ->with(
            'message',
            'Berhasil menambahkan pengguna, silahkan login'
        );
    }
}
