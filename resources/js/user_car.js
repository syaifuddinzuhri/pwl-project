import { car } from "./module/user_car_module";

$(document).ready(function () {
    const pathURL = document.location.pathname;
    const splitURL = pathURL.split("/");

    if (pathURL == "/customer/car" || pathURL == "/customer/car/*") {
        car.showCar();
    }
});
