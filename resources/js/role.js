import { role } from "./module/role_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (splitURL.pop() == 'edit') {
        $('#selectAll').change(function () {
            if ($(this).is(':checked')) {
                $("input[name='permissions[]']").each(function () {
                    $(this).attr('checked', true)
                })
            } else {
                $("input[name='permissions[]']").each(function () {
                    $(this).attr('checked', false)
                })
            }
        });
        role.updateRole()
    }

    if (pathURL == "/role" || pathURL == "/role/*") {
        role.dataTable();
        role.deleteRole();
        role.addRole()
        $('.roles .reload-table').on('click', function () {
            $("#table-roles").DataTable().ajax.reload();
        })
    }
});
