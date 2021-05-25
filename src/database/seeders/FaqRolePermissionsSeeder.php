<?php

namespace Modules\Faq\database\seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class FaqRolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programmer = Role::where('name', 'programmer')->first();

        $permissions = DB::table('permissions')->whereIn('name', [
            'faq'
        ])->get()->pluck('id');
        $programmer->permissions()->sync($permissions, false);
    }
}
