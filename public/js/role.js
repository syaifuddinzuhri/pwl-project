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

/***/ "./resources/js/module/role_module.js":
/*!********************************************!*\
  !*** ./resources/js/module/role_module.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "role": () => (/* binding */ role)
/* harmony export */ });
/* harmony import */ var _handle_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle_module */ "./resources/js/module/handle_module.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Role = /*#__PURE__*/function () {
  function Role() {
    _classCallCheck(this, Role);
  }

  _createClass(Role, [{
    key: "dataTable",
    value: function dataTable() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-roles").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
          url: APP_URL + "/role"
        },
        columns: [{
          data: "DT_RowIndex",
          name: "DT_RowIndex",
          className: "text-center",
          width: "4%"
        }, {
          data: "name",
          name: "name",
          width: "10%"
        }, {
          data: "permissions",
          name: "permissions"
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
    key: "addRole",
    value: function addRole() {
      $("#form-add-role").validate({
        rules: {
          name: {
            required: true
          }
        },
        messages: {
          name: {
            required: "Nama role tidak boleh kosong"
          }
        },
        errorElement: "span",
        errorPlacement: function errorPlacement(error, element) {
          error.addClass("invalid-feedback");
          element.closest(".form-group").append(error);
        },
        highlight: function highlight(element, errorClass, validClass) {
          $(element).closest(".form-group").addClass("form-danger");
        },
        unhighlight: function unhighlight(element, errorClass, validClass) {
          $(element).closest(".form-group").removeClass("form-danger");
        },
        submitHandler: function submitHandler() {
          var data = {
            name: $("#name").val(),
            _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
          };
          $.ajax({
            type: "POST",
            url: "".concat(APP_URL, "/role"),
            data: data,
            beforeSend: function beforeSend() {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-role .btn-submit', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-role .btn-loading', 'show');
            },
            success: function success(res) {
              if (res) {
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-role .btn-loading', 'hide');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-role .btn-submit', 'show');
                $("#table-roles").DataTable().ajax.reload();
                $("#form-add-role")[0].reset();
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
              }
            },
            error: function error(e, x, settings, exception) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-role .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-role .btn-submit', 'show');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
            }
          });
        }
      });
    }
  }, {
    key: "updateRole",
    value: function updateRole() {
      $("#form-edit-role").validate({
        rules: {
          name: {
            required: true
          }
        },
        messages: {
          name: {
            required: "Nama role tidak boleh kosong"
          }
        },
        errorElement: "span",
        errorPlacement: function errorPlacement(error, element) {
          error.addClass("invalid-feedback");
          element.closest(".form-group .fomr-input").append(error);
        },
        highlight: function highlight(element, errorClass, validClass) {
          $(element).closest(".form-group").addClass("form-danger");
        },
        unhighlight: function unhighlight(element, errorClass, validClass) {
          $(element).closest(".form-group").removeClass("form-danger");
        },
        submitHandler: function submitHandler() {
          var data = {
            id: $("#id").val(),
            name: $("#name").val(),
            permissions: $("input:checkbox[name='permissions[]']:checked").map(function () {
              return $(this).val();
            }).get(),
            _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
          };
          $.ajax({
            type: "PUT",
            url: "".concat(APP_URL, "/role/").concat(data.id),
            data: data,
            beforeSend: function beforeSend() {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-role .btn-submit', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-role .btn-loading', 'show');
            },
            success: function success(res) {
              if (res) {
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-role .btn-loading', 'hide');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-role .btn-submit', 'show');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
                window.location.replace("".concat(APP_URL, "/role"));
              }
            },
            error: function error(e, x, settings, exception) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-role .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-role .btn-submit', 'show');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
            }
          });
        }
      });
    }
  }, {
    key: "deleteRole",
    value: function deleteRole() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = '';
      $("#table-roles").on("click", ".btn-delete-role", function () {
        id = $(this).data('id');
      });
      $("#form-delete-role").on("submit", function (e) {
        var url = APP_URL + "/role/" + id;
        var form = $(this);
        $.ajax({
          url: url,
          type: "DELETE",
          data: form.serialize(),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-role .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-role .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-role .btn-submit', 'show');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-role .btn-loading', 'hide');
              $("#table-roles").DataTable().ajax.reload();
              $("#deleteRoleModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-role .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-role .btn-loading', 'hide');
            var msg = "Hapus data gagal ";
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception, msg);
          }
        });
        e.preventDefault();
      });
    }
  }]);

  return Role;
}();

var role = new Role();

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
/*!******************************!*\
  !*** ./resources/js/role.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_role_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/role_module */ "./resources/js/module/role_module.js");

$(document).ready(function () {
  var pathURL = document.location.pathname;
  var splitURL = pathURL.split("/");

  if (splitURL.pop() == 'edit') {
    $('#selectAll').change(function () {
      if ($(this).is(':checked')) {
        $("input[name='permissions[]']").each(function () {
          $(this).attr('checked', true);
        });
      } else {
        $("input[name='permissions[]']").each(function () {
          $(this).attr('checked', false);
        });
      }
    });
    _module_role_module__WEBPACK_IMPORTED_MODULE_0__.role.updateRole();
  }

  if (pathURL == "/role" || pathURL == "/role/*") {
    _module_role_module__WEBPACK_IMPORTED_MODULE_0__.role.dataTable();
    _module_role_module__WEBPACK_IMPORTED_MODULE_0__.role.deleteRole();
    _module_role_module__WEBPACK_IMPORTED_MODULE_0__.role.addRole();
    $('.roles .reload-table').on('click', function () {
      $("#table-roles").DataTable().ajax.reload();
    });
  }
});
})();

/******/ })()
;