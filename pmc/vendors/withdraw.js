
      var api = "../api.php";
      $(document).ready(function () {
        $("#amount-btc, #amount-eth").on("input", function () {
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

        $("#withdraw-form").submit(function (event) {
          event.preventDefault();
          submitDeposit('btc-address', 'amount-btc', 'BTC', 'spinner');
        });
        $("#withdraw-form2").submit(function (event) {
          event.preventDefault();
          submitDeposit('eth-address', 'amount-eth', 'ETH', 'spinner2');
        });
        function submitDeposit(addressId, amountId, crypto, spinnerId) {
          $("#" + spinnerId).show();
          var wallet_addr = $("#" + addressId)
            .val()
            .trim();
          var amountcrypto = $("#" + amountId)
            .val()
            .trim();

          // Basic validation
          if (amountcrypto === "" || wallet_addr === "") {
            showToast("danger-lighter", "Please Complete all the field");
            $("#" + spinnerId).hide();
            return;
          }

          // AJAX request
          $.ajax({
            url: api,
            method: "POST",
            data: {
              amount: amountcrypto,
              withdraw: "withdraw",
              wallet_addr: wallet_addr,
              crypto: crypto,
            },
            success: function (response) {
              if (response.message === "Success") {
                showToast(
                  "success-lighter",
                  "Withdrawal Processing.... Awaiting Confirmation"
                );
                $("#" + addressId).val("");
                $("#" + amountId).val("");
                $("#" + spinnerId).hide();
              }
              if (response.message === "Error") {
                $("#" + spinnerId).hide();
                showToast("danger-lighter", response.alert);
              }
            },
            error: function (xhr, status, error) {
              // Handle error response
              alert("An error occurred: " + error);
            },
          });
        }
      });