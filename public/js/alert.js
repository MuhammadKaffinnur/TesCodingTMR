document.addEventListener("DOMContentLoaded", function () {
    // Check if there's a success message in the session
    if (document.getElementById("success-alert")) {
        // Display the alert
        var successAlert = document.getElementById("success-alert");
        successAlert.style.display = "block";
        // Hide the alert after 3 seconds
        setTimeout(function () {
            successAlert.style.display = "none";
        }, 3000);
    }
});
