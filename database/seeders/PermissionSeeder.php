<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //User Management
            'view users','create users','edit users','delete users',

            //Roles And Permission
            'view roles','view permissions',

            //Audit Logs
            'view audit logs',

            //Patients
            'view patients','create patients','edit patients','delete patients',

            //Appointments
            'view appointments','create appointments','update appointments','delete appointments',

            //Treatments
            'view treatments','create treatments','edit treatments','delete treatments',

            //Invoices
            'view invoices','create invoices','edit invoices','delete invoices',

            //radiographs
            'view radiographs','upload radiographs','edit radiographs','delete radiographs',

            //Medical Histories
            'view medical histories','create medical histories','edit medical histories','delete medical histories',

            //Doctor Notes
            'view doctor notes','create doctor notes','edit doctor notes','delete doctor notes'
        
        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate(['name' => $permission]);

        }
    }
}
