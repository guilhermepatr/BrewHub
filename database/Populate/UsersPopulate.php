<?php

namespace Database\Populate;
use App\Models\User;

class UsersPopulate
{
    public static function populate(): void
    {
    $data = [
        'name' => 'admin',
        'email' => 'admin@localhost.com',
        'password' => '123456',
        'password_confirmation' => '123456'
    ];

    $user = new User($data);
    $user->save();
    }
}