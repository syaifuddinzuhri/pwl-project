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

/***/ "./resources/js/module/menu_module.js":
/*!********************************************!*\
  !*** ./resources/js/module/menu_module.js ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "menu": () => (/* binding */ menu)
/* harmony export */ });
/* harmony import */ var _handle_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle_module */ "./resources/js/module/handle_module.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Menu = /*#__PURE__*/function () {
  function Menu() {
    _classCallCheck(this, Menu);
  }

  _createClass(Menu, [{
    key: "dataTable",
    value: function dataTable() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-menus").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
          url: APP_URL + "/menu"
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
          data: "icon",
          name: "icon"
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
    key: "addMenu",
    value: function addMenu() {
      $("#form-add-menu").on("submit", function (e) {
        e.preventDefault();
        var data = {
          name: $("#name").val(),
          icon: $("#icon").val(),
          permission_id: $("#permission_id_menu").val(),
          _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
        };
        $.ajax({
          type: "POST",
          url: "".concat(APP_URL, "/menu"),
          data: data,
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-menu .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-menu .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-menu .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-menu .btn-submit', 'show');
              $("#table-menus").DataTable().ajax.reload();
              $("#form-add-menu")[0].reset();
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-menu .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-menu .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
          }
        });
      });
    }
  }, {
    key: "editMenu",
    value: function editMenu() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = "";
      $("#table-menus").on("click", ".btn-edit-menu", function () {
        id = $(this).data('id');
        $.ajax({
          type: "GET",
          url: "".concat(APP_URL, "/menu/").concat(id, "/edit"),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-menu', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading', 'show');
          },
          success: function success(res) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-menu', 'show');
            $('#name-menu-edit').val(res.data.name);
            $('#icon-edit').val(res.data.icon);
            $('#permission_id_menu-edit').val(res.data.permission_id);
          }
        });
      });
      $("#form-edit-menu").on("submit", function (e) {
        e.preventDefault();
        var data = {
          name: $("#name-menu-edit").val(),
          icon: $("#icon-edit").val(),
          permission_id: $("#permission_id_menu-edit").val(),
          _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
        };
        $.ajax({
          type: "PUT",
          url: APP_URL + "/menu/" + id,
          data: data,
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editMenuModal .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editMenuModal .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editMenuModal .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editMenuModal .btn-submit', 'show');
              $("#table-menus").DataTable().ajax.reload();
              $("#form-edit-menu")[0].reset();
              $("#editMenuModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editMenuModal .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editMenuModal .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
          }
        });
      });
    }
  }, {
    key: "deleteMenu",
    value: function deleteMenu() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = '';
      $("#table-menus").on("click", ".btn-delete-menu", function () {
        id = $(this).data('id');
      });
      $("#form-delete-menu").on("submit", function (e) {
        var url = APP_URL + "/menu/" + id;
        var form = $(this);
        $.ajax({
          url: url,
          type: "DELETE",
          data: form.serialize(),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-submit', 'show');
              $("#table-menus").DataTable().ajax.reload();
              $("#deleteMenuModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-submit', 'show');
            var msg = "Hapus data gagal ";
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception, msg);
          }
        });
        e.preventDefault();
      });
    }
  }]);

  return Menu;
}();

var menu = new Menu();

/***/ }),

/***/ "./resources/js/module/submenu_module.js":
/*!***********************************************!*\
  !*** ./resources/js/module/submenu_module.js ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "submenu": () => (/* binding */ submenu)
