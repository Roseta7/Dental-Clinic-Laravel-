<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Dentist;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //users seeders
        $users = [
            [
                'username' => 'Admin',
                'email' => 'admin@clinic.com',
                'password' => 'admin123',
                'name' => 'Admin User',
                'phone' => '0987456765',
                'gender' => 'Male',
            ],
            [
                'username' => 'Dentist',
                'email' => 'dentist@clinic.com',
                'password' => 'dentist123',
                'name' => 'Dentist User',
                'phone' => '0933485763',
                'gender' => 'Male',
            ],
            [
                'username' => 'Nurse',
                'email' => 'nurse@clinic.com',
                'password' => 'nurse123',
                'name' => 'Nurse User',
                'phone' => '0987653452',
                'gender' => 'Female',
            ],
            [
                'username' => 'Receptionist',
                'email' => 'receptionist@clinic.com',
                'password' => 'reception123',
                'name' => 'Receptionist User',
                'phone' => '0937743567',
                'gender' => 'Female',
            ],
            [
                'username' => 'Accountant',
                'email' => 'accountant@clinic.com',
                'password' => 'accountant123',
                'name' => 'Accountant User',
                'phone' => '0939876345',
                'gender' => 'Female',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                [
                    'username' => $userData['username'],
                    'email' => $userData['email']
                ],
                [
                    'password' => $userData['password'],
                    'name' => $userData['name'],
                    'phone' => $userData['phone'],
                    'gender' => $userData['gender'],          
                ]
            );
        }

        //create a corresponding record in the Dentist Table for the Dentist User.
        $user = User::where('email', 'dentist@clinic.com')->first();

        if($user && !$user->dentist){
            Dentist::create([
                'id' => $user->id,
                'specialty' => 'General Dentistry',
                'years_of_experience' => 5,
            ]);
        }
    }
}
