import { handle } from "./handle_module";
class Role {
    dataTable() {
        handle.setup();
        $("#table-roles").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/role",
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
                    width: "10%",
                },
                {
                    data: "permissions",
                    name: "permissions",
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

    addRole() {
        $("#form-add-role").validate({
            rules: {
                name: { required: true },
            },
            messages: {
                name: { required: "Nama role tidak boleh kosong" },
            },
            errorElement: "span",
            errorPlacement: (error, element) => {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: (element, errorClass, validClass) => {
                $(element).closest(".form-group").addClass("form-danger");
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).closest(".form-group").removeClass("form-danger");
            },
            submitHandler: function () {
                var data = {
                    name: $("#name").val(),
                    _token: handle.token()
                };
                $.ajax({
                    type: "POST",
                    url: `${APP_URL}/role`,
                    data: data,
                    beforeSend: function () {
                        handle.spinner('#form-add-role .btn-submit', 'hide')
                        handle.spinner('#form-add-role .btn-loading', 'show')
                    },
                    success: function (res) {
                        if (res) {
                            handle.spinner('#form-add-role .btn-loading', 'hide')
                            handle.spinner('#form-add-role .btn-submit', 'show')
                            $("#table-roles").DataTable().ajax.reload();
                            $("#form-add-role")[0].reset();
                            handle.toastSuccess(res.messages)
                        }
                    },
                    error: (e, x, settings, exception) => {
                        handle.spinner('#form-add-role .btn-loading', 'hide')
                        handle.spinner('#form-add-role .btn-submit', 'show')
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    updateRole() {
        $("#form-edit-role").validate({
            rules: {
                name: { required: true },
            },
            messages: {
                name: { required: "Nama role tidak boleh kosong" },
            },
            errorElement: "span",
            errorPlacement: (error, element) => {
                error.addClass("invalid-feedback");
                element.closest(".form-group .fomr-input").append(error);
            },
            highlight: (element, errorClass, validClass) => {
                $(element).closest(".form-group").addClass("form-danger");
            },
            unhighlight: (element, errorClass, validClass) => {
                $(element).closest(".form-group").removeClass("form-danger");
            },
            submitHandler: function () {
                var data = {
                    id: $("#id").val(),
                    name: $("#name").val(),
                    permissions: $("input:checkbox[name='permissions[]']:checked")
                        .map(function () { return $(this).val(); }).get(),
                    _token: handle.token()
                };
                $.ajax({
                    type: "PUT",
                    url: `${APP_URL}/role/${data.id}`,
                    data: data,
                    beforeSend: function () {
                        handle.spinner('#form-edit-role .btn-submit', 'hide')
                        handle.spinner('#form-edit-role .btn-loading', 'show')
                    },
                    success: function (res) {
                        if (res) {
                            handle.spinner('#form-edit-role .btn-loading', 'hide')
                            handle.spinner('#form-edit-role .btn-submit', 'show')
                            handle.toastSuccess(res.messages)
                            window.location.replace(`${APP_URL}/role`)
                        }
                    },
                    error: (e, x, settings, exception) => {
                        handle.spinner('#form-edit-role .btn-loading', 'hide')
                        handle.spinner('#form-edit-role .btn-submit', 'show')
                        handle.errorhandle(e, x, settings, exception);
                    },
                });
            },
        });
    }

    deleteRole() {
        handle.setup();
        let id = '';
        $("#table-roles").on("click", ".btn-delete-role", function () {
            id = $(this).data('id');
        });
        $("#form-delete-role").on("submit", function (e) {
            var url = APP_URL + "/role/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    handle.spinner('#form-delete-role .btn-submit', 'hide')
                    handle.spinner('#form-delete-role .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-delete-role .btn-submit', 'show')
                        handle.spinner('#form-delete-role .btn-loading', 'hide')
                        $("#table-roles").DataTable().ajax.reload();
                        $("#deleteRoleModal").modal("hide");
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-delete-role .btn-submit', 'show')
                    handle.spinner('#form-delete-role .btn-loading', 'hide')
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const role = new Role();
