<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Administer roles & permissions',
            'Edit courses',
            'Create parent courses',
            'Create child courses',
            'Assign courses',
            'Publish staged',
            'Publish eLearning',
            'View courses',
            'Add derivatives',
            'Comment courses',
            'Edit text'
        ];
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => "'$perm'"]);
        }
    }
}
