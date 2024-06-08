@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Tabel History Sensor</h5>
                        </div>
                    </div>
                    <div>
                        <label for="sensor-type">Filter by Type:</label>
                        <select id="sensor-type" class="form-select mb-3">
                            <option value="">All</option>
                            <option value="temperature">Temperature</option>
                            <option value="humidity">Humidity</option>
                            <option value="moisture">Moisture</option>
                            <option value="intensity">Intensity</option>
                        </select>
                        <table id="sensor-table" class="table display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <!-- Data will be populated by DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Containers -->
    <div id="sensor-humidity" style="height: 400px; width: 100%;"></div>
    <div id="sensor-intensity" style="height: 400px; width: 100%;"></div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            var table = $('#sensor-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sensors.history') }}",
                    type: "GET",
                    data: function(d) {
                        d.type = $('#sensor-type').val();
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'type' },
                    { data: 'value' },
                    { data: 'created_at' }
                ]
            });

            // Event listener to the type filter
            $('#sensor-type').change(function() {
                table.ajax.reload();
            });

            // Function to periodically reload the data
            setInterval(function() {
                table.ajax.reload(null, false); // Reload data without resetting the paging
            }, 5000); // Reload every 5 seconds

            // Initialize Highcharts
            const humidityChart = Highcharts.chart('sensor-humidity', {
                title: {
                    text: 'Humidity Data'
                },
                xAxis: {
                    tickInterval: 1,
                    type: 'datetime',
                },
                yAxis: {
                    title: {
                        text: 'Humidity (%)'
                    },
                    labels: {
                        format: '{value}%'
                    },
                    lineWidth: 2
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br />',
                    pointFormat: 'Time: {point.x}, Humidity: {point.y}%'
                },
                series: [{
                    name: 'Humidity',
                    data: [] // Initialize with empty data
                }]
            });

            // Function to get data for Highcharts
            function getDataSensorHumidity() {
                $.ajax({
                    url: "{{ route('sensors.index') }}?type=humidity",
                    type: "GET",
                    success: function(response) {
                        let data = response.data.map(item => {
                            let date = new Date(item.created_at);
                            return [date.getTime(), item.value];
                        });
                        humidityChart.series[0].setData(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            // Periodically fetch data for Highcharts
            setInterval(getDataSensorHumidity, 5000); // Fetch data every 5 seconds

            // Initialize ApexCharts
            var options = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: 'Intensity',
                    data: []
                }],
                xaxis: {
                    type: 'datetime'
                }
            };

            var intensityChart = new ApexCharts(document.querySelector("#sensor-intensity"), options);
            intensityChart.render();

            // Function to get data for ApexCharts
            function getDataSensorIntensity() {
                $.ajax({
                    url: "{{ route('sensors.index') }}?type=intensity",
                    type: "GET",
                    success: function(response) {
                        let data = response.data.map(item => {
                            let date = new Date(item.created_at);
                            return {x: date.getTime(), y: item.value};
                        });
                        intensityChart.updateSeries([{
                            data: data
                        }]);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            // Periodically fetch data for ApexCharts
            setInterval(getDataSensorIntensity, 5000); // Fetch data every 5 seconds
        });
    </script>
@endsection
