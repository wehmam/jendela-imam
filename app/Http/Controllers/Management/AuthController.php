<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Repository\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function logout() {
        Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return response()->json(responseCustom("Success logout", [], true, 200));
    }
}
