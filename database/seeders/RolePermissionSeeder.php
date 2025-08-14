<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin Permissions
        Role::findByName('admin')->syncPermissions(Permission::all());

        //Dentist Permissions
        Role::findByName('dentist')->syncPermissions(
            'view patients','view appointments','view treatments','create treatments',
            'edit treatments','view radiographs','upload radiographs','edit radiographs','view medical histories',
            'create medical histories','edit medical histories','view doctor notes','create doctor notes','edit doctor notes'
        );

        //Nurse Permissions
        Role::findByName('nurse')->syncPermissions(
            'view patients','view appointments','view treatments','view radiographs',
            'upload radiographs','view medical histories','view doctor notes'
        );

        //Receptionist Permissions
        Role::findByName('receptionist')->syncPermissions(
            'view patients','create patients','edit patients','view appointments','create appointments',
            'update appointments','view invoices'
        );

        //Accountant Permissions
        Role::findByName('accountant')->syncPermissions(
            'view patients','view appointments','view invoices','create invoices','edit invoices'
        );

    }
}
