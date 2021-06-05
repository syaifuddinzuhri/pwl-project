import { handle } from "./handle_module";
class UserCar {
    showCar() {
        handle.setup()
        $("#data-cars").on("click", ".btn-show-car", function () {
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                url: `${APP_URL}/customer/car/${id}`,
                beforeSend: function () {
                    $('#showCarModal #loading').show()
                    $('#showCarModal .body-show-car').hide()
                },
                success: function (res) {
                    $('#showCarModal #loading').hide()
                    $('#showCarModal .body-show-car').show()
                    $('#showCarModal .body-show-car').html(res.html)
                }
            });
        });
    }
}

export const car = new UserCar();
