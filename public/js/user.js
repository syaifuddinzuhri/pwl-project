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

/***/ "./resources/js/module/user_module.js":
/*!********************************************!*\
  !*** ./resources/js/module/user_module.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "user": () => (/* binding */ user)
/* harmony export */ });
/* harmony import */ var _handle_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle_module */ "./resources/js/module/handle_module.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var User = /*#__PURE__*/function () {
  function User() {
    _classCallCheck(this, User);
  }

  _createClass(User, [{
    key: "dataTable",
    value: function dataTable() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-users").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
          url: APP_URL + "/user"
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
          data: "no_ktp",
          name: "no_ktp"
        }, {
          data: "email",
          name: "email"
        }, {
          data: "gender",
          name: "gender"
        }, {
          data: "phone",
          name: "phone"
        }, {
          data: "address",
          name: "address"
        }, {
          data: "role",
          name: "role"
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
    key: "storeUser",
    value: function storeUser() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#form-add-user").validate({
        rules: {
          name: {
            required: true
          },
          no_ktp: {
            required: true
          },
          gender: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          phone: {
            required: true
          },
          address: {
            required: true
          },
          password: {
            required: true,
            minlength: 8
          },
          password_confirmation: {
            required: true,
            equalTo: "#password"
          },
          role: {
            required: true
          }
        },
        messages: {
          name: {
            required: "Nama tidak boleh kosong"
          },
          gender: {
            required: "Jenis kelamin tidak boleh kosong"
          },
          no_ktp: {
            required: "Nomor KTP tidak boleh kosong"
          },
          email: {
            required: "Email tidak boleh kosong",
            email: 'Email tidak valid'
          },
          phone: {
            required: "Nomor HP tidak boleh kosong"
          },
          address: {
            required: "Alamat tidak boleh kosong"
          },
          password: {
            required: "Password tidak boleh kosong",
            minlength: "Password minimal 8 karakter"
          },
          password_confirmation: {
            required: "Konfirmasi password tidak boleh kosong",
            equalTo: "Password tidak sama"
          },
          role: {
            required: "Role tidak boleh kosong"
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
            name: $('#name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            password: $('#password').val(),
            role: $('#role').val(),
            no_ktp: $('#no_ktp').val(),
            gender: $('#gender').val(),
            _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
          };

          if (_handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.checkEmail(data["email"])) {
            $.ajax({
              url: APP_URL + "/user",
              type: "POST",
              data: data,
              beforeSend: function beforeSend() {
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-submit', 'hide');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-loading', 'show');
              },
              success: function success(res) {
                if (res) {
                  _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-submit', 'show');
                  _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-loading', 'hide');
                  $("#table-users").DataTable().ajax.reload();
                  $("#form-add-user")[0].reset();
                  $("#addUserModal").modal("hide");
                  _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
                }
              },
              error: function error(e, x, settings, exception) {
                // console.log(err.responseJSON)
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-submit', 'show');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-loading', 'hide');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
              }
            });
          } else {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-user .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastError('Email tidak valid');
          }
        }
      });
    }
  }, {
    key: "editUser",
    value: function editUser() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = "";
      $("#table-users").on("click", ".btn-edit-user", function () {
        id = $(this).data('id');
        $.ajax({
          type: "GET",
          url: "".concat(APP_URL, "/user/").concat(id, "/edit"),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-user', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading', 'show');
          },
          success: function success(res) {
            $('#role_edit option').each(function () {
              $(this).remove();
            });
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-user', 'show');
            var roles = res.data['roles'];
            var user = res.data[0]['user'];
            $.each(roles, function (index, item) {
              var selected = item.id === user.roles[0].id ? 'selected' : '';
              $('#role_edit').append($("<option ".concat(selected, " value=").concat(item.id, ">").concat(item.name, "</option>")));
            });
            $('#name_edit').val(user.name);
            $('#email_edit').val(user.email);
            $('#phone_edit').val(user.phone);
            $('#address_edit').val(user.address);
          }
        });
      });
      $("#form-edit-user").validate({
        rules: {
          name: {
            required: true
          },
          no_ktp: {
            required: true
          },
          gender: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          phone: {
            required: true
          },
          address: {
            required: true
          },
          password: {
            required: true,
            minlength: 8
          },
          password_confirmation: {
            required: true,
            equalTo: "#password"
          },
          role: {
            required: true
          }
        },
        messages: {
          name: {
            required: "Nama tidak boleh kosong"
          },
          gender: {
            required: "Jenis kelamin tidak boleh kosong"
          },
          no_ktp: {
            required: "Nomor KTP tidak boleh kosong"
          },
          email: {
            required: "Email tidak boleh kosong",
            email: 'Email tidak valid'
          },
          phone: {
            required: "Nomor HP tidak boleh kosong"
          },
          address: {
            required: "Alamat tidak boleh kosong"
          },
          password: {
            required: "Password tidak boleh kosong",
            minlength: "Password minimal 8 karakter"
          },
          password_confirmation: {
            required: "Konfirmasi password tidak boleh kosong",
            equalTo: "Password tidak sama"
          },
          role: {
            required: "Role tidak boleh kosong"
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
            name: $('#name_edit').val(),
            email: $('#email_edit').val(),
            phone: $('#phone_edit').val(),
            address: $('#address_edit').val(),
            password: $('#password_edit').val(),
            role: $('#role_edit').val(),
            no_ktp: $('#no_ktp_edit').val(),
            gender: $('#gender_edit').val(),
            _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
          };

          if (_handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.checkEmail(data["email"])) {
            $.ajax({
              url: APP_URL + "/user/" + id,
              type: "PUT",
              data: data,
              beforeSend: function beforeSend() {
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-submit', 'hide');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-loading', 'show');
              },
              success: function success(res) {
                if (res) {
                  _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-submit', 'show');
                  _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-loading', 'hide');
                  $("#table-users").DataTable().ajax.reload();
                  $("#form-edit-user")[0].reset();
                  $("#editUserModal").modal("hide");
                  _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
                }
              },
              error: function error(e, x, settings, exception) {
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-submit', 'show');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-loading', 'hide');
                _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
              }
            });
          } else {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-edit-user .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastError('Email tidak valid');
          }
        }
      });
    }
  }, {
    key: "deleteUser",
    value: function deleteUser() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = '';
      $("#table-users").on("click", ".btn-delete-user", function () {
        id = $(this).data('id');
      });
      $("#form-delete-user").on("submit", function (e) {
        var url = APP_URL + "/user/" + id;
        var form = $(this);
        $.ajax({
          url: url,
          type: "DELETE",
          data: form.serialize(),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-user .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-user .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-user .btn-submit', 'show');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-user .btn-loading', 'hide');
              $("#table-users").DataTable().ajax.reload();
              $("#deleteUserModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-user .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-user .btn-loading', 'hide');
            var msg = "Hapus data gagal ";
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception, msg);
          }
        });
        e.preventDefault();
      });
    }
  }]);

  return User;
}();

var user = new User();

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
  !*** ./resources/js/user.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_user_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/user_module */ "./resources/js/module/user_module.js");

$(document).ready(function () {
  var pathURL = document.location.pathname;
  var splitURL = pathURL.split("/");

  if (pathURL == "/user" || pathURL == "/user/*") {
    _module_user_module__WEBPACK_IMPORTED_MODULE_0__.user.dataTable(); // user.storeUser();

    _module_user_module__WEBPACK_IMPORTED_MODULE_0__.user.deleteUser(); // user.editUser();

    $('.users .reload-table').on('click', function () {
      $("#table-users").DataTable().ajax.reload();
    });
  }
});
})();

/******/ })()
;