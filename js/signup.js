
// pass confirm check
$(".toggle-pass").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});

// show pass warn 
$(function () {
    $(".submit_btn").click(function () {
        var password = $("#pass").val();
        var confirmPassword = $("#pass_conf").val();
        if (password != confirmPassword) {
            $(".warn").css("display", "block");
            return false;
        }
        return true;
    });
});

// hide pass warn
$('.pw').on('input', function () {
    $(".warn.pw").css("display", "none");
});
