<?php

namespace Modules\Faq\Services\Helpers;

use Modules\Faq\Models\Faq;

class HtmlView{
    protected $faq;
    protected $heading = TRUE;

    public function __construct($faq)
    {
        $this->faq = Faq::find( $faq );
        return $this;
    }

    public function heading($heading)
    {
        $this->heading = $heading;
        return $this;
    }

    public function render()
    {
        echo "<div class='faq_container'>";
        if( $this->heading ){
            echo "<h2 class='mb-3'>{$this->faq->title}</h2>";
        }
        echo "<div class='faq' id='accordion'>";
        foreach ( $this->faq->questions as $question ){
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

    public static function create($faq)
    {
        return new static($faq);
    }
}
