<?php


namespace Modules\Faq\Services\Helpers;


use Modules\Faq\Models\Faq;

class jsonViewHelper
{
    public static function render($faq)
    {
        $faq = Faq::find($faq);
        $faq_list = new \stdClass();
        $context = "@context";
        $faq_list->$context="https://schema.org";
        $type = "@type";
        $faq_list->$type = "FAQPage";
        $main_entity = [];
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
        $faq_list->mainEntity = $main_entity;

        echo "<script type='application/ld+json'>";
        echo json_encode( $faq_list );
        echo "</script>";
    }
}