/* harmony export */ });
/* harmony import */ var _handle_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle_module */ "./resources/js/module/handle_module.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var Submenu = /*#__PURE__*/function () {
  function Submenu() {
    _classCallCheck(this, Submenu);
  }

  _createClass(Submenu, [{
    key: "dataTable",
    value: function dataTable() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      $("#table-submenus").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
          url: "".concat(APP_URL, "/submenu")
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
          data: "url",
          name: "url"
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
    key: "addSubmenu",
    value: function addSubmenu() {
      $("#form-add-submenu").on("submit", function (e) {
        e.preventDefault();
        var data = {
          name: $("#name_submenu").val(),
          url: $("#url").val(),
          menu_id: $("#menu_id").val(),
          permission_id: $("#permission_id_submenu").val(),
          _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
        };
        $.ajax({
          type: "POST",
          url: "".concat(APP_URL, "/store-submenu"),
          data: data,
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-submenu .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-submenu .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-submenu .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-submenu .btn-submit', 'show');
              $("#table-submenus").DataTable().ajax.reload();
              $("#form-add-submenu")[0].reset();
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-submenu .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-add-submenu .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
          }
        });
      });
    }
  }, {
    key: "editSubmenu",
    value: function editSubmenu() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = "";
      $("#table-submenus").on("click", ".btn-edit-submenu", function () {
        id = $(this).data('id');
        $.ajax({
          type: "GET",
          url: "".concat(APP_URL, "/submenu/").concat(id, "/edit"),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-submenu', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading-submenu', 'show');
          },
          success: function success(res) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#loading-submenu', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#body-edit-submenu', 'show');
            $('#name-submenu-edit').val(res.data.name);
            $('#url-edit').val(res.data.url);
            $('#permission_id_submenu-edit').val(res.data.permission_id);
            $('#menu_id-edit').val(res.data.menu_id);
          }
        });
      });
      $("#form-edit-submenu").on("submit", function (e) {
        e.preventDefault();
        var data = {
          name: $("#name-submenu-edit").val(),
          url: $("#url-edit").val(),
          menu_id: $("#menu_id-edit").val(),
          permission_id: $("#permission_id_submenu-edit").val(),
          _token: _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.token()
        };
        $.ajax({
          type: "PATCH",
          url: APP_URL + "/update-submenu/" + id,
          data: data,
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editSubmenuModal .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editSubmenuModal .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editSubmenuModal .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editSubmenuModal .btn-submit', 'show');
              $("#table-submenus").DataTable().ajax.reload();
              $("#form-edit-submenu")[0].reset();
              $("#editSubmenuModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editSubmenuModal .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#editSubmenuModal .btn-submit', 'show');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception);
          }
        });
      });
    }
  }, {
    key: "deleteSubmenu",
    value: function deleteSubmenu() {
      _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.setup();
      var id = '';
      $("#table-menus").on("click", ".btn-delete-menu", function () {
        id = $(this).data('id');
      });
      $("#form-delete-menu").on("submit", function (e) {
        var url = APP_URL + "/menu/" + id;
        var form = $(this);
        $.ajax({
          url: url,
          type: "DELETE",
          data: form.serialize(),
          beforeSend: function beforeSend() {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-submit', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-loading', 'show');
          },
          success: function success(res) {
            if (res) {
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-loading', 'hide');
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-submit', 'show');
              $("#table-menus").DataTable().ajax.reload();
              $("#deleteMenuModal").modal("hide");
              _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.toastSuccess(res.messages);
            }
          },
          error: function error(e, x, settings, exception) {
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-loading', 'hide');
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.spinner('#form-delete-menu .btn-submit', 'show');
            var msg = "Hapus data gagal ";
            _handle_module__WEBPACK_IMPORTED_MODULE_0__.handle.errorhandle(e, x, settings, exception, msg);
          }
        });
        e.preventDefault();
      });
    }
  }]);

  return Submenu;
}();

var submenu = new Submenu();

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
  !*** ./resources/js/menu.js ***!
  \******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_menu_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/menu_module */ "./resources/js/module/menu_module.js");
/* harmony import */ var _module_submenu_module__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./module/submenu_module */ "./resources/js/module/submenu_module.js");


$(document).ready(function () {
  var pathURL = document.location.pathname;
  var splitURL = pathURL.split("/");

  if (pathURL == "/menu" || pathURL == "/menu/*") {
    _module_menu_module__WEBPACK_IMPORTED_MODULE_0__.menu.dataTable();
    _module_menu_module__WEBPACK_IMPORTED_MODULE_0__.menu.addMenu();
    _module_menu_module__WEBPACK_IMPORTED_MODULE_0__.menu.editMenu();
    _module_menu_module__WEBPACK_IMPORTED_MODULE_0__.menu.deleteMenu();
    _module_submenu_module__WEBPACK_IMPORTED_MODULE_1__.submenu.dataTable();
    _module_submenu_module__WEBPACK_IMPORTED_MODULE_1__.submenu.addSubmenu();
    _module_submenu_module__WEBPACK_IMPORTED_MODULE_1__.submenu.editSubmenu();
    _module_submenu_module__WEBPACK_IMPORTED_MODULE_1__.submenu.deleteSubmenu();
    $('.menu .reload-table').on('click', function () {
      $("#table-menus").DataTable().ajax.reload();
    });
    $('.submenu .reload-table').on('click', function () {
      $("#table-submenus").DataTable().ajax.reload();
    });
  }
});
})();

/******/ })()
;