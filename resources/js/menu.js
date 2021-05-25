import { menu } from "./module/menu_module";
import { submenu } from "./module/submenu_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/menu" || pathURL == "/menu/*") {
        menu.dataTable();
        menu.addMenu();
        menu.editMenu();
        menu.deleteMenu();
        submenu.dataTable();
        submenu.addSubmenu();
        submenu.editSubmenu();
        submenu.deleteSubmenu();
        $('.menu .reload-table').on('click', function () {
            $("#table-menus").DataTable().ajax.reload();
        })
        $('.submenu .reload-table').on('click', function () {
            $("#table-submenus").DataTable().ajax.reload();
        })
    }
});
