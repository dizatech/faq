//start delete faq
$('.delete_faq_ajax').on('click', function () {
    let target = $(this);
    let id = $(this).data('faq');
    let faq = $(this).data('faq');

    Swal.fire({
        title: 'آیا برای حذف اطمینان دارید؟',
        icon: 'warning',
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-danger mx-2',
            cancelButton: 'btn btn-light mx-2'
        },
        buttonsStyling: false,
        confirmButtonText: 'حذف',
        cancelButtonText: 'لغو',
        showClass: {
            popup: 'animated fadeInDown'
        },
        hideClass: {
            popup: 'animated fadeOutUp'
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                type: "delete",
                url: baseUrl + '/panel/faq/faq_delete/ajax/' + id,
                dataType: 'json',
                data: {
                    faq: faq
                },
                success: function success(response) {
                    Swal.fire({
                        icon: 'success',
                        text: 'عملیات حذف با موفقیت انجام شد.',
                        confirmButtonText: 'تایید',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false,
                        showClass: {
                            popup: 'animated fadeInDown'
                        },
                        hideClass: {
                            popup: 'animated fadeOutUp'
                        }
                    }).then(function (response) {
                        target.closest('tr').remove();
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    });
                }
            });
        }
    });
});
//end delete faq

//start store faq for question
$('.store_faq_ajax').on('click', function () {
    let target = $(this);
    let faq = $('#faq_id').val();
    let question = $('#question').val();
    let answer = $('#answer').val();
    target.text('در حال اجرا...').removeClass('btn-danger').addClass('btn-secondary');

    $.ajax({
        type: 'post',
        url: baseUrl + '/panel/faq/faq_store/ajax/' + faq,
        dataType: 'json',
        data: {
            faq_id: faq,
            answer: answer,
            question: question
        },
        success: function (response) {
            $('#faq_table tbody').find('.no_item').hide();

            if (response) {
                let template_row = $('#faq_question_new tbody tr:eq(-1)');
                let row = template_row.clone();
                row.data('id', response['id']);
                row.find('td:eq(0)').text(response['id']);
                row.find('td:eq(1) .show_mode_content').text( response['question'] );
                row.find('td:eq(1) .edit_mode_content input').val( response['question'] );
                row.find('td:eq(2) .show_mode_content').text( response['answer'] );
                row.find('td:eq(2) .edit_mode_content input').val( response['answer'] );
                row.find('td:eq(3) [data-id]').data('id', response['id']);
                row.show();
                row.insertBefore(template_row);
                $('#question').val('');
                $('#answer').val('');
                target.text('ثبت').removeClass('btn-secondary').addClass('btn-success');

                Swal.fire({
                    icon: 'success',
                    text: 'عملیات ثبت سوال جدید با موفقیت انجام شد.',
                    confirmButtonText: 'تایید',
                    customClass: {
                        confirmButton: 'btn btn-success',
                    },
                    buttonsStyling: false,
                    showClass: {
                        popup: 'animated fadeInDown'
                    },
                    hideClass: {
                        popup: 'animated fadeOutUp'
                    }
                })
            }
        },
        error: function (response) {
            target.text('ثبت').removeClass('btn-secondary').addClass('btn-success');
        }
    });
});
//end store faq for question

