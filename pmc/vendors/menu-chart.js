
$(document).ready(function () {
    // Initialize the ApexCharts radial bar chart
    var options = {
      series: [67],
      chart: {
        height: 350,
        type: "radialBar",
        offsetY: -10,
      },
      plotOptions: {
        radialBar: {
          startAngle: -135,
          endAngle: 135,
          dataLabels: {
            name: {
              fontSize: "16px",
              color: "#3874ff",
              offsetY: 120,
            },
            value: {
              offsetY: 76,
              fontSize: "22px",
              color: "#85a9ff",
              formatter: function (val) {
                return val + "";
              },
            },
          },
        },
      },
      fill: {
        type: "gradient",
        gradient: {
          shade: "dark",
          shadeIntensity: 0.15,
          inverseColors: false,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 50, 65, 91],
        },
      },
      stroke: {
        dashArray: 4,
      },
      labels: [""],
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // Function to animate the radial bar value
    function animateValue(start, end, duration) {
      var startTime = null;
      var interval = 10; // Update interval in milliseconds

      function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = timestamp - startTime;
        var value = Math.min(
          start + (end - start) * (progress / duration),
          end
        );

        chart.updateOptions({
          series: [Math.round(value)],
        });

        if (progress < duration) {
          window.requestAnimationFrame(step);
        } else {
          // Swap start and end values for next animation
          var temp = start;
          start = end;
          end = temp;
          startTime = null;
          window.requestAnimationFrame(function () {
            step(0);
          });
        }
      }

      window.requestAnimationFrame(step);
    }

    // Start the animation
    animateValue(0, 90, 2000); // From 30 to 90 over 2 seconds
  });