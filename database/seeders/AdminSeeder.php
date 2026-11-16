<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('AGMA_ADMIN_EMAIL', 'admin@agmaone.local')],
            [
                'name' => 'AGMA Administrator',
                'password' => Hash::make(
                    env('AGMA_ADMIN_PASSWORD', 'ChangeMe123!')
                ),
            ]
        );
    }
}
