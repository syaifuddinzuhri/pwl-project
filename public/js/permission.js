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

/***/ }),

/***/ "./resources/js/module/permission_module.js":
/*!**************************************************!*\
  !*** ./resources/js/module/permission_module.js ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "permission": () => (/* binding */ permission)
/* harmony export */ });
/* harmony import */ var _handle_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle_module */ "./resources/js/module/handle_module.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Permission = /*#__PURE__*/function () {
  function Permission() {
    _classCallCheck(this, Permission);
  }

  _createClass(Permission, [{
    key: "dataTable",
    value: function dataTable() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-permissions").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
          url: APP_URL + "/permission"
        },
        columns: [{
          data: "DT_RowIndex",
          name: "DT_RowIndex",
          className: "text-center",
          width: "4%"
        }, {
          data: "name",
          name: "name"
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
    key: "addPermission",
    value: function addPermission() {
      $("#form-add-permission").on("submit", function (e) {
        e.preventDefault();
        var data = {
          name: $("#name").val(),
          _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
        };
        $.ajax({
          type: "POST",
          url: "".concat(APP_URL, "/permission"),
          data: data,
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-permission .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-permission .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-permission .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-permission .btn-submit', 'show');
              $("#table-permissions").DataTable().ajax.reload();
              $("#form-add-permission")[0].reset();
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-permission .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-permission .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
          }
        });
      });
    }
  }, {
    key: "editPermission",
    value: function editPermission() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = "";
      $("#table-permissions").on("click", ".btn-edit-permission", function () {
        id = $(this).data('id');
        $.ajax({
          type: "GET",
          url: "".concat(APP_URL, "/permission/").concat(id, "/edit"),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-permission', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading', 'show');
          },
          success: function success(res) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-permission', 'show');
            $('#name-edit').val(res.data.name);
          }
        });
      });
      $("#form-edit-permission").on("submit", function (e) {
        e.preventDefault();
        var data = {
          name: $("#name-edit").val(),
          _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
        };
        $.ajax({
          type: "PUT",
          url: APP_URL + "/permission/" + id,
          data: data,
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editPermissionModal .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editPermissionModal .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editPermissionModal .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editPermissionModal .btn-submit', 'show');
              $("#table-permissions").DataTable().ajax.reload();
              $("#form-edit-permission")[0].reset();
              $("#editPermissionModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editPermissionModal .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editPermissionModal .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
          }
        });
      });
    }
  }, {
    key: "deletePermission",
    value: function deletePermission() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = '';
      $("#table-permissions").on("click", ".btn-delete-permission", function () {
        id = $(this).data('id');
      });
      $("#form-delete-permission").on("submit", function (e) {
        var url = APP_URL + "/permission/" + id;
        var form = $(this);
        $.ajax({
          url: url,
          type: "DELETE",
          data: form.serialize(),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-permission .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-permission .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-permission .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-permission .btn-submit', 'show');
              $("#table-permissions").DataTable().ajax.reload();
              $("#deletePermissionModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-permission .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-permission .btn-submit', 'show');
            var msg = "Hapus data gagal ";
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception, msg);
          }
        });
        e.preventDefault();
      });
    }
  }]);

  return Permission;
}();

var permission = new Permission();

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
/*!************************************!*\
  !*** ./resources/js/permission.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_permission_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/permission_module */ "./resources/js/module/permission_module.js");

$(document).ready(function () {
  var pathURL = document.location.pathname;
  var splitURL = pathURL.split("/");

  if (pathURL == "/permission" || pathURL == "/permission/*") {
    _module_permission_module__WEBPACK_IMPORTED_MODULE_0__.permission.dataTable();
    _module_permission_module__WEBPACK_IMPORTED_MODULE_0__.permission.addPermission();
    _module_permission_module__WEBPACK_IMPORTED_MODULE_0__.permission.editPermission();
    _module_permission_module__WEBPACK_IMPORTED_MODULE_0__.permission.deletePermission();
    $('.permissions .reload-table').on('click', function () {
      $("#table-permissions").DataTable().ajax.reload();
    });
  }
});
})();

/******/ })()
;