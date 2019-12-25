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
        $role->code = '0204';
        $role->department_id = 1;
        $role->name = 'Varea Gourmet';
        $role->address = '';
        $role->phone = '00000';
        $role->save();
    }
}
