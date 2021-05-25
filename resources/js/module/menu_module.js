import { handle } from "./handle_module";
class Menu {
    dataTable() {
        handle.setup();
        $("#table-menus").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/menu",
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
                    data: "icon",
                    name: "icon",
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

    addMenu() {
        $("#form-add-menu").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name").val(),
                icon: $("#icon").val(),
                permission_id: $("#permission_id_menu").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "POST",
                url: `${APP_URL}/menu`,
                data: data,
                beforeSend: function () {
                    handle.spinner('#form-add-menu .btn-submit', 'hide')
                    handle.spinner('#form-add-menu .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-add-menu .btn-loading', 'hide')
                        handle.spinner('#form-add-menu .btn-submit', 'show')
                        $("#table-menus").DataTable().ajax.reload();
                        $("#form-add-menu")[0].reset();
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-add-menu .btn-loading', 'hide')
                    handle.spinner('#form-add-menu .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    editMenu() {
        handle.setup();
        var id = "";

        $("#table-menus").on("click", ".btn-edit-menu", function () {
            id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/menu/${id}/edit`,
                beforeSend: function () {
                    handle.spinner('#body-edit-menu', 'hide')
                    handle.spinner('#loading', 'show')
                },
                success: function (res) {
                    handle.spinner('#loading', 'hide')
                    handle.spinner('#body-edit-menu', 'show')
                    $('#name-menu-edit').val(res.data.name);
                    $('#icon-edit').val(res.data.icon);
                    $('#permission_id_menu-edit').val(res.data.permission_id);
                },
            });
        });

        $("#form-edit-menu").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name-menu-edit").val(),
                icon: $("#icon-edit").val(),
                permission_id: $("#permission_id_menu-edit").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "PUT",
                url: APP_URL + "/menu/" + id,
                data: data,
                beforeSend: function () {
                    handle.spinner('#editMenuModal .btn-submit', 'hide')
                    handle.spinner('#editMenuModal .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#editMenuModal .btn-loading', 'hide')
                        handle.spinner('#editMenuModal .btn-submit', 'show')
                        $("#table-menus").DataTable().ajax.reload();
                        $("#form-edit-menu")[0].reset();
                        $("#editMenuModal").modal("hide")
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#editMenuModal .btn-loading', 'hide')
                    handle.spinner('#editMenuModal .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    deleteMenu() {
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

export const menu = new Menu();
