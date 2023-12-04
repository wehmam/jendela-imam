<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Repository\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() {
        return view("back.login");
    }

    public function loginPost(AuthRequest $request) {
        $response = AuthRepository::login();
        if(!$response["status"]) {
            alertNotify(false, $response["message"]);
            return back()
                ->withInput();
        }

        return redirect()->intended('/management');
    }
}
