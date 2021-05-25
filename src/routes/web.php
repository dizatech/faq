<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace'   => 'Modules\Faq\Http\Controllers',
    'prefix'      => 'panel',
    'middleware'  => ['web', 'auth', 'verified']
], function (){
    Route::resource('faq', 'FaqController');
    Route::delete('/faq/faq_delete/ajax/{faq}', 'FaqController@faqDeleteAjax');
    Route::post('/faq/faq_store/ajax/{faq}', 'FaqController@faqStoreAjax');
    Route::delete('/faq/faq_question_delete/ajax/{faq_question}', 'FaqController@faqDeleteQuestionAjax');
    Route::patch('/faq/faq_update/ajax/{faq_question}', 'FaqController@faqUpdateAjax');
    Route::patch('/faq/update_sort_order/ajax', 'FaqController@updateSortOrderAjax');
});
