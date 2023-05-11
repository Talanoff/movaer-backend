<?php

namespace App\Services;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function register(UserData $attributes): Model|User
    {
        return User::create($attributes->toArray());
    }
}
