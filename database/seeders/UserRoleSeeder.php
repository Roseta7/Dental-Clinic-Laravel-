<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('email','admin@clinic.com')->first()?->assignRole('admin');
        User::where('email','dentist@clinic.com')->first()?->assignRole('dentist');
        User::where('email','nurse@clinic.com')->first()?->assignRole('nurse');
        User::where('email','receptionist@clinic.com')->first()?->assignRole('receptionist');
        User::where('email','accountant@clinic.com')->first()?->assignRole('accountant');
    }
}
