<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Department();
        $role->name = 'Alto Parana';
        $role->save();
    }
}
