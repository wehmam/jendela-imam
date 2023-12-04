<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;

class AuthRepository {
    public static function login() {
        try {
           $credentials = request()->only("email", "password");
           if(Auth::attempt($credentials)) {
                if(Auth::user()->getRoleNames()->isEmpty()) {
                    Auth::logout();
                    return responseCustom("Forbidden Access", [], false, 403);
                }

                return responseCustom("Success login", [], true, 200);
           }

           return responseCustom("Authentication Failed", [], false, 401);
        } catch (\Throwable $th) {
            return responseCustom("Something Wrong", [], false);
        }
    }
}
