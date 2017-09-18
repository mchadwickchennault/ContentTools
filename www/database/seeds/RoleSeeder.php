<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->adminPermissions();
        $this->adPermissions();
        $this->designerPermissions();
        $this->translatorPermissions();
        $this->reviewerPermissions();
        $this->testerPermissions();
    }

    private function adminPermissions()
    {
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions(Permission::all());
    }

    private function adPermissions()
    {
        $adPerms = [
            'Edit courses',
            'Create parent courses',
            'Create child courses',
            'Assign courses',
            'Publish staged',
            'Publish eLearning',
            'View courses',
            'Add derivatives',
            'Comment courses',
            'Edit text',
        ];
        $ad = Role::firstOrCreate(['name' => 'AD']);
        $ad->syncPermissions(Permission::wherein('name', $adPerms)->get());
    }

    private function designerPermissions()
    {
        $designerPerms = [
            'Edit courses',
            'Assign courses',
            'Publish staged',
            'View courses',
            'Add derivatives',
            'Comment courses',
        ];
        $designer = Role::firstOrCreate(['name' => 'Designer']);
        $designer->syncPermissions(Permission::wherein('name', $designerPerms)->get());
    }

    private function translatorPermissions()
    {
        $translatorPerms = [
            'View courses',
            'Comment courses',
            'Edit text',
        ];
        $translator = Role::firstOrCreate(['name' => 'Translator']);
        $translator->syncPermissions(Permission::wherein('name', $translatorPerms)->get());
    }

    private function reviewerPermissions()
    {
        $reviewerPerms = [
            'View courses',
            'Comment courses',
            'Edit text',
        ];
        $reviewer = Role::firstOrCreate(['name' => 'Reviewer']);
        $reviewer->syncPermissions(Permission::wherein('name', $reviewerPerms)->get());
    }

    private function testerPermissions()
    {
        $testerPerms = [
            'View courses',
            'Comment courses',
            'Publish staged',
        ];
        $tester = Role::firstOrCreate(['name' => 'Reviewer']);
        $tester->syncPermissions(Permission::wherein('name', $testerPerms)->get());
    }
}
