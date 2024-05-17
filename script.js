$(document).ready(function() {
    // Login form submission
    $("#loginForm").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "login.php",
            data: formData,
            success: function(response) {
                $("#message").html(response);
            }
        });
    });

    // Register form submission
    $("#registerForm").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "register.php",
            data: formData,
            success: function(response) {
                $("#message").html(response);
            }
        });
    });
});
