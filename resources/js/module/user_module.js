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
                // {
                //     data: "image",
                //     render: function (data) {
                //         if (data != null) {
                //             var img = `${APP_URL}/room/${data}`;
                //             return (
                //                 '<img src="' +
                //                 img +
                //                 '" class="img-responsive" style="width: 100px"/>'
                //             );
                //         } else {
                //             return "";
                //         }
                //     },
                // },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "email",
                    name: "email",
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
                    data: "role",
                    name: "role",
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

    storeUser() {
        handle.setup();
        $("#form-add-user").validate({
            rules: {
                name: { required: true },
                email: { required: true, email: true },
                phone: { required: true },
                address: { required: true },
                password: { required: true, minlength: 8 },
                password_confirmation: { required: true, equalTo: "#password" },
                role: { required: true },
            },
            messages: {
                name: { required: "Nama tidak boleh kosong" },
                email: { required: "Email tidak boleh kosong", email: 'Email tidak valid' },
                phone: { required: "Nomor HP tidak boleh kosong" },
                address: { required: "Alamat tidak boleh kosong" },
                password: { required: "Password tidak boleh kosong", minlength: "Password minimal 8 karakter" },
                password_confirmation: { required: "Konfirmasi password tidak boleh kosong", equalTo: "Password tidak sama" },
                role: { required: "Role tidak boleh kosong" },
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
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val(),
                    password: $('#password').val(),
                    role: $('#role').val(),
                    _token: handle.token()
                }

                console.log(data)

                if (handle.checkEmail(data["email"])) {
                    $.ajax({
                        url: APP_URL + "/user",
                        type: "POST",
                        data: data,
                        beforeSend: function () {
                            handle.spinner('#form-add-user .btn-submit', 'hide')
                            handle.spinner('#form-add-user .btn-loading', 'show')
                        },
                        success: function (res) {
                            if (res) {
                                handle.spinner('#form-add-user .btn-submit', 'show')
                                handle.spinner('#form-add-user .btn-loading', 'hide')
                                $("#table-users").DataTable().ajax.reload();
                                $("#form-add-user")[0].reset();
                                $("#addUserModal").modal("hide");
                                handle.toastSuccess(res.messages)
                            }
                        },
                        error: (e, x, settings, exception) => {
                            // console.log(err.responseJSON)
                            handle.spinner('#form-add-user .btn-submit', 'show')
                            handle.spinner('#form-add-user .btn-loading', 'hide')
                            handle.errorhandle(e, x, settings, exception);
                        },
                    });
                } else {
                    handle.spinner('#form-add-user .btn-submit', 'show')
                    handle.spinner('#form-add-user .btn-loading', 'hide')
                    handle.toastError('Email tidak valid')
                }
            },
        });
    }

    editUser() {
        handle.setup();
        var id = "";

        $("#table-users").on("click", ".btn-edit-user", function () {
            id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/user/${id}/edit`,
                beforeSend: function () {
                    handle.spinner('#body-edit-user', 'hide')
                    handle.spinner('#loading', 'show')
                },
                success: function (res) {
                    $('#role_edit option').each(function () {
                        $(this).remove();
                    });

                    handle.spinner('#loading', 'hide')
                    handle.spinner('#body-edit-user', 'show')
                    var roles = res.data['roles']
                    var user = res.data[0]['user']
                    $.each(roles, function (index, item) {
                        var selected = item.id === user.roles[0].id ? 'selected' : '';
                        $('#role_edit').append($(`<option ${selected} value=${item.id}>${item.name}</option>`));
                    })
                    $('#name_edit').val(user.name)
                    $('#email_edit').val(user.email)
                    $('#phone_edit').val(user.phone)
                    $('#address_edit').val(user.address)
                },
            });
        });

        $("#form-edit-user").validate({
            rules: {
                name: { required: true },
                email: { required: true, email: true },
                phone: { required: true },
                address: { required: true },
                password: { required: true, minlength: 8 },
                password_confirmation: { required: true, equalTo: "#password" },
                role: { required: true },
            },
            messages: {
                name: { required: "Nama tidak boleh kosong" },
                email: { required: "Email tidak boleh kosong", email: 'Email tidak valid' },
                phone: { required: "Nomor HP tidak boleh kosong" },
                address: { required: "Alamat tidak boleh kosong" },
                role: { required: "Role tidak boleh kosong" },
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
                    name: $('#name_edit').val(),
                    email: $('#email_edit').val(),
                    phone: $('#phone_edit').val(),
                    address: $('#address_edit').val(),
                    role: $('#role_edit').val(),
                    _token: handle.token()
                }
                console.log(data)

                if (handle.checkEmail(data["email"])) {
                    $.ajax({
                        url: APP_URL + "/user/" + id,
                        type: "PUT",
                        data: data,
                        beforeSend: function () {
                            handle.spinner('#form-edit-user .btn-submit', 'hide')
                            handle.spinner('#form-edit-user .btn-loading', 'show')
                        },
                        success: function (res) {
                            if (res) {
                                handle.spinner('#form-edit-user .btn-submit', 'show')
                                handle.spinner('#form-edit-user .btn-loading', 'hide')
                                $("#table-users").DataTable().ajax.reload();
                                $("#form-edit-user")[0].reset();
                                $("#editUserModal").modal("hide");
                                handle.toastSuccess(res.messages)
                            }
                        },
                        error: (e, x, settings, exception) => {
                            handle.spinner('#form-edit-user .btn-submit', 'show')
                            handle.spinner('#form-edit-user .btn-loading', 'hide')
                            handle.errorhandle(e, x, settings, exception);
                        },
                    });
                } else {
                    handle.spinner('#form-edit-user .btn-submit', 'show')
                    handle.spinner('#form-edit-user .btn-loading', 'hide')
                    handle.toastError('Email tidak valid')
                }
            },
        });
    }


    deleteUser() {
        handle.setup();
        let id = '';
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
