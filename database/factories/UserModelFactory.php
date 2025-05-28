<?php

namespace Database\Factories;

use App\Models\UserModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserModelFactory extends Factory
{
    protected $model = UserModel::class;

    public function definition()
    {
        return [
            'nama_pengguna' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // default password
            'role' => 'admin', // default role, bisa diubah kalau perlu
        ];
    }
}
