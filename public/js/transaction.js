/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

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
        text: "".concat(settings),
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

/***/ }),

/***/ "./resources/js/module/transaction_module.js":
/*!***************************************************!*\
  !*** ./resources/js/module/transaction_module.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "transaction": () => (/* binding */ transaction)
/* harmony export */ });
/* harmony import */ var _handle_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle_module */ "./resources/js/module/handle_module.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Transaction = /*#__PURE__*/function () {
  function Transaction() {
    _classCallCheck(this, Transaction);
  }

  _createClass(Transaction, [{
    key: "dataTable",
    value: function dataTable() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-transaction").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
          url: APP_URL + "/transaction"
        },
        columns: [{
          data: "DT_RowIndex",
          name: "DT_RowIndex",
          className: "text-center",
          width: "4%"
        }, {
          data: "user.name",
          name: "user.name"
        }, {
          data: "car.merk",
          name: "car.merk"
        }, {
          data: "car.no_plat",
          name: "car.no_plat"
        }, {
          data: "lease_date",
          name: "lease_date"
        }, {
          data: "return_date",
          name: "return_date"
        }, {
          data: "date_of_return",
          name: "date_of_return"
        }, {
          data: "proof_of_payment",
          name: "proof_of_payment"
        }, {
          data: "payment_status",
          name: "payment_status"
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
    key: "editTransaction",
    value: function editTransaction() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = "";
      var isActive = 0;
      $("#payment-status-edit").on("change", function () {
        $(this).is(":checked") ? isActive = 1 : isActive = 0;
      });
      $("#table-transaction").on("click", ".btn-edit-transaction", function () {
        id = $(this).data('id');
        $.ajax({
          type: "GET",
          url: "".concat(APP_URL, "/transaction/").concat(id, "/edit"),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-transaction', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading', 'show');
          },
          success: function success(res) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading-transaction', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-transaction', 'show');
            $('#name-user-edit').val(res.data.user.name);
            $('#merk-car-edit').val(res.data.car.merk);
            $('#no-plat-edit').val(res.data.car.no_plat);
            $('#lease-date-edit').val(res.data.lease_date);
            $('#return-date-edit').val(res.data.return_date);
            $('#date-of-return-edit').val(res.data.date_of_return);

            if (res.data.payment_status == 1) {
              $("#payment-status-edit").attr("checked", true);
            } else {
              $("#payment-status-edit").attr("checked", false);
            }

            $('#img-payment').html("<img src=\"/proof_of_payment/".concat(res.data.proof_of_payment, "\" class=\"img-responsive\" width=\"300\" height=\"200\" />"));
          }
        });
      });
      $("#form-edit-transaction").on("submit", function (e) {
        e.preventDefault();
        var data = {
          payment_status: isActive,
          date_of_return: $("#date-of-return-edit").val(),
          _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
        };
        $.ajax({
          type: "PUT",
          url: APP_URL + "/transaction/" + id,
          data: data,
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editTransactionModal .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editTransactionModal .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editTransactionModal .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editTransactionModal .btn-submit', 'show');
              $("#table-transaction").DataTable().ajax.reload();
              $("#form-edit-transaction")[0].reset();
              $("#editTransactionModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editTransactionModal .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editTransactionModal .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
          }
        });
      });
    }
  }, {
    key: "deleteTransaction",
    value: function deleteTransaction() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = '';
      $("#table-transaction").on("click", ".btn-delete-transaction", function () {
        id = $(this).data('id');
      });
      $("#form-delete-transaction").on("submit", function (e) {
        var url = APP_URL + "/transaction/" + id;
        var form = $(this);
        $.ajax({
          url: url,
          type: "DELETE",
          data: form.serialize(),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-transaction .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-transaction .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-transaction .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-transaction .btn-submit', 'show');
              $("#table-transaction").DataTable().ajax.reload();
              $("#deleteTransactionModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-transaction .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-transaction .btn-submit', 'show');
            var msg = "Hapus data gagal ";
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception, msg);
          }
        });
        e.preventDefault();
      });
    }
  }]);

  return Transaction;
}();

var transaction = new Transaction();

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
/*!*************************************!*\
  !*** ./resources/js/transaction.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_transaction_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/transaction_module */ "./resources/js/module/transaction_module.js");

$(document).ready(function () {
  var pathURL = document.location.pathname;
  var splitURL = pathURL.split("/");

  if (pathURL == "/transaction" || pathURL == "/transaction/*") {
    _module_transaction_module__WEBPACK_IMPORTED_MODULE_0__.transaction.dataTable();
    _module_transaction_module__WEBPACK_IMPORTED_MODULE_0__.transaction.editTransaction();
    _module_transaction_module__WEBPACK_IMPORTED_MODULE_0__.transaction.deleteTransaction();
  }

  $('.transaction .reload-table').on('click', function () {
    $("#table-transaction").DataTable().ajax.reload();
  });
});
})();

/******/ })()
;