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
/******/ 	return __webpack_require__(__webpack_require__.s = 50);
/******/ })
/************************************************************************/
/******/ ({

/***/ 50:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(51);


/***/ }),

/***/ 51:
/***/ (function(module, exports) {

$(document).ready(function (e) {

    /**
     *
     * Função revelar password
     * @type {*|jQuery.fn.init|jQuery|HTMLElement}
     */
    var senha = $('#pass');
    var olho = $('#olho');

    olho.mousedown(function () {
        senha.attr("type", "text");
    });
    olho.mouseup(function () {
        senha.attr("type", "password");
    });

    $(document).on('submit', 'form.edit-usuario', function (e) {
        e.stopPropagation();
        e.preventDefault();

        $('#ajaxLoader').css('display', 'flex');

        var url = $(this).attr('action');
        var method = 'PUT';
        var data = $(this).serialize();

        $.ajax({
            url: url,
            method: method,
            data: data
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.dataAlert) {
                swal(res.dataAlert).then(function (ok) {
                    if (res.refresh) {
                        window.location.reload();
                    }
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.httpCode == 500) {
                if (res.dataAlert) {
                    swal(res.dataAlert).then(function (ok) {
                        if (res.refresh == false) {
                            window.location.reload();
                        }
                    });
                }
            }
            if (res.status == 403) {
                swal({
                    title: 'Atenção!',
                    text: "Favor preencher campo obrigatório.",
                    icon: 'warning'
                });
            }
        });
    });

    /**
     * Script de alteração de status do usuario
     */
    $(document).on('click', '.btn-activation', function (e) {

        e.preventDefault();

        $('#ajaxLoader').css('display', 'flex');

        var url = $(this).data('href');
        var method = 'POST';
        var status = $(this).data('user-status');

        $.ajax({
            url: url,
            type: method,
            data: { status: status }
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.dataAlert) {
                swal({
                    title: res.dataAlert.title,
                    text: res.dataAlert.text,
                    icon: res.dataAlert.icon
                }).then(function (ok) {
                    if (res.refresh) {
                        $('#ajaxLoader').css('display', 'flex');
                        window.location.reload();
                    }
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.responseJSON.dataAlert) {
                swal({
                    title: res.responseJSON.dataAlert.title,
                    text: res.responseJSON.dataAlert.text,
                    icon: res.responseJSON.dataAlert.icon
                }).then(function (ok) {
                    if (res.responseJSON.refresh) {
                        $('#ajaxLoader').css('display', 'flex');

                        window.location.reload();
                    }
                });
            }
        });
    });
});

/***/ })

/******/ });