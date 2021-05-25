import { handle } from "./handle_module";
class Submenu {
    dataTable() {
        handle.setup();
        $("#table-submenus").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: `${APP_URL}/submenu`,
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "url",
                    name: "url",
                },
                {
                    data: "action",
                    name: "action",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }

    addSubmenu() {
        $("#form-add-submenu").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name_submenu").val(),
                url: $("#url").val(),
                menu_id: $("#menu_id").val(),
                permission_id: $("#permission_id_submenu").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "POST",
                url: `${APP_URL}/store-submenu`,
                data: data,
                beforeSend: function () {
                    handle.spinner('#form-add-submenu .btn-submit', 'hide')
                    handle.spinner('#form-add-submenu .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-add-submenu .btn-loading', 'hide')
                        handle.spinner('#form-add-submenu .btn-submit', 'show')
                        $("#table-submenus").DataTable().ajax.reload();
                        $("#form-add-submenu")[0].reset();
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-add-submenu .btn-loading', 'hide')
                    handle.spinner('#form-add-submenu .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    editSubmenu() {
        handle.setup();
        var id = "";

        $("#table-submenus").on("click", ".btn-edit-submenu", function () {
            id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/submenu/${id}/edit`,
                beforeSend: function () {
                    handle.spinner('#body-edit-submenu', 'hide')
                    handle.spinner('#loading-submenu', 'show')
                },
                success: function (res) {
                    handle.spinner('#loading-submenu', 'hide')
                    handle.spinner('#body-edit-submenu', 'show')
                    $('#name-submenu-edit').val(res.data.name);
                    $('#url-edit').val(res.data.url);
                    $('#permission_id_submenu-edit').val(res.data.permission_id);
                    $('#menu_id-edit').val(res.data.menu_id);
                },
            });
        });

        $("#form-edit-submenu").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name-submenu-edit").val(),
                url: $("#url-edit").val(),
                menu_id: $("#menu_id-edit").val(),
                permission_id: $("#permission_id_submenu-edit").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "PATCH",
                url: APP_URL + "/update-submenu/" + id,
                data: data,
                beforeSend: function () {
                    handle.spinner('#editSubmenuModal .btn-submit', 'hide')
                    handle.spinner('#editSubmenuModal .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#editSubmenuModal .btn-loading', 'hide')
                        handle.spinner('#editSubmenuModal .btn-submit', 'show')
                        $("#table-submenus").DataTable().ajax.reload();
                        $("#form-edit-submenu")[0].reset();
                        $("#editSubmenuModal").modal("hide")
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#editSubmenuModal .btn-loading', 'hide')
                    handle.spinner('#editSubmenuModal .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    deleteSubmenu() {
        handle.setup();
        let id = '';
        $("#table-menus").on("click", ".btn-delete-menu", function () {
            id = $(this).data('id');
        });
        $("#form-delete-menu").on("submit", function (e) {
            var url = APP_URL + "/menu/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    handle.spinner('#form-delete-menu .btn-submit', 'hide')
                    handle.spinner('#form-delete-menu .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-delete-menu .btn-loading', 'hide')
                        handle.spinner('#form-delete-menu .btn-submit', 'show')
                        $("#table-menus").DataTable().ajax.reload();
                        $("#deleteMenuModal").modal("hide");
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-delete-menu .btn-loading', 'hide')
                    handle.spinner('#form-delete-menu .btn-submit', 'show')
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }

}

export const submenu = new Submenu();
