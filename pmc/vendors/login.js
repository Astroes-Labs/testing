$(document).ready(function () {
  // Check localStorage and populate fields
  var cemail = localStorage.getItem("email");
  var cpassword = localStorage.getItem("password");
  if (cemail && cemail.length > 3) {
    $("#email").val(cemail);
  } else {
    $("#email").val("");
  }
  if (cpassword && cpassword.length > 3) {
    $("#password").val(cpassword);
    $("#confirmPassword").val(cpassword); // Assuming you want to populate confirm password too
    $("#remember-me").prop("checked", true); // Check the checkbox
  } else {
    $("#password").val("");
    $("#confirmPassword").val("");
    $("#remember-me").prop("checked", false); // Uncheck the checkbox
  }

  var api = "../api.php";
  // Handle form submission
  $("#login-form").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission
    $('#spinner').show();
    var email = $("#email").val().trim();
    var password = $("#password").val().trim();
    var rememberMe = $("#remember-me").is(":checked");

    // Basic validation
    if (email === "" || password === "") {
      showToast("danger-lighter", "Please fill in both fields.");
      return;
    }

    // AJAX request
    $.ajax({
      url: api, // Replace with your server endpoint
      method: "POST",
      data: {
        email: email,
        password: password,
        login: "login",
      },
      success: function (response) {
        // Handle successful response

        if (response.message === "Login Success") {
          if (rememberMe) {
            // Store email and password in local storage
            localStorage.setItem("email", email);
            localStorage.setItem("password", password);
          } else {
            // Remove email and password from local storage
            localStorage.removeItem("email");
            localStorage.removeItem("password");
          }
          showToast("success-lighter", "Login successful!");
          setTimeout(function () {
            window.location.href = "index.html";
          }, 3000);
        }
        if (response.message === "Login Error") {
          
          $('#spinner').hide();
          showToast("danger-lighter", "Invalid Username/Password");
        }
      },
      error: function (xhr, status, error) {
        // Handle error response
        alert("An error occurred: " + error);
      },
    });
  });
});
