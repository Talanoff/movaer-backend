<?php

namespace App\Repositories;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Support\Collection;

final class UserRepository
{
    private User $user;

    public function fill(Collection $data): UserRepository
    {
        $this->user = new User(UserData::from($data)->toArray());

        return $this;
    }

    public function store(): UserRepository
    {
        $this->user = tap($this->user)->save();

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
