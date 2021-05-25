import { car } from "./module/car_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/car" || pathURL == "/car/*") {
        car.dataTable();
        car.deleteCar();
        car.showCar();
        car.changeFile("form-add-car", "image")
        $('.cars .reload-table').on('click', function () {
            $("#table-cars").DataTable().ajax.reload();
        })
    }

    if (splitURL.pop() == "edit") {
        car.changeFile("form-edit-car", "image")
    }
});
