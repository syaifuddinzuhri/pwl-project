/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/module/car_module.js":
/*!*******************************************!*\
  !*** ./resources/js/module/car_module.js ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "car": () => (/* binding */ car)
/* harmony export */ });
/* harmony import */ var _handle_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle_module */ "./resources/js/module/handle_module.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Car = /*#__PURE__*/function () {
  function Car() {
    _classCallCheck(this, Car);
  }

  _createClass(Car, [{
    key: "dataTable",
    value: function dataTable() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-cars").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
          url: APP_URL + "/car"
        },
        columns: [{
          data: "DT_RowIndex",
          name: "DT_RowIndex",
          className: "text-center",
          width: "4%"
        }, {
          data: "image",
          render: function render(data) {
            if (data != null) {
              var img = "".concat(APP_URL, "/storage/car/").concat(data);
              return '<img src="' + img + '" class="img-responsive img-thumbnail" style="width: 100px"/>';
            } else {
              return "";
            }
          }
        }, {
          data: "car_type",
          name: "car_type"
        }, {
          data: "merk",
          name: "merk"
        }, {
          data: "no_plat",
          name: "no_plat"
        }, {
          data: "status",
          name: "status"
        }, {
          data: "action",
          name: "action",
          className: "text-center",
          orderable: false,
          searchable: false
        }]
      });
    }
  }, {
    key: "changeFile",
    value: function changeFile(form, input) {
      $('#' + input).on("change", function (e) {
        e.preventDefault();

        if (this.files && this.files[0]) {
          var name = this.files[0]["name"];
          $("#" + form + "label[for='image']").text(name);
          var reader = new FileReader();

          reader.onload = function (e) {
            $("#" + form + " > #show-image").show();
            $("#" + form + " > #show-image > img").attr("src", e.target.result);
          };

          reader.readAsDataURL(this.files[0]);
        }
      });
    }
  }, {
    key: "showCar",
    value: function showCar() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-cars").on("click", ".btn-show-car", function () {
        var id = $(this).data('id');
        $.ajax({
          type: "GET",
          url: "".concat(APP_URL, "/car/").concat(id),
          beforeSend: function beforeSend() {
            $('#showCarModal #loading').show();
            $('#showCarModal .body-show-car').hide();
          },
          success: function success(res) {
            $('#showCarModal #loading').hide();
            $('#showCarModal .body-show-car').show();
            $('#showCarModal .body-show-car').html(res.html);
          }
        });
      });
    }
  }, {
    key: "statusCar",
    value: function statusCar() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-cars").on("click", ".btn-status-car", function () {
        var id = $(this).data('id');
        $.ajax({
          type: "GET",
          url: "".concat(APP_URL, "/car/get-status/").concat(id),
          beforeSend: function beforeSend() {
            $('#statusCarModal #loading').show();
            $('#statusCarModal .body-status-car').hide();
          },
          success: function success(res) {
            $('#statusCarModal #loading').hide();
            $('#statusCarModal .body-status-car').show();
            $('#statusCarModal .body-status-car').html(res.html);
          }
        });
      });
    }
  }, {
    key: "deleteCar",
    value: function deleteCar() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = '';
      $("#table-cars").on("click", ".btn-delete-car", function () {
        id = $(this).data('id');
      });
      $("#form-delete-car").on("submit", function (e) {
        var url = APP_URL + "/car/" + id;
        var form = $(this);
        $.ajax({
          url: url,
          type: "DELETE",
          data: form.serialize(),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-car .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-car .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-car .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-car .btn-submit', 'show');
              $("#table-cars").DataTable().ajax.reload();
              $("#deleteCarModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-car .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-car .btn-submit', 'show');
            var msg = "Hapus data gagal ";
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception, msg);
          }
        });
        e.preventDefault();
      });
    }
  }]);

  return Car;
}();

var car = new Car();

/***/ }),

/***/ "./resources/js/module/handle_module.js":
/*!**********************************************!*\
  !*** ./resources/js/module/handle_module.js ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "handle": () => (/* binding */ handle)
/* harmony export */ });
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Handle = /*#__PURE__*/function () {
  function Handle() {
    _classCallCheck(this, Handle);
  }

  _createClass(Handle, [{
    key: "setup",
    value: function setup() {
      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
      });
    }
  }, {
    key: "token",
    value: function token() {
      return $('meta[name="csrf-token"]').attr("content");
    }
  }, {
    key: "checkEmail",
    value: function checkEmail(email) {
      var res = true;
      var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      var emailLegalReg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)([\w-]+\.)+[\w-]{2,4})?$/;
      var emailaddressVal = email;

      if (!emailReg.test(emailaddressVal)) {
        res = false;
      } else if (emailLegalReg.test(emailaddressVal)) {
        res = false;
      }

      return res;
    }
  }, {
    key: "spinner",
    value: function spinner(component, action) {
      if (action === 'show') {
        return $(component).show();
      }

      return $(component).hide();
    }
  }, {
    key: "errorhandle",
    value: function errorhandle(e, x, settings, exception) {
      var msg = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;
      var message;
      var statusErrorMap = {
        400: "Server understood the request, but request content was invalid.",
        401: "Unauthorized access.",
        403: "Forbidden resource can't be accessed.",
        500: "Internal server error.",
        503: "Service unavailable."
      };

      if (x.status) {
        message = statusErrorMap[x.status];

        if (!message) {
          message = "Unknown Error \n.";
        }
      } else if (exception == "parsererror") {
        message = "Error.\nParsing JSON Request failed.";
      } else if (exception == "timeout") {
        message = "Request Time out.";
      } else if (exception == "abort") {
        message = "Request was aborted by the server";
      } else {
        message = msg != null ? msg : "Unknown server";
      }

      $.toast({
        text: "".concat(msg),
        heading: 'Error',
        icon: 'error',
        position: 'top-left'
      });
    }
  }, {
    key: "toastSuccess",
    value: function toastSuccess(msg) {
      $.toast({
        text: "".concat(msg),
        heading: 'Success',
        icon: 'success',
        position: 'top-left'
      });
    }
  }, {
    key: "toastError",
    value: function toastError(msg) {
      $.toast({
        text: "".concat(msg),
        heading: 'Error',
        icon: 'error',
        position: 'top-left'
      });
    }
  }]);

  return Handle;
}();

var handle = new Handle();

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*****************************!*\
  !*** ./resources/js/car.js ***!
  \*****************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_car_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/car_module */ "./resources/js/module/car_module.js");

$(document).ready(function () {
  var pathURL = document.location.pathname;
  var splitURL = pathURL.split("/");

  if (pathURL == "/car" || pathURL == "/car/*") {
    _module_car_module__WEBPACK_IMPORTED_MODULE_0__.car.dataTable();
    _module_car_module__WEBPACK_IMPORTED_MODULE_0__.car.deleteCar();
    _module_car_module__WEBPACK_IMPORTED_MODULE_0__.car.statusCar();
    _module_car_module__WEBPACK_IMPORTED_MODULE_0__.car.showCar();
    _module_car_module__WEBPACK_IMPORTED_MODULE_0__.car.changeFile("form-add-car", "image");
    $('.cars .reload-table').on('click', function () {
      $("#table-cars").DataTable().ajax.reload();
    });
  }

  if (splitURL.pop() == "edit") {
    _module_car_module__WEBPACK_IMPORTED_MODULE_0__.car.changeFile("form-edit-car", "image");
  }
});
})();

/******/ })()
;