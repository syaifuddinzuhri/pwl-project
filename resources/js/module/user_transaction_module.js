import { handle } from "./handle_module";
class UserTransaction {
    dataTable() {
        handle.setup();
        $("#table-transaction").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/customer/transaction",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "car_type",
                    name: "car_type",
                },
                {
                    data: "car.no_plat",
                    name: "car.no_plat",
                },
                {
                    data: "car.price",
                    name: "car.price",
                },
                {
                    data: "lease_date",
                    name: "lease_date",
                },
                {
                    data: "return_date",
                    name: "return_date",
                },
                {
                    data: "total",
                    name: "total",
                },
                {
                    data: "proof_of_payment",
                    render: function (data) {
                        if (data != null) {
                            var img = `${APP_URL}/storage/payment/${data}`;
                            return (
                                '<img src="' +
                                img +
                                '" class="img-responsive img-thumbnail" style="width: 100px"/>'
                            );
                        } else {
                            return "Silahkan Upload Bukti Pembayaran";
                        }
                    },
                },
                {
                    data: "payment_status",
                    name: "payment_status"
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

    uploadBukti() {
        handle.setup()
        $("#table-transaction").on("click", ".btn-bukti-transaction", function () {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/customer/transaction/upload-bukti-pembayaran/${id}`,
                beforeSend: function () {
                    $('#buktiTransactionModal #loading').show()
                    $('#buktiTransactionModal .body-bukti-modal').hide()
                },
                success: function (res) {
                    $('#buktiTransactionModal #loading').hide()
                    $('#buktiTransactionModal .body-bukti-modal').show()
                    $('#buktiTransactionModal .body-bukti-modal').html(res.html)
                }
            });
        });
    }

    detailTransaction() {
        handle.setup()
        $("#table-transaction").on("click", ".btn-detail-transaction", function () {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/customer/transaction/${id}`,
                beforeSend: function () {
                    $('#detailTransactionModal #loading').show()
                    $('#detailTransactionModal .body-detail-modal').hide()
                },
                success: function (res) {
                    $('#detailTransactionModal #loading').hide()
                    $('#detailTransactionModal .body-detail-modal').show()
                    $('#detailTransactionModal .body-detail-modal').html(res.html)
                }
            });
        });
    }

    deleteTransaction() {
        handle.setup();
        let id = '';
        $("#table-transaction").on("click", ".btn-delete-transaction", function () {
            id = $(this).data('id');
        });
        $("#form-delete-transaction").on("submit", function (e) {
            var url = APP_URL + "/customer/transaction/" + id
            var form = $(this);
            $.ajax({
                url: url,
                type: "DELETE",
                data: form.serialize(),
                beforeSend: function () {
                    handle.spinner('#form-delete-transaction .btn-submit', 'hide')
                    handle.spinner('#form-delete-transaction .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#form-delete-transaction .btn-loading', 'hide')
                        handle.spinner('#form-delete-transaction .btn-submit', 'show')
                        $("#table-transactions").DataTable().ajax.reload();
                        $("#deleteTransactionModal").modal("hide");
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

export const transaction = new UserTransaction();
