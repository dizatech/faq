<?php
namespace Modules\Faq\Services\Traits;

use Modules\Faq\Models\Faq;

trait Faqable{

    public function faqs()
    {
        return $this->morphToMany(Faq::class, 'faqable')->orderBy('faqables.sort_order');
    }
}
