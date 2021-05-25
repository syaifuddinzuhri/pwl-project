import { handle } from "./handle_module";
class CarType {
    dataTable() {
        handle.setup();
        $("#table-car-types").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/car-type",
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

    addCarType() {
        $("#form-add-car-type").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "POST",
                url: `${APP_URL}/car-type`,
                data: data,
                beforeSend: function () {
                    handle.spinner('#form-add-car-type .btn-submit', 'hide')
                    handle.spinner('#form-add-car-type .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-add-car-type .btn-loading', 'hide')
                        handle.spinner('#form-add-car-type .btn-submit', 'show')
                        $("#table-car-types").DataTable().ajax.reload();
                        $("#form-add-car-type")[0].reset();
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-add-car-type .btn-loading', 'hide')
                    handle.spinner('#form-add-car-type .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    editCarType() {
        handle.setup();
        var id = "";

        $("#table-car-types").on("click", ".btn-edit-car-type", function () {
            id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/car-type/${id}/edit`,
                beforeSend: function () {
                    handle.spinner('#body-edit-car-type', 'hide')
                    handle.spinner('#loading', 'show')
                },
                success: function (res) {
                    handle.spinner('#loading', 'hide')
                    handle.spinner('#body-edit-car-type', 'show')
                    $('#name-edit').val(res.data.name);
                },
            });
        });

        $("#form-edit-car-type").on("submit", function (e) {
            e.preventDefault()
            var data = {
                name: $("#name-edit").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "PUT",
                url: APP_URL + "/car-type/" + id,
                data: data,
                beforeSend: function () {
                    handle.spinner('#editCarTypeModal .btn-submit', 'hide')
                    handle.spinner('#editCarTypeModal .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#editCarTypeModal .btn-loading', 'hide')
                        handle.spinner('#editCarTypeModal .btn-submit', 'show')
                        $("#table-car-types").DataTable().ajax.reload();
                        $("#form-edit-car-type")[0].reset();
                        $("#editCarTypeModal").modal("hide")
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#editCarTypeModal .btn-loading', 'hide')
                    handle.spinner('#editCarTypeModal .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    deleteCarType() {
        handle.setup();
        let id = '';
        $("#table-car-types").on("click", ".btn-delete-car-type", function () {
            id = $(this).data('id');
        });
        $("#form-delete-car-type").on("submit", function (e) {
            var url = APP_URL + "/car-type/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    handle.spinner('#form-delete-car-type .btn-submit', 'hide')
                    handle.spinner('#form-delete-car-type .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-delete-car-type .btn-loading', 'hide')
                        handle.spinner('#form-delete-car-type .btn-submit', 'show')
                        $("#table-car-types").DataTable().ajax.reload();
                        $("#deleteCarTypeModal").modal("hide");
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-delete-car-type .btn-loading', 'hide')
                    handle.spinner('#form-delete-car-type .btn-submit', 'show')
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }

}

export const carType = new CarType();
