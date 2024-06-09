@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Grafik Temperature Sensor</h5>
                        </div>
                    </div>
                    <div id="sensor-suhu"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Grafik Humidity Sensor</h5>
                        </div>
                    </div>
                    <div id="sensor-humidity"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Grafik Moisture Sensor </h5>
                        </div>
                    </div>
                    <div id="sensor-moisture"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Grafik Intensity Sensor</h5>
                        </div>
                    </div>
                    <div id="sensor-intensitas"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        let dataSensorSuhu = [];
        const chart = new Highcharts.Chart('sensor-suhu', {
            title: {
                text: ''
            },

            xAxis: {
                tickInterval: 1,
                type: 'datetime',
            },

            yAxis: {
                title: {
                    text: 'Temperature'
                },
                labels: {
                    format: '{value}°'
                },
                accessibility: {
                    rangeDescription: 'Dari: 0°C Sampai 100°C.'
                },
                lineWidth: 2
            },

            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu = {point.x:%H:%M:%S}, Temperature = {point.y}°'
            },

            series: [{
                name: 'Temperature',
                data: dataSensorSuhu,
            }]
        });

        function getDataSensorSuhu() {
            $.ajax({
                url: "{{ route('sensors.index') }}?type=temperature",
                type: "GET",
                success: function(response) {
                    dataSensorSuhu = [];
                    $.each(response, function(index, item) {
                        let date = new Date(item.created_at);
                        dataSensorSuhu.push([date.getTime(), item.value]);
                    });
                    dataSensorSuhu = dataSensorSuhu.reverse();
                    chart.series[0].setData(dataSensorSuhu);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorSuhu() {
            $.ajax({
                url: "{{ route('sensors.store') }}",
                type: "POST",
                data: {
                    type: "temperature",
                    value: Math.floor(Math.random() * 100) + 1
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorSuhuSetiapDetik() {
            setInterval(function() {
                sendDataSensorSuhu();
            }, 2000);
        }

        function getDataSensorSuhuSetiapDetik() {
            setInterval(function() {
                getDataSensorSuhu();
            }, 1000);
        }
        getDataSensorSuhuSetiapDetik();
        // sendDataSensorSuhuSetiapDetik();
    </script>
    <script>
        let dataSensorHumidity = [];
        const humiditychart = new Highcharts.Chart('sensor-humidity', {
            title: {
                text: ''
            },

            xAxis: {
                tickInterval: 1,
                type: 'datetime',
            },

            yAxis: {
                title: {
                    text: 'Humidity'
                },
                labels: {
                    format: '{value}%'
                },
                accessibility: {
                    rangeDescription: 'Dari: 0% Sampai 100%.'
                },
                lineWidth: 2
            },

            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu ={point.x:%H:%M:%S}, Humidity = {point.y}%'
            },

            series: [{
                name: 'Humidity',
                data: dataSensorHumidity,
            }]
        });

        function getDataSensorHumidity() {
            $.ajax({
                url: "{{ route('sensors.index') }}?type=humidity",
                type: "GET",
                success: function(response) {
                    dataSensorHumidity = [];
                    $.each(response, function(index, item) {
                        let date = new Date(item.created_at);
                        dataSensorHumidity.push([date.getTime(), item.value]);
                    });
                    dataSensorHumidity = dataSensorHumidity.reverse();
                    humiditychart.series[0].setData(dataSensorHumidity);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorHumidity() {
            $.ajax({
                url: "{{ route('sensors.store') }}",
                type: "POST",
                data: {
                    type: "humidity",
                    value: Math.floor(Math.random() * 100) + 1
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorHumiditySetiapDetik() {
            setInterval(function() {
                sendDataSensorHumidity();
            }, 2000);
        }

        function getDataSensorHumiditySetiapDetik() {
            setInterval(function() {
                getDataSensorHumidity();
            }, 1000);
        }
        getDataSensorHumiditySetiapDetik();
        // sendDataSensorHumiditySetiapDetik();
    </script>

    <script>
        let dataSensorMoisture = [];
        const moistureChart = new Highcharts.Chart('sensor-moisture', {
            title: {
                text: ''
            },

            xAxis: {
                tickInterval: 1,
                type: 'datetime',
            },

            yAxis: {
                title: {
                    text: 'Moisture'
                },
                labels: {
                    format: '{value}%'
                },
                accessibility: {
                    rangeDescription: 'Dari: 0% Sampai 100%.'
                },
                lineWidth: 2
            },

            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu = {point.x:%H:%M:%S}, Moisture = {point.y}%'
            },

            series: [{
                name: 'Moisture',
                data: dataSensorMoisture,
            }]
        });

        function getDataSensorMoisture() {
            $.ajax({
                url: "{{ route('sensors.index') }}?type=moisture",
                type: "GET",
                success: function(response) {
                    dataSensorMoisture = [];
                    $.each(response, function(index, item) {
                        let date = new Date(item.created_at);
                        dataSensorMoisture.pus([date.getTime(), item.value]);
                    });
                    dataSensorMoisture = dataSensorMoisture.reverse();
                    moistureChart.series[0].setData(dataSensorMoisture);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorMoisture() {
            $.ajax({
                url: "{{ route('sensors.store') }}",
                type: "POST",
                data: {
                    type: "moisture",
                    value: Math.floor(Math.random() * 100) + 1
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorMoistureSetiapDetik() {
            setInterval(function() {
                sendDataSensorMoisture();
            }, 2000);
        }

        function getDataSensorMoistureSetiapDetik() {
            setInterval(function() {
                getDataSensorMoisture();
            }, 1000);
        }
        getDataSensorMoistureSetiapDetik();
        // sendDataSensorMoistureSetiapDetik();
    </script>

    <script>
        let dataSensorIntensity = [];
        const intensityChart = new Highcharts.Chart('sensor-intensitas', {
            title: {
                text: ''
            },

            xAxis: {
                tickInterval: 1,
                type: 'datetime',
            },

            yAxis: {
                title: {
                    text: 'Intensity'
                },
                labels: {
                    format: '{value}%'
                },
                accessibility: {
                    rangeDescription: 'Dari: 0% Sampai 100%.'
                },
                lineWidth: 2
            },

            tooltip: {
                headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'Waktu = {point.x:%H:%M:%S}, Intensity = {point.y}%'
            },

            series: [{
                name: 'Intensity',
                data: dataSensorIntensity,
            }]
        });

        function getDataSensorIntensity() {
            $.ajax({
                url: "{{ route('sensors.index') }}?type=intensity",
                type: "GET",
                success: function(response) {
                    dataSensorIntensity = [];
                    $.each(response, function(index, item) {
                        let date = new Date(item.created_at);
                        let jakartaTime = new Intl.DateTimeFormat('en-US', {
                                timeZone: 'Asia/Jakarta',
                                year: 'numeric',
                                month: 'numeric',
                                day: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                second: 'numeric'
                            }).format(date);
                        dataSensorIntensity.push([new Date(jakartaTime).getTime(), item.value]);
                    });
                    dataSensorIntensity = dataSensorIntensity.reverse();
                    intensityChart.series[0].setData(dataSensorIntensity);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorIntensity() {
            $.ajax({
                url: "{{ route('sensors.store') }}",
                type: "POST",
                data: {
                    type: "intensity",
                    value: Math.floor(Math.random() * 100) + 1
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function sendDataSensorIntensitySetiapDetik() {
            setInterval(function() {
                sendDataSensorIntensity();
            }, 5000);
        }

        function getDataSensorIntensitySetiapDetik() {
            setInterval(function() {
                getDataSensorIntensity();
            }, 1000);
        }
        getDataSensorIntensitySetiapDetik();
        sendDataSensorIntensitySetiapDetik();
    </script>
@endpush
