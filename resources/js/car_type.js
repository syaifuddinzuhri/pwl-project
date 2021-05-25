import { carType } from "./module/car_type_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/car-type" || pathURL == "/car-type/*") {
        carType.dataTable();
        carType.deleteCarType();
        carType.addCarType();
        carType.editCarType();
        $('.car-types .reload-table').on('click', function () {
            $("#table-car-types").DataTable().ajax.reload();
        })
    }
});
