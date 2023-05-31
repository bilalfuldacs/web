@if(isset($totalTime))

{{ $totalTime['hours'] ??'NUll' }} hours: {{ $totalTime['minutes'] }} minutes
@endif
<section class="content" style="margin-left:20px;margin-right:20px;margin-top:50px;">
    Total Hours Worked </h3>

    <label for="cars">Select Chart Style</label>
    <select name="chart" onchange="myFunction()" class="form-control" id="chart" style="width:120px;">
        <option value="pie">Pie</option>
        <option value="column">Column</option>
        <option value="pyramid">Pyramid</option>
        <option value="bar">Bar</option>
    </select>

    {{--  Chart Out Put is printinh here  --}}

    <div class="product-index" align="right" style="margin-top:40px;">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    </div>


</section>

<script>
function myFunction() {
    var chartType = document.getElementById("chart").value;

    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: "Working Sheet"
        },
        subtitles: [{}],
        axisY: {
            minimum: 0,
            maximum: 24 * 60, // 24 hours in minutes
            interval: 60, // 1 hour interval
            labelFormatter: function(e) {
                var hours = Math.floor(e.value / 60);
                return hours;
            }
        },
        data: [{
            type: chartType,
            yValueFormatString: "HH:mm",
            indexLabel: "({hours}:{minutes})",
            dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
        }],
        toolTip: {
            contentFormatter: function(e) {
                var dataPoint = e.entries[0].dataPoint;
                var hours = Math.floor(dataPoint.hours);
                var minutes = dataPoint.minutes;
                return '<div style="padding: 10px;">' + hours + ':' + minutes + '</div>';
            }
        }
    });

    chart.render();
}

// Function to create and render the chart
function myFunctionDemo() {
    // Get the chart type from the dropdown element
    var chartType = document.getElementById("chart").value;

    // Create a new CanvasJS chart instance with the given chart type and options
    var chart = new CanvasJS.Chart("chartContainer", {
        // Enable animation for the chart
        animationEnabled: true,
        // Set the chart title
        title: {
            text: "Working Sheet"
        },
        // Add subtitles to the chart (empty in this case)
        subtitles: [{}],
        // Configure the y-axis properties
        axisY: {
            // Set the minimum value to 0
            minimum: 0,
            // Set the maximum value to 24 hours (in minutes)
            maximum: 24 * 60,
            // Set the interval to 1 hour (60 minutes)
            interval: 60,
            // Use a custom label formatter to display the y-axis labels in hours format
            labelFormatter: function(e) {
                var hours = Math.floor(e.value / 60);
                return hours;
            }
        },
        // Define the data points for the chart
        data: [{
            // Set the data type to the chart type selected from the dropdown
            type: chartType,
            // Set the yValueFormatString to display hours and minutes
            yValueFormatString: "HH:mm",
            // Set the indexLabel to display hours and minutes
            indexLabel: "({hours}:{minutes})",
            // Get the data points from the data array
            dataPoints: <?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>
        }],
        // Configure the tooltip to display the hours and minutes using the custom label formatter
        toolTip: {
            contentFormatter: function(e) {
                var dataPoint = e.entries[0].dataPoint;
                var hours = Math.floor(dataPoint.hours);
                var minutes = dataPoint.minutes;
                return '<div style="padding: 10px;">' + hours + ':' + minutes + '</div>';
            }
        }
    });

    // Render the chart
    chart.render();
}

// window.onload = function() {


// }
</script>

<body>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>