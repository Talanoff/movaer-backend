<?php

namespace App\Repositories;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

final class UserRepository
{
    public function register(UserData $attributes): Model|User
    {
        return User::create($attributes->toArray());
    }
}
