<?php

namespace Modules\Faq\database\seeders;

use App\Models\Permission;
use Dizatech\ModuleMenu\Models\ModuleMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqMenuPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Faq = ModuleMenu::where('name', 'Faq')->first();
        $faq_index = ModuleMenu::where('name', 'faq_index')->first();

        $Faq->permissions()->sync(Permission::where('name', 'faq')->pluck('id'));
        $faq_index->permissions()->sync(Permission::where('name', 'faq')->pluck('id'));
    }
}
