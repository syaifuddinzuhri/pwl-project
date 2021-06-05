import { transaction } from "./module/user_transaction_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");
    if (splitURL[2] == "transaction") {
        transaction.dataTable();
        transaction.uploadBukti();
        transaction.deleteTransaction();
        transaction.detailTransaction();
    }
});
