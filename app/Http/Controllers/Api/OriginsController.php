<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Origin;

class OriginsController extends Controller
{
    public function index()
    {
        $origins = Origin::has('employees')->orHas('users')->get();

        return Response::payload($origins);
    }
}
