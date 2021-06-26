<?php

namespace Modules\Faq\Services\Helpers;

use Modules\Faq\Models\Faq;

class HtmlViewHelper{
    public static function render( $faq ){
        $faq = Faq::find( $faq );

        echo "<div class='faq_container'>";
        echo "<h2 class='mb-3'>{$faq->title}</h2>";
        echo "<div class='faq' id='accordion'>";
        foreach ( $faq->questions as $question ){
            echo "<div class='card'>
                    <div class='card-header' id='heading_{$question->id}'>
                        <h5 class='mb-0 header-content'>
                            <a role='button' data-toggle='collapse' aria-expanded='false' aria-controls='faq_answer_{$question->id}' href='#faq_answer_{$question->id}'>
                                {$question->question}
                            </a>
                        </h5>
                    </div>
                    <div id='faq_answer_{$question->id}' class='collapse' data-parent='#accordion' aria-labelledby='heading_{$question->id}'>
                        <div class='card-body'>
                            {$question->answer}
                        </div>
                    </div>
                  </div>";

        }
        echo "</div>";
        echo "</div>";
    }
}
