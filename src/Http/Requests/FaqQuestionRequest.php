<?php

namespace Modules\Faq\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question'  => ['required'],
            'answer'    => ['required']
        ];
    }

    public function messages()
    {
        return [
            'faq_id.required'   => 'فیلد شماره سوال متداول الزامی است.',
            'faq_id.exists'     => 'فیلد شماره سوال متداول باید معتبر باشد.',
            'answer.required'   => 'لطفا پاسخ سوال را وارد کنید.',
            'question.required' => 'لطفا متن سوال را وارد کنید.',
        ];
    }
}
