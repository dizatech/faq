@component('panel.layouts.component', ['title' => 'سوالات متداول جدید'])

    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> سوالات متداول جدید</h1>
        <p> این بخش برای ایجاد سوالات متداول جدید است.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">همه سوالات متداول</a></li>
        <li class="breadcrumb-item"> سوالات متداول جدید</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'new-service', 'show' => 'show','title' => ' سوالات متداول جدید '])
                            @slot('body')
                                <form action="{{ route('faq.store') }}" method="POST" autocomplete="off">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="text-danger">*</span>
                                                <label for="title"><strong>عنوان</strong></label>
                                                <input class="form-control @error('title') is-invalid @enderror"
                                                       type="text"
                                                       value="{{old('title')}}" name="title" id="title">

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
    @endslot

    @slot('script')
    @endslot
@endcomponent
