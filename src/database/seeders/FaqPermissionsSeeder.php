<?php

namespace Modules\Faq\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('permissions')->where('name','faq')->count() == 0){
            DB::table('permissions')->insert([
                [
                    'name' => 'faq',
                    'display_name' => 'سوالات متداول',
                    'description' => 'دسترسی به سوالات متداول',
                    'created_at' => now()->toDateTimeString(),
                    'updated_at' => now()->toDateTimeString()
                ]
            ]);
        }
    }
}
