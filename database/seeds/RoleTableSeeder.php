<?php

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Super Usuario';
        $role->slug = 'superuser';
        $role->description = 'Usuario con acceso total';
        $role->special = 'all-access';
        $role->save();

        $role = new Role();
        $role->name = 'Nuevo Usuario';
        $role->slug = 'new';
        $role->description = 'Nuevo Usuario';
        $role->save();

        $role = new Role();
        $role->name = 'Cajero';
        $role->slug = 'cashier';
        $role->description = 'Usuario asignado como cajero';
        $role->save();

        $role = new Role();
        $role->name = 'Auditor';
        $role->slug = 'audit';
        $role->description = 'Usuario asignado para auditar productosy efectivo';
        $role->save();

        $role = new Role();
        $role->name = 'Cliente';
        $role->slug = 'client';
        $role->description = 'Cliente registrado en el sistema';
        $role->save();
    }
}
