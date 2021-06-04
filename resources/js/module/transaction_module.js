import { handle } from "./handle_module";
class Transaction {
    dataTable() {
        handle.setup();
        $("#table-transaction").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: APP_URL + "/transaction",
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    className: "text-center",
                    width: "4%",
                },
                {
                    data: "user.name",
                    name: "user.name"
                },
                {
                    data: "car.merk",
                    name: "car.merk",
                },
                {
                    data: "car.no_plat",
                    name: "car.no_plat",
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
                    data: "date_of_return",
                    name: "date_of_return",
                },
                {
                    data: "proof_of_payment",
                    name: "proof_of_payment",
                },
                {
                    data: "payment_status",
                    name: "payment_status",
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

    editTransaction() {
        handle.setup();
        let id = "";
        let isActive = 0;

        $("#payment-status-edit").on("change", function () {
            $(this).is(":checked") ? (isActive = 1) : (isActive = 0);
        });

        $("#table-transaction").on("click", ".btn-edit-transaction", function () {
            id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/transaction/${id}/edit`,
                beforeSend: function () {
                    handle.spinner('#body-edit-transaction', 'hide')
                    handle.spinner('#loading', 'show')
                },
                success: function (res) {
                    handle.spinner('#loading-transaction', 'hide')
                    handle.spinner('#body-edit-transaction', 'show')
                    $('#name-user-edit').val(res.data.user.name);
                    $('#merk-car-edit').val(res.data.car.merk);
                    $('#no-plat-edit').val(res.data.car.no_plat);
                    $('#lease-date-edit').val(res.data.lease_date);
                    $('#return-date-edit').val(res.data.return_date);
                    $('#date-of-return-edit').val(res.data.date_of_return);
                    if(res.data.payment_status == 1 ){
                        $("#payment-status-edit").attr("checked", true);
                    }else{
                        $("#payment-status-edit").attr("checked", false);
                    }
                    $('#img-payment').html(`<img src="/proof_of_payment/${res.data.proof_of_payment}" class="img-responsive" width="300" height="200" />`);
                },
            });
        });

        $("#form-edit-transaction").on("submit", function (e) {
            e.preventDefault()
            var data = {
                payment_status: isActive,
                date_of_return: $("#date-of-return-edit").val(),
                _token: handle.token()
            };
            $.ajax({
                type: "PUT",
                url: APP_URL + "/transaction/" + id,
                data: data,
                beforeSend: function () {
                    handle.spinner('#editTransactionModal .btn-submit', 'hide')
                    handle.spinner('#editTransactionModal .btn-loading', 'show')
                },
                success: function (res) {
                    if (res) {
                        handle.spinner('#editTransactionModal .btn-loading', 'hide')
                        handle.spinner('#editTransactionModal .btn-submit', 'show')
                        $("#table-transaction").DataTable().ajax.reload();
                        $("#form-edit-transaction")[0].reset();
                        $("#editTransactionModal").modal("hide")
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#editTransactionModal .btn-loading', 'hide')
                    handle.spinner('#editTransactionModal .btn-submit', 'show')
                    handle.errorhandle(e, x, settings, exception);
                },
            });
        })
    }

    deleteTransaction() {
        handle.setup();
        let id = '';
        $("#table-transaction").on("click", ".btn-delete-transaction", function () {
            id = $(this).data('id');
        });
        $("#form-delete-transaction").on("submit", function (e) {
            var url = APP_URL + "/transaction/" + id
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
                        $("#table-transaction").DataTable().ajax.reload();
                        $("#deleteTransactionModal").modal("hide");
                        handle.toastSuccess(res.messages)
                    }
                },
                error: (e, x, settings, exception) => {
                    handle.spinner('#form-delete-transaction .btn-loading', 'hide')
                    handle.spinner('#form-delete-transaction .btn-submit', 'show')
                    var msg = "Hapus data gagal ";
                    handle.errorhandle(e, x, settings, exception, msg);
                },
            });
            e.preventDefault();
        });
    }
}

export const transaction = new Transaction();