//start delete  question at edit page for question
$('#faq_question_new').on('click', '.delete_question_ajax', function () {
    let target = $(this);
    let id = $(this).data('id');
    const remaining_rows = target.closest('tr').siblings().length;


    target.text('در حال انجام ...').removeProp('btn-danger').addClass('btn-success');
    Swal.fire({
        title: 'آیا برای حذف اطمینان دارید؟',
        icon: 'warning',
        showCancelButton: true,
        customClass: {
            confirmButton: 'btn btn-danger mx-2',
            cancelButton: 'btn btn-light mx-2'
        },
        buttonsStyling: false,
        confirmButtonText: 'حذف',
        cancelButtonText: 'لغو',
        showClass: {
            popup: 'animated fadeInDown'
        },
        hideClass: {
            popup: 'animated fadeOutUp'
        }
    }).then(function (result) {
        if (result.isConfirmed) {
            $.ajax({
                type: "delete",
                url: baseUrl + '/panel/faq/faq_question_delete/ajax/' + id,
                dataType: 'json',
                data: {
                    faq: id
                },
                success: function success(response) {
                    Swal.fire({
                        icon: 'success',
                        text: 'عملیات حذف با موفقیت انجام شد.',
                        confirmButtonText: 'تایید',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false,
                        showClass: {
                            popup: 'animated fadeInDown'
                        },
                        hideClass: {
                            popup: 'animated fadeOutUp'
                        }
                    }).then(function (response) {
                        target.closest('tr').remove();
                        if (remaining_rows < 3) {
                            $('#faq_table').find('tbody').append(`
                                <tr class="no_item">
                                    <td colspan="4" class="text-center">موردی برای نمایش وجود ندارد.
                                    </td>
                                </tr>
                            `);
                        }
                    });
                }
            });
        }
    })
    target.text('حذف').removeProp('btn-success').addClass('btn-danger');
});
//end delete  question at edit page for question

//start edit faq at question
$('#faq_question_new').on('click', '.edit_question_ajax', function () {
    let target_row = $(this).closest('tr');
    target_row.siblings().find('.cancel_question_ajax').click();
    target_row.removeClass('show_mode').addClass('edit_mode');
});
//end edit faq at question

//start cancel edit question
$('#faq_question_new').on('click', '.cancel_question_ajax', function () {
    let target_row = $(this).closest('tr');
    target_row.removeClass('edit_mode').addClass('show_mode');
})
//end cancel edit question

// start hide fields error messages before and after ajax submit
function hide_error_messages() {
    $('.form-group')
        .find('.invalid-feedback')
        .addClass('d-none')
        .find('strong').text('');
    $('.form-group')
        .find('.is-invalid')
        .removeClass('is-invalid');
    $('.assign_error').html('');
}
// end hide fields error messages before and after ajax submit

// start show success messages for ajax request
function show_error_messages(target, response) {
    target.find('.form-group')
        .find('.invalid-feedback')
        .addClass('d-none')
        .find('strong').text('');
    target.find('.form-group')
        .find('.is-invalid')
        .removeClass('is-invalid');
    if (response.status === 422) {
        for (const field_name in response.responseJSON.errors) {
            if (response.responseJSON.errors[field_name]) {
                let target_input = target.find('[name=' + field_name + '_edit]');
                console.log( target );
                console.log( '[name=' + field_name + ']' );
                target_input.addClass('is-invalid');
                target_input.closest('.form-group')
                    .find('.invalid-feedback')
                    .removeClass('d-none')
                    .find('strong').text(response.responseJSON.errors[field_name]);
            }
        }
    }
}
// end show success messages for ajax request

//start update faq question
$('#faq_question_new').on('click', '.submit_question_ajax', function () {
    let target      = $(this);
    let faq         = $(this).data('id');
    let question    = $(this).closest('tr').find('#question_edit').val();
    let answer      = $(this).closest('tr').find('#answer_edit').val();
    let mainRow     = $(this).closest('#input-row-'+ faq);
    let inputRow    = mainRow.closest('tbody').find('#main-row-'+ faq);
    let target_row = $(this).closest('tr');
    target.text('در حال اجرا ...').removeClass('btn-secondary').addClass('btn-danger');

    $.ajax({
        type: 'patch',
        dataType : 'json',
        data: {
            question: question,
            answer: answer,
            faq_id: faq
        },
        url: baseUrl + '/panel/faq/faq_update/ajax/' + faq,
        success: function (response) {
            target.text('ثبت').removeClass('btn-danger').addClass('btn-secondary');
            hide_error_messages();
            Swal.fire({
                icon: 'success',
                text: response.message
            });
            target_row.removeClass('edit_mode').addClass('show_mode');
            target_row.find('td:eq(1) .show_mode_content').text(response.question);
            target_row.find('td:eq(2) .show_mode_content').text(response.answer);
        },
        error: function (response) {
            target.text('ثبت').removeClass('btn-danger').addClass('btn-secondary');
            show_error_messages(target.closest('tr'), response);
            /*if (response.responseJSON.error == undefined){
                show_error_alert_messages(response);
            }*/
        }
    });
})
//end update faq question
