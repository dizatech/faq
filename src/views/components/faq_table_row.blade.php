<tr class="row_question show_mode" @if( $id == '' ) style="display: none" @endif data-id="{{ $id }}">
    <td>
        {{ $id }}
    </td>
    <td>
        <div class="show_mode_content">
            {{ $question }}
        </div>
        <div class="edit_mode_content">
            <div class="form-group">
                <input type="text" name="question_edit" id="question_edit"
                       class="form-control form-control-sm @error('question_edit') is-invalid @enderror"
                       value="{{ old( 'question_edit', $question ) }}">
                <span class="invalid-feedback d-none" role="alert">
                    <strong></strong>
                </span>
            </div>
        </div>
    </td>
    <td>
        <div class="show_mode_content">
            {{ $answer }}
        </div>
        <div class="edit_mode_content">
            <div class="form-group">
                <input type="text" class="form-control form-control-sm @error('answer_edit') is-invalid @enderror"
                       name="answer_edit" id="answer_edit"
                       @error('answer_edit') is-invalid
                       @enderror value="{{ old('answer_edit', $answer) }}">
                <span class="invalid-feedback d-none" role="alert">
                    <strong></strong>
                </span>
            </div>
        </div>
    </td>
    <td>
        <div class="show_mode_content">
            <span class="btn btn-sm btn-warning edit_question_ajax"
                  data-id="{{$id}}">ویرایش</span>
            <span class="btn btn-danger btn-sm delete_question_ajax"
                  data-id="{{ $id }}">حذف</span>
        </div>
        <div class="edit_mode_content">
            <span class="btn btn-sm btn-warning submit_question_ajax"
                  data-id="{{$id}}">ثبت</span>

            <span class="btn btn-danger btn-sm ml-2 cancel_question_ajax">انصراف</span>
        </div>
    </td>
</tr>
