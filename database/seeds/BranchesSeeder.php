<?php

use App\Branch;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Branch();
        $role->code = '201';
        $role->department_id = 1;
        $role->name = 'Vare\'a Gourmet';
        $role->address = 'Area 3';
        $role->phone = '0995643434';
        $role->save();

        $role = new Branch();
        $role->code = '202';
        $role->department_id = 1;
        $role->name = 'Vendome';
        $role->address = 'CDE Centro';
        $role->phone = '0995643434';
        $role->save();
    }
}
