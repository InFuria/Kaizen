<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'migrations',
            'password_resets',
            'permission_role',
            'permission_user',
            'permissions',
            'role_user',
            'roles',
            'telescope_entries',
            'telescope_entries_tags',
            'telescope_monitoring',
            'users',
        ]);


        $this->call(RoleTableSeeder::class);
        $this->call(DepartamentSeeder::class);
        $this->call(BranchesSeeder::class);
    }

    public function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
