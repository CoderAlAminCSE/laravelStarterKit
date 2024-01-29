$(document).ready(function () {
    $("#smtpConnectionTest").on("click", function () {
        var $smtpButton = $(this);
        var $spinner = $smtpButton.find('.spinner-border');
        $smtpButton.prop("disabled", true);
        $spinner.removeClass('d-none');

        var route = $("#smtpConnectionTestRoute").val();

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: route,
            success: function (data) {
                if (data.error) {
                    handleError(data.error);
                } else {
                    handleSuccess(data.message);
                }
            },
            error: function () {
                handleError('Error: Something went wrong');
            },
            complete: function () {
                $smtpButton.prop("disabled", false);
                $spinner.addClass('d-none');
            },
        });
    });

    function handleSuccess(message) {
        configureToastr();
        toastr.success(message);
        console.log(message);
    }

    function handleError(error) {
        configureToastr();
        toastr.error(error);
        console.error(error);
    }

    function configureToastr() {
        toastr.options = {
            closeButton: false,
            debug: false,
            newestOnTop: false,
            progressBar: false,
            positionClass: "toastr-top-right",
            preventDuplicates: false,
            onclick: null,
            showDuration: "300",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        };
    }
});