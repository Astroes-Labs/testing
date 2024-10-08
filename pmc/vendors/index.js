
      $(document).ready(function () {
        $('#hashrate').html(tabData['hashrate']);
        $('#avg3').html(tabData['avg3']);
        $('#avg24').html(tabData['avg24']);
        $('#user-email').html(tabData['email']);
        $('#payout-day').html(tabData['payoutday']);
        $('#payout-week').html(tabData['payoutmonth']);
        $('#payout-month').html(tabData['payoutyear']);
        $('#plan-name').html(tabData['plan_name']);
        getData("BTC");
        $('#select-gross-revenue-month').change(function() {
            var selectedValue = $(this).val();
            getData(selectedValue);
        });

        function getData(selectedValue){
          var lowerText = selectedValue.toLowerCase();
            $('.coin-name').each(function() {
                    $(this).html(selectedValue);
            });
            var coinBal = tabData[lowerText+'_balance'];
            var coinPrice = tabData[lowerText+'_price'];
            var coinBalUsd = coinBal * coinPrice;
            coinBalUsd = formatCurrency(coinBalUsd);
            $('#coin-bal-usd').html(coinBalUsd);
            $('#coin-bal').html(coinBal);
            $('#gas-price-sym').html(tabData[lowerText+'_gas']);
            $('#avg-coin').html('9.084');
            var avgUsd = 9.084 * coinPrice;
            avgUsd = formatCurrency(avgUsd);
            $('#avg-usd').html(avgUsd);
        }
        function formatCurrency(value) {
            // Convert the value to a float and format it as currency
            return '$' + parseFloat(value).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

      });
