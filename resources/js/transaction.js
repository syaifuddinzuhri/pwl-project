import { transaction } from "./module/transaction_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/transaction" || pathURL == "/transaction/*") {
        transaction.dataTable();
        transaction.editTransaction();
        transaction.deleteTransaction();
    }

    $('.transaction .reload-table').on('click', function () {
        $("#table-transaction").DataTable().ajax.reload();
    })
});
