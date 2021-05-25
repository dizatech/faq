/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./assets/js/mahamax-faq.js":
/*!**********************************!*\
  !*** ./assets/js/mahamax-faq.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

//start delete faq
$('.delete_faq_ajax').on('click', function () {
  var target = $(this);
  var id = $(this).data('faq');
  var faq = $(this).data('faq');
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
}); //end delete faq
//start store faq for question

$('.store_faq_ajax').on('click', function () {
  var target = $(this);
  var faq = $('#faq_id').val();
  var question = $('#question').val();
  var answer = $('#answer').val();
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
    success: function success(response) {
      if (response) {
        var template_row = $('#faq_question_new tbody tr:eq(-1)');
        var row = template_row.clone();
        row.data('id', response['id']);
        row.find('td:eq(0)').text(response['id']);
        row.find('td:eq(1) .show_mode_content').text(response['question']);
        row.find('td:eq(1) .edit_mode_content input').val(response['question']);
        row.find('td:eq(2) .show_mode_content').text(response['answer']);
        row.find('td:eq(2) .edit_mode_content input').val(response['answer']);
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
            confirmButton: 'btn btn-success'
          },
          buttonsStyling: false,
          showClass: {
            popup: 'animated fadeInDown'
          },
          hideClass: {
            popup: 'animated fadeOutUp'
          }
        });
      }
    },
    error: function error(response) {
      target.text('ثبت').removeClass('btn-secondary').addClass('btn-success');
    }
  });
}); //end store faq for question
//start delete  question at edit page for question

$('#faq_question_new').on('click', '.delete_question_ajax', function () {
  var target = $(this);
  var id = $(this).data('id');
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
          });
        }
      });
    }
  });
  target.text('حذف').removeProp('btn-success').addClass('btn-danger');
}); //end delete  question at edit page for question
//start edit faq at question

$('#faq_question_new').on('click', '.edit_question_ajax', function () {
  var target_row = $(this).closest('tr');
  target_row.siblings().find('.cancel_question_ajax').click();
  target_row.removeClass('show_mode').addClass('edit_mode');
}); //end edit faq at question
//start cancel edit question

$('#faq_question_new').on('click', '.cancel_question_ajax', function () {
  var target_row = $(this).closest('tr');
  target_row.removeClass('edit_mode').addClass('show_mode');
}); //end cancel edit question
// start hide fields error messages before and after ajax submit

function hide_error_messages() {
  $('.form-group').find('.invalid-feedback').addClass('d-none').find('strong').text('');
  $('.form-group').find('.is-invalid').removeClass('is-invalid');
  $('.assign_error').html('');
} // end hide fields error messages before and after ajax submit


function show_error_messages(target, response) {
  target.find('.form-group').find('.invalid-feedback').addClass('d-none').find('strong').text('');
  target.find('.form-group').find('.is-invalid').removeClass('is-invalid');

  if (response.status === 422) {
    for (var field_name in response.responseJSON.errors) {
      if (response.responseJSON.errors[field_name]) {
        var target_input = target.find('[name=' + field_name + '_edit]');
        console.log(target);
        console.log('[name=' + field_name + ']');
        target_input.addClass('is-invalid');
        target_input.closest('.form-group').find('.invalid-feedback').removeClass('d-none').find('strong').text(response.responseJSON.errors[field_name]);
      }
    }
  }
} // end show success messages for ajax request
//start update faq question


$('#faq_question_new').on('click', '.submit_question_ajax', function () {
  var target = $(this);
  var faq = $(this).data('id');
  var question = $(this).closest('tr').find('#question_edit').val();
  var answer = $(this).closest('tr').find('#answer_edit').val();
  var mainRow = $(this).closest('#input-row-' + faq);
  var inputRow = mainRow.closest('tbody').find('#main-row-' + faq);
  var target_row = $(this).closest('tr');
  target.text('در حال اجرا ...').removeClass('btn-secondary').addClass('btn-danger');
  $.ajax({
    type: 'patch',
    dataType: 'json',
    data: {
      question: question,
      answer: answer,
      faq_id: faq
    },
    url: baseUrl + '/panel/faq/faq_update/ajax/' + faq,
    success: function success(response) {
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
    error: function error(response) {
      target.text('ثبت').removeClass('btn-danger').addClass('btn-secondary');
      show_error_messages(target.closest('tr'), response);
      /*if (response.responseJSON.error == undefined){
          show_error_alert_messages(response);
      }*/
    }
  });
}); //end update faq question

/***/ }),

/***/ "./assets/sass/mahamax-faq.scss":
/*!**************************************!*\
  !*** ./assets/sass/mahamax-faq.scss ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***********************************************************************!*\
  !*** multi ./assets/js/mahamax-faq.js ./assets/sass/mahamax-faq.scss ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\new mahamax project\new_mahamax\modules\mahamaxFaq\src\assets\js\mahamax-faq.js */"./assets/js/mahamax-faq.js");
module.exports = __webpack_require__(/*! D:\new mahamax project\new_mahamax\modules\mahamaxFaq\src\assets\sass\mahamax-faq.scss */"./assets/sass/mahamax-faq.scss");


/***/ })

/******/ });