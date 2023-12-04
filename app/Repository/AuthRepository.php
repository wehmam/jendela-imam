<?php

namespace App\Repository;

class AuthRepository {
    public static function login() {
        try {
            $email = request()->get("email");
            $password = request()->get("password");

            dd($email, $password);
        } catch (\Throwable $th) {

        }
    }
}
