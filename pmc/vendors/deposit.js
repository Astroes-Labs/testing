var api = "../api.php";
$(document).ready(function () {
  $("#amount").on("input", function () {
    var value = $(this).val();
    // Allow digits and a single decimal point
    value = value.replace(/[^0-9.]/g, ""); // Remove non-numeric and non-decimal characters

    // Ensure that there is only one decimal point
    var parts = value.split(".");
    if (parts.length > 2) {
      value = parts[0] + "." + parts.slice(1).join(""); // Join extra decimal points
    }
    $(this).val(value);
  });
  var activeTab = "BTC";

  function setTab(activeTab, tabData) {
    var lowerText = activeTab.toLowerCase();
    $("#qr-img").attr("src", "../images/" + tabData[lowerText + "qr"]);
    $("#main-title").html(activeTab + " Deposit");
    $("#wallet-address").val(tabData[lowerText + "addr"]);
    localStorage.setItem("crypto", activeTab);
  }
  //var tabData = <?php echo $depData?>;
  setTab(activeTab, tabData);
  $("#btc-tab").click(function () {
    setTab("BTC", tabData);
  });
  $("#eth-tab").click(function () {
    setTab("ETH", tabData);
  });
  $("#xrp-tab").click(function () {
    setTab("XRP", tabData);
  });
  $("#usdt-tab").click(function () {
    setTab("USDT", tabData);
  });
  $("#bch-tab").click(function () {
    setTab("BCH", tabData);
  });

  $("#deposit-form").submit(function (event) {
    event.preventDefault();
    $("#spinner").show();
    var amount = $("#amount").val().trim();

    // Basic validation
    if (amount === "") {
      showToast("danger-lighter", "Please Enter an Amount.");
      $("#spinner").hide();
      return;
    }

    // AJAX request
    $.ajax({
      url: api,
      method: "POST",
      data: {
        amount: amount,
        deposit: "deposit",
        crypto: localStorage.getItem("crypto"),
      },
      success: function (response) {
        if (response.message === "Success") {
          showToast("success-lighter", "Deposit Pending Awaiting Confirmation");
          $("#amount").val("");
          $("#spinner").hide();
        }
        if (response.message === "Error") {
          $("#spinner").hide();
          showToast("danger-lighter", "Invalid Amount Entered");
        }
      },
      error: function (xhr, status, error) {
        // Handle error response
        alert("An error occurred: " + error);
      },
    });
  });
});

