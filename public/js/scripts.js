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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, exports) {

$(document).ready(function (e) {

    $('.datep').datetimepicker();

    $('.action-btn').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#ajaxLoader').css('display', 'flex');
        var url = $(this).attr('href');
        $.ajax({
            url: url,
            method: 'GET'
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            $('#modalDefault .modal-content').html(res);
            $('#modalDefault').modal({});
            $(document).trigger('modal-ready');
        }).fail(function (res) {
            swal({
                text: "Algo deu errado, tente novamente mais tarde!",
                icon: "error"
            }).then(function (ok) {
                window.location.reload();
            });
        });
    });

    $('#btnLinguagem').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#ajaxLoader').css('display', 'flex');
        $.ajax({
            url: $(this).attr('action'),
            method: 'GET',
            data: $('.form-busca').serialize()
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
        });
    });

    $(document).on('submit', 'form.submit-ajax', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#ajaxLoader').css('display', 'flex');
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).find('input[name="_method"]').val(),
            data: $(this).serialize()
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.success == true) {
                swal({
                    title: res.alert.title,
                    text: res.alert.text,
                    icon: res.alert.icon
                }).then(function () {
                    window.location.reload();
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.success == false || res.status == 500) {
                swal({
                    title: 'Solicitação recusada!',
                    text: "Não foi possivel realizar esta ação.",
                    icon: 'error'
                }).then(function () {
                    window.location.reload();
                });
            }
        });
    });

    $(document).on('submit', 'form.export-ajax', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#ajaxLoader').css('display', 'flex');
        var url = $(this).attr('action');
        var method = "GET";
        var data = $('.form-search').serialize();

        $.ajax({
            url: url,
            method: method,
            data: data
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            var a = document.createElement("a");
            a.href = res.file;
            a.download = res.name;
            document.body.appendChild(a);
            a.click();
            a.remove();
        });
    });

    $('.password-reset').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();

        var url = $(this).attr('href');
        var method = "GET";
        //let email = $('input[name="email"]').val();
        var email = $('.emailUser').val();
        console.log(url);
        $.ajax({
            url: url,
            method: method,
            data: email
        }).done(function (res) {
            swal(res.title, res.text, res.status);
        }).fail(function (res) {
            swal("Falha", "Algo deu errado, por favor tente novamente mais tarde!", "error");
        });
    });

    $(document).on('click', '.btn-notify', function () {
        $('#ajaxLoader').css('display', 'flex');
        $.ajax({
            beforeSend: function beforeSend(xhr) {
                xhr.setRequestHeader("X-CSRF-TOKEN", $("input[name='_token']").val());
            },
            url: "/system/envio-notificao",
            method: "POST",
            data: { mensagem: $('#mensagem').val() }
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            console.log(res);
            if (res.success === true) {
                swal({
                    text: "Notificação enviado com sucesso!",
                    icon: "success"
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            swal("Falha", "Algo deu errado, por favor tente novamente mais tarde!", "error");
        });
    });

    // $('.password-reset').on('click', function (e) {
    //     e.stopPropagation();
    //     e.preventDefault();
    //
    //     let url = $(this).attr('href');
    //     let email = $(".emailUser").val();
    //
    //
    //     $.post(url, {email: email}, function (data) {
    //         swal(data.title, data.message, data.status);
    //     }).fail(function (data) {
    //         swal("Falha", "Algo deu errado, por favor tente novamente mais tarde!", "error");
    //     });
    // });


    $('#ajaxLoader').css('display', 'none');
});

/***/ })

/******/ });