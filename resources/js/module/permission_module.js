import { handle } from "./handle_module";
class Permission {
    dataTable() {
        handle.setup();
        $("#table-permissions").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/permission",
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
                    data: "action",
                    name: "action",
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    }

    addPermission() {
        $("#form-add-permission").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name").val(),
                _token: handle.token()
            };
            console.log(data)
            $.ajax({
                type: "POST",
                url: `${APP_URL}/permission`,
                data: data,
                beforeSend: function () {
                    handle.spinner('#form-add-permission .btn-submit', 'hide')
                    handle.spinner('#form-add-permission .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-add-permission .btn-loading', 'hide')
                        handle.spinner('#form-add-permission .btn-submit', 'show')
                        $("#table-permissions").DataTable().ajax.reload();
                        $("#form-add-permission")[0].reset();
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-add-permission .btn-loading', 'hide')
                    handle.spinner('#form-add-permission .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    editPermission() {
        handle.setup();
        var id = "";

        $("#table-permissions").on("click", ".btn-edit-permission", function () {
            id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/permission/${id}/edit`,
                beforeSend: function () {
                    handle.spinner('#body-edit-permission', 'hide')
                    handle.spinner('#loading', 'show')
                },
                success: function (res) {
                    handle.spinner('#loading', 'hide')
                    handle.spinner('#body-edit-permission', 'show')
                    $('#name-edit').val(res.data.name);
                },
            });
        });

        $("#form-edit-permission").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name-edit").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "PUT",
                url: APP_URL + "/permission/" + id,
                data: data,
                beforeSend: function () {
                    handle.spinner('#editPermissionModal .btn-submit', 'hide')
                    handle.spinner('#editPermissionModal .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#editPermissionModal .btn-loading', 'hide')
                        handle.spinner('#editPermissionModal .btn-submit', 'show')
                        $("#table-permissions").DataTable().ajax.reload();
                        $("#form-edit-permission")[0].reset();
                        $("#editPermissionModal").modal("hide")
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#editPermissionModal .btn-loading', 'hide')
                    handle.spinner('#editPermissionModal .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    deletePermission() {
        handle.setup();
        let id = '';
        $("#table-permissions").on("click", ".btn-delete-permission", function () {
            id = $(this).data('id');
        });
        $("#form-delete-permission").on("submit", function (e) {
            var url = APP_URL + "/permission/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    handle.spinner('#form-delete-permission .btn-submit', 'hide')
                    handle.spinner('#form-delete-permission .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-delete-permission .btn-loading', 'hide')
                        handle.spinner('#form-delete-permission .btn-submit', 'show')
                        $("#table-permissions").DataTable().ajax.reload();
                        $("#deletePermissionModal").modal("hide");
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-delete-permission .btn-loading', 'hide')
                    handle.spinner('#form-delete-permission .btn-submit', 'show')
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }

}

export const permission = new Permission();
