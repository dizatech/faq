@component('panel.layouts.component', ['title' => 'لیست سوالات متداول'])

    @slot('style')
    @endslot

    @slot('subject')
        <h1><i class="fa fa-users"></i> لیست سوالات متداول </h1>
        <p>این بخش برای لیست سوالات متداول است.</p>
    @endslot

    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('faq.index') }}">همه سوالات متداول</a></li>
        <li class="breadcrumb-item">لیست سوالات متداول</li>
    @endslot

    @slot('content')
        <div class="row">
            <div class="col-md-12">
                @component('components.accordion')
                    @slot('cards')
                        @component('components.collapse-card', ['id' => 'requests_list', 'show' => 'show', 'title' => ' لیست سوالات متداول '])
                            @slot('body')
                                @component('components.collapse-search')
                                    @slot('form')
                                        <form class="clearfix">
                                            <div class="form-group">
                                                <label for="text-name-input">نام درخواست</label>
                                                <input type="text" class="form-control" id="text-name-input"
                                                       placeholder="نام درخواست">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-left">جستجو</button>
                                        </form>
                                    @endslot
                                @endcomponent

                                <div class="mt-4">
                                    <a href={{route('faq.create')}} type="button" class="btn btn-primary"><i
                                            class="fa fa-plus"></i>سوالات متداول جدید</a>
                                </div>

                                @component('components.table')
                                    @slot('thead')
                                        <tr>
                                            <th>شناسه</th>
                                            <th>عنوان</th>
                                            <th>عملیات</th>
                                        </tr>
                                    @endslot
                                    @slot('tbody')
                                        @forelse ($faqs as $faq)
                                            <tr>
                                                <td>
                                                    {{$faq->getKey()}}
                                                </td>
                                                <td>
                                                    {{$faq->title}}
                                                </td>
                                                <td>
                                                    <a href="{{route('faq.edit', $faq->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                                                    <span class="btn btn-danger btn-sm ml-2 delete_faq_ajax" data-faq="{{$faq->id}}" >حذف</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">موردی برای نمایش وجود ندارد.</td>
                                            </tr>
                                        @endforelse
                                    @endslot
                                @endcomponent
                                {{ $faqs->withQueryString()->links('vendor.pagination.bootstrap-4') }}
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
        </div>
    @endslot

    @slot('script')
        <script src="{{ asset('modules/js/dizatech-faq.js') }}"></script>
    @endslot
@endcomponent
