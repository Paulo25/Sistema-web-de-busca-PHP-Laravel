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
/******/ 	return __webpack_require__(__webpack_require__.s = 46);
/******/ })
/************************************************************************/
/******/ ({

/***/ 46:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(47);


/***/ }),

/***/ 47:
/***/ (function(module, exports) {

$(document).ready(function (e) {

    $(document).on('submit', 'form.submit-edit', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#ajaxLoader').css('display', 'flex');
        var data = new FormData($(this).get(0));
        // let nome = $("input[name=nome]").val();
        // let conteudo = $("input[name=conteudo]").val();
        // let status = $("input[name=status]").val();
        // let checkbox = $("input[name=checkbox]").val();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).find('input[name="_method"]').val(),
            contentType: false,
            processData: false,
            data: data
            // data: {nome,conteudo,status,checkbox,data}
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.success == true) {
                swal({
                    title: 'Solicitação efetuada com sucesso!',
                    text: 'Operação efetuada com sucesso.',
                    icon: 'success'
                }).then(function () {
                    window.location.reload();
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.status == 403) {
                swal({
                    title: 'Atenção!',
                    text: "Favor preencher campo obrigatório.",
                    icon: 'warning'
                });
            } else {
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
});

/***/ })

/******/ });