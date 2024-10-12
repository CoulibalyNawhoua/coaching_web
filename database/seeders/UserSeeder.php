<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => "Softexpertise",
            'last_name' =>  'Coaching',
            'email' => 'coachingAdmin@gmail.com',
            'password'  => Hash::make('123456'),
        ]);
    }
}
