<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'nama_admin' => $this->faker->name,
            'email_admin' => $this->faker->unique()->safeEmail,
            'password_admin' => bcrypt('cobaajadulu'), // Password default
        ];
    }
}
