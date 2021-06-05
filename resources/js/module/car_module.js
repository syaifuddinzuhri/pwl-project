import { handle } from "./handle_module";
class Car {
    dataTable() {
        handle.setup();
        $("#table-cars").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/car",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "image",
                    render: function (data) {
                        if (data != null) {
                            var img = `${APP_URL}/storage/car/${data}`;
                            return (
                                '<img src="' +
                                img +
                                '" class="img-responsive img-thumbnail" style="width: 100px"/>'
                            );
                        } else {
                            return "";
                        }
                    },
                },
                {
                    data: "car_type",
                    name: "car_type",
                },
                {
                    data: "merk",
                    name: "merk",
                },
                {
                    data: "no_plat",
                    name: "no_plat",
                },
                {
                    data: "status",
                    name: "status",
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

    changeFile(form, input) {
        $('#' + input).on("change", function (e) {
            e.preventDefault()
            if (this.files && this.files[0]) {
                var name = this.files[0]["name"]
                $("#" + form + "label[for='image']").text(name)
                var reader = new FileReader()
                reader.onload = (e) => {
                    $("#" + form + " > #show-image").show()
                    $("#" + form + " > #show-image > img").attr("src", e.target.result)
                }
                reader.readAsDataURL(this.files[0])
            }
        })
    }

    showCar() {
        handle.setup()
        $("#table-cars").on("click", ".btn-show-car", function () {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/car/${id}`,
                beforeSend: function () {
                    $('#showCarModal #loading').show()
                    $('#showCarModal .body-show-car').hide()
                },
                success: function (res) {
                    $('#showCarModal #loading').hide()
                    $('#showCarModal .body-show-car').show()
                    $('#showCarModal .body-show-car').html(res.html)
                }
            });
        });
    }

    statusCar() {
        handle.setup()
        $("#table-cars").on("click", ".btn-status-car", function () {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/car/get-status/${id}`,
                beforeSend: function () {
                    $('#statusCarModal #loading').show()
                    $('#statusCarModal .body-status-car').hide()
                },
                success: function (res) {
                    $('#statusCarModal #loading').hide()
                    $('#statusCarModal .body-status-car').show()
                    $('#statusCarModal .body-status-car').html(res.html)
                }
            });
        });
    }

    deleteCar() {
        handle.setup();
        let id = '';
        $("#table-cars").on("click", ".btn-delete-car", function () {
            id = $(this).data('id');
        });
        $("#form-delete-car").on("submit", function (e) {
            var url = APP_URL + "/car/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    handle.spinner('#form-delete-car .btn-submit', 'hide')
                    handle.spinner('#form-delete-car .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-delete-car .btn-loading', 'hide')
                        handle.spinner('#form-delete-car .btn-submit', 'show')
                        $("#table-cars").DataTable().ajax.reload();
                        $("#deleteCarModal").modal("hide");
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-delete-car .btn-loading', 'hide')
                    handle.spinner('#form-delete-car .btn-submit', 'show')
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const car = new Car();
