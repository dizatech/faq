<?php

namespace Modules\Faq\Services\Helpers;

use Modules\Faq\Models\Faq;

class JsonViewHelper
{
    public static function render( array $faqs )
    {
        $faqs = Faq::whereIn('id', $faqs)->get();
        $faq_list = new \stdClass();
        $context = "@context";
        $faq_list->$context="https://schema.org";
        $type = "@type";
        $faq_list->$type = "FAQPage";
        $main_entity = [];

        foreach( $faqs as $faq ){
            foreach( $faq->questions as $faq_question ){
                $question = new \stdClass();
                $question->$type = "Question";
                $question->name = $faq_question->question;
                $answer = new \stdClass();
                $answer->$type = "Answer";
                $answer->text = $faq_question->answer;
                $question->acceptedAnswer = $answer;
                $main_entity[] = $question;
            }
        }
        $faq_list->mainEntity = $main_entity;

        echo "<script type='application/ld+json'>";
        echo json_encode( $faq_list );
        echo "</script>";
    }
}
