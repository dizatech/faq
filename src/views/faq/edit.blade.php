@component('panel.layouts.component', ['title' => 'ویرایش سوالات متداول'])

    @slot('style')
        <link rel="stylesheet" href="{{ asset('modules/css/dizatech-faq.css') }}">
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i>ویرایش سوالات متداول</h1>
        <p> این بخش برای ویرایش سوالات متداول است.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">همه سوالات متداول</a></li>
        <li class="breadcrumb-item">ویرایش سوالات متداول</li>
    @endslot

    @slot('content')
        {{--        // edit for faq--}}
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'new-faq', 'show' => 'show','title' => 'ویرایش سوالات متداول'])
                            @slot('body')
                                <form action="{{ route('faq.update' , $faq) }}" method="POST" autocomplete="off"
                                      method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="title"><strong>عنوان</strong></label>
                                                <input class="form-control @error('title') is-invalid @enderror"
                                                       type="text"
                                                       value="{{old('title' , $faq->title)}}" name="title" id="title">

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="py-3">
                                        <button class="btn btn-success" type="submit">ثبت</button>
                                    </div>
                                </form>

                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
        {{--        // add question--}}
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'new-question', 'show' => 'show','title' => 'اضافه کردن سوال جدید'])
                            @slot('body')
                                <form action="{{route('faq.store')}}" method="POST">
                                    @csrf

                                    <div class="row" id="new_question">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="question"><strong>متن سوال</strong></label>
                                                <input class="form-control @error('question') is-invalid @enderror"
                                                       type="text" value="{{old('question')}}" name="question"
                                                       id="question">

                                                @error('question')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="answer"><strong>پاسخ</strong></label>
                                                <textarea class="form-control @error('answer') is-invalid @enderror"
                                                          type="text" value="{{old('answer')}}" name="answer"
                                                          id="answer" rows="5">{{old('answer')}}</textarea>

                                                @error('answer')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="id" id="faq_id" value="{{ $faq->id }}">
                                    <div class="py-3">
                                        <span class="btn btn-success store_faq_ajax" type="submit">ثبت</span>
                                    </div>
                                </form>

                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
        {{--        // index question--}}
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'question_list', 'show' => 'show', 'title' => ' لیست سوالات '])
                            @slot('body')

                                <div id="faq_question_new">
                                    @component('components.table', ['id' => 'faq_table'])
                                        @slot('thead')
                                            <tr>
                                                <th>شناسه</th>
                                                <th>سوال</th>
                                                <th>پاسخ</th>
                                                <th>عملیات</th>
                                            </tr>
                                        @endslot
                                        @slot('tbody')
                                            @forelse( $faq_questions as $faq_question )
                                                @component(
                                                    'dizatechFaq::components.faq_table_row',
                                                    [
                                                        'id'        => $faq_question->id,
                                                        'question'  => $faq_question->question,
                                                        'answer'    => $faq_question->answer
                                                    ]
                                                )
                                                @endcomponent
                                            @empty
                                                <tr class="no_item">
                                                    <td colspan="4" class="text-center">موردی برای نمایش وجود ندارد.
                                                    </td>
                                                </tr>
                                            @endforelse
                                            @component(
                                                'dizatechFaq::components.faq_table_row',
                                                [
                                                    'id'        => '',
                                                    'question'  => '',
                                                    'answer'    => ''
                                                ]
                                            )
                                            @endcomponent
                                        @endslot
                                    @endcomponent
                                </div>
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')
        <script src="{{ asset('modules/js/dizatech-faq.js') }}"></script>

        <script>
            $( function() {
                $( "#faq_question_new table tbody" ).sortable({
                    cursor: "move",
                    update: function(){
                        let questions_order = [];
                        $('.row_question:visible').each(function(){
                            questions_order.push( $(this).data('id') );
                        });
                        $.ajax({
                            type: 'patch',
                            url: baseUrl + '/panel/faq/update_sort_order/ajax',
                            data: {
                                questions_order: questions_order
                            },
                            dataType: 'json',
                            success: function (response) {
                                alertify.success('فیلدهای لیست سوالات با موفقیت مرتب سازی شد.');
                            },
                            error: function (response) {
                                alertify.error('مرتب سازی لیست سوالات با خطا مواجه شد.');
                            }
                        });
                    }
                });
                $( "#faq_question_new table tbody" ).disableSelection();
            } );
        </script>
    @endslot
@endcomponent


