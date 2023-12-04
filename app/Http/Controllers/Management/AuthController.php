<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view("back.login");
    }

    public function loginPost(AuthRequest $request) {
        
        dd($request->all());
    }
}
