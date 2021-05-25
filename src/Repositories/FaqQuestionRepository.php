<?php


namespace Modules\Faq\Repositories;


use Modules\Faq\Models\FaqQuestion;

class FaqQuestionRepository
{

    public function all()
    {
        return FaqQuestion::all();
    }

    public function allWithPaginate()
    {
        return FaqQuestion::paginate();
    }

}
