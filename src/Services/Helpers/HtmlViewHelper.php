<?php

namespace Modules\Faq\Services\Helpers;

use Modules\Faq\Models\Faq;

class HtmlViewHelper{
    public static function render( $faq ){
        $faq = Faq::find( $faq );

        echo "<div class='faq_container'>";
        echo "<h2>{$faq->title}</h2>";
        echo "<ul class='faq'>";
        foreach ( $faq->questions as $question ){
            echo "<li>
                <div>{$question->question}</div>
                <div>{$question->answer}</div>
            </li>";
        }
        echo "</ul>";
        echo "</div>";
    }
}
