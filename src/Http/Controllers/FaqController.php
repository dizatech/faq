<?php

namespace Modules\Faq\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Faq\Facades\FaqFacade;
use Modules\Faq\Facades\FaqQuestionFacade;
use Modules\Faq\Http\Requests\FaqQuestionRequest;
use Modules\Faq\Http\Requests\FaqRequest;
use Modules\Faq\Models\Faq;
use Modules\Faq\Models\FaqQuestion;

class FaqController extends Controller
{

    public function index()
    {
        return view('dizatechFaq::faq.index', [
            'faqs' => FaqFacade::allWithPaginate(),
        ]);
    }

    public function create()
    {
        return view('dizatechFaq::faq.create');
    }

    public function store(FaqRequest $request, Faq $faq)
    {
        $faq->fill($request->all());
        $faq->save();

        session()->flash('success', 'سوالات متداول جدید با موفقیت ثبت شد.');
        return redirect()->route('faq.edit', compact('faq'));
    }

    public function show(Faq $faq)
    {
    }

    public function edit(Faq $faq)
    {
        $faq_questions = FaqQuestion::where('faq_id', $faq->id)
            ->orderBy('sort_order', 'DESC')
            ->orderBy('id', 'ASC')->get();

        return view('dizatechFaq::faq.edit', [
            'faq'           => $faq,
            'faq_questions' => $faq_questions
        ]);
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->fill($request->all());
        $faq->save();

        session()->flash('success', 'ویرایش سوالات متداول با موفقیت انجام شد.');
        return redirect()->back();
    }

    public function destroy(Faq $faq)
    {
    }

    public function questionStore(FaqQuestionRequest $request, FaqQuestion $faqQuestion)
    {
        $faqQuestion->fill($request->all());
        $faqQuestion->save();

        session()->flash('success', 'سوالات با موفقیت ثبت شد');
        return redirect()->back();
    }

    public function faqDeleteAjax(Faq $faq)
    {
        $faq->delete();
        return response()->json([ 'status' => 200 ]);
    }

    public function faqStoreAjax(FaqQuestionRequest $request, FaqQuestion $faqQuestion)
    {
        $question = FaqQuestion::create( [
            'faq_id'   => $request->faq_id,
            'answer'   => $request->answer,
            'question' => $request->question
        ]);
        return json_encode([
            'status'   => 200,
            'id'       => $question->id,
            'answer'   => $question->answer,
            'question' => $question->question
        ]);
    }

    public function faqDeleteQuestionAjax(FaqQuestion $faqQuestion)
    {
        $faqQuestion->delete();
        return response()->json([ 'status' => 200 ]);
    }

    public function faqUpdateAjax(FaqQuestionRequest $request, FaqQuestion $faqQuestion)
    {
        $faqQuestion->fill($request->all());
        $faqQuestion->save();

        $response = array(
            'status' => '200',
            'message' => 'ویرایش سوالات با موفقیت انجام شد.',
            'question'  => $faqQuestion->question,
            'answer'  => $faqQuestion->answer,
        );
        return response()->json($response);

    }

    public function updateSortOrderAjax( Request $request )
    {
        $sort_order = count( $request->questions_order );
        foreach( $request->questions_order as $question_id ){
            $question = FaqQuestion::find($question_id);
            if( !is_null( $question ) ){
                $question->sort_order = $sort_order--;
                $question->save();
            }
        }

        return json_encode([
            'status' => 200
        ]);
    }
}
