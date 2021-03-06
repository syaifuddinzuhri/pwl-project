import { user } from "./module/user_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/user" || pathURL == "/user/*") {
        user.dataTable();
        user.deleteUser();
        $('.users .reload-table').on('click', function () {
            $("#table-users").DataTable().ajax.reload();
        })
    }
});
