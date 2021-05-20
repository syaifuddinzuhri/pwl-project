import { permission } from "./module/permission_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/permission" || pathURL == "/permission/*") {
        permission.dataTable();
        permission.addPermission();
        permission.editPermission();
        permission.deletePermission();
        $('.permissions .reload-table').on('click', function () {
            $("#table-permissions").DataTable().ajax.reload();
        })
    }
});
