<?php

namespace App\Repositories;

use App\Repositories\Traits\SimpleCRUD;
use App\Models\User;

class UserRepository
{
    use SimpleCRUD;

    private string $model = User::class;

    // Add any custom repository methods here

    public function getByEmail(string $email) {
        return $this->model::where('email', $email)->where('login_by', 'default')->first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return $this->model::updateOrCreate($attributes, $values);
    }

    public function isEmailExist(string $email)
    {
        return $this->model::where('email', $email)->where('login_by', 'default')->exists();
    }
}
