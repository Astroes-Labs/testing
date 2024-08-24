var api = "../api.php";
$("#logout-btn").click(function () {
  console.log("logout");
  $.ajax({
    url: api, // Replace with your server endpoint
    method: "POST",
    data: {
      logOut: "logout",
    },
    success: function (response) {
      console.log(response);
      if (response.message === "Success") {
        window.location.href = "login.html";
      }
    },
    error: function (xhr, status, error) {
      // Handle error response
      showToast("danger-lighter", "An error occurred: " + error);
    },
  });
});

$(document).ready(function () {
  // Get the current URL file name (e.g., "index.html")
  var currentFileName = window.location.pathname.split("/").pop();

  // Iterate over each nav link
  $(".navbar-nav .nav-link").each(function () {
    // Extract the file name from the href attribute
    var linkFileName = $(this).attr("href").split("/").pop();

    // Compare the current file name with the link's file name
    if (currentFileName === linkFileName) {
      // Add the active class to the matching link
      $(this).addClass("active");
    } else {
      // Optionally remove the active class from other links
      $(this).removeClass("active");
    }
  });
});

$(document).ready(function () {
  $("#copy-address").click(function () {
    // Get the value of the wallet address
    var walletAddress = $("#wallet-address").val();

    // Create a temporary input element to use for copying to clipboard
    var $tempInput = $("<input>");
    $("body").append($tempInput);
    $tempInput.val(walletAddress).select();
    document.execCommand("copy");
    $tempInput.remove();
    if(page === 'referral'){
        alert("Referral link copied: " + walletAddress);
    }else{
        // Show alert with the copied address
        alert("Wallet address copied: " + walletAddress);
    }
  });
});
