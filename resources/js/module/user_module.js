import { handle } from "./handle_module";
class User {
    dataTable() {
        handle.setup();
        $("#table-users").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/user",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "no_ktp",
                    name: "no_ktp",
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "role",
                    name: "role",
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "gender",
                    name: "gender",
                },
                {
                    data: "phone",
                    name: "phone",
                },
                {
                    data: "address",
                    name: "address",
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

    deleteUser() {
        handle.setup();
        var id = '';
        $("#table-users").on("click", ".btn-delete-user", function () {
            id = $(this).data('id');
        });
        $("#form-delete-user").on("submit", function (e) {
            var url = APP_URL + "/user/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    handle.spinner('#form-delete-user .btn-submit', 'hide')
                    handle.spinner('#form-delete-user .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-delete-user .btn-submit', 'show')
                        handle.spinner('#form-delete-user .btn-loading', 'hide')
                        $("#table-users").DataTable().ajax.reload();
                        $("#deleteUserModal").modal("hide");
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-delete-user .btn-submit', 'show')
                    handle.spinner('#form-delete-user .btn-loading', 'hide')
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const user = new User();
