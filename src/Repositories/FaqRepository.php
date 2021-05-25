<?php


namespace Modules\Faq\Repositories;


use Modules\Faq\Models\Faq;

class FaqRepository
{

    public function all()
    {
        return Faq::all();
    }

    public function allWithPaginate()
    {
        return Faq::query()->paginate();
    }

}
