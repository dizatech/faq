<?php

namespace Modules\Faq\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('module_menus')->where('name','Faq')->count() == 0){
            $Faq = DB::table('module_menus')->insertGetId([
                'name' => 'Faq',
                'title' => 'سوالات متداول',
                'icon' => 'fa  fa-question-circle',
                'route' => 'faq.index',
                'parent_id' => '0',
                'creator_id' => '1',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'deleted_at' => null,
            ]);
        }

        if (DB::table('module_menus')->where('name','faqindex')->count() == 0){
            DB::table('module_menus')->insert([
                'name' => 'faq_index',
                'title' => 'لیست سوالات متداول',
                'icon' => 'fa fa-circle-o',
                'route' => 'faq.index',
                'parent_id' => $Faq,
                'creator_id' => '1',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
                'deleted_at' => null,
            ]);
        }
    }
}
