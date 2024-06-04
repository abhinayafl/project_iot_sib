@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Grafik Sensor Suhu</h5>
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
                            <h5 class="card-title fw-semibold">Grafik Sensor Kelembapan</h5>
                        </div>
                    </div>
                    <div id="sensor-kelembapan"></div>
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
                            <h5 class="card-title fw-semibold">Grafik Sensor Intensitas Cahaya</h5>
                        </div>
                    </div>
                    <div id="sensor-intensitas"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (async () => {
            Highcharts.chart('sensor-suhu', {
                chart: {
                    zooming: {
                        type: 'x'
                    }
                },
                title: {
                    text: '',
                    align: 'left'
                },
                subtitle: {
                    text: document.ontouchstart === undefined ?
                        '' : 'Pinch the chart to zoom in',
                    align: 'left'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Temperature'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [
                                    1,
                                    Highcharts.color(Highcharts.getOptions().colors[0])
                                    .setOpacity(0).get('rgba')
                                ]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                series: [{
                    type: 'area',
                    name: 'Temperature',
                    data: [1,23,21,1,23,31,31,33,1,2,12,5,26,63]
                }]
            });
        })();
    </script>
    <script>
        (async () => {
            Highcharts.chart('sensor-kelembapan', {
                chart: {
                    zooming: {
                        type: 'x'
                    }
                },
                title: {
                    text: '',
                    align: 'left'
                },
                subtitle: {
                    text: document.ontouchstart === undefined ?
                        '' : 'Pinch the chart to zoom in',
                    align: 'left'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Kelembapan'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [
                                    1,
                                    Highcharts.color(Highcharts.getOptions().colors[0])
                                    .setOpacity(0).get('rgba')
                                ]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                series: [{
                    type: 'area',
                    name: 'Kelembapan',
                    data: [1,23,21,1,23,31,31,33,1,2,12,5,26,63,1,23,21,1,23,31,31,33,1,2,12,5,26,63]
                }]
            });
        })();
    </script>
    <script>
        (async () => {
            Highcharts.chart('sensor-moisture', {
                chart: {
                    zooming: {
                        type: 'x'
                    }
                },
                title: {
                    text: '',
                    align: 'left'
                },
                subtitle: {
                    text: document.ontouchstart === undefined ?
                        '' : 'Pinch the chart to zoom in',
                    align: 'left'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Moisture'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [
                                    1,
                                    Highcharts.color(Highcharts.getOptions().colors[0])
                                    .setOpacity(0).get('rgba')
                                ]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                series: [{
                    type: 'area',
                    name: 'Moisture',
                    data: [1,23,21,1,23,31,31,33,1,2,12,5,26,63,1,23,21,1,23,31,31,33,1,2,12,5,26,63]
                }]
            });
        })();
    </script>
    <script>
        (async () => {
            Highcharts.chart('sensor-intensitas', {
                chart: {
                    zooming: {
                        type: 'x'
                    }
                },
                title: {
                    text: '',
                    align: 'left'
                },
                subtitle: {
                    text: document.ontouchstart === undefined ?
                        '' : 'Pinch the chart to zoom in',
                    align: 'left'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        text: 'Intensitas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 0,
                                y1: 0,
                                x2: 0,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [
                                    1,
                                    Highcharts.color(Highcharts.getOptions().colors[0])
                                    .setOpacity(0).get('rgba')
                                ]
                            ]
                        },
                        marker: {
                            radius: 2
                        },
                        lineWidth: 1,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                series: [{
                    type: 'area',
                    name: 'Intensitas',
                    data: [21,31,33,1,2,12,5,26,63,1,23,21,1,23,31,31,33,1,2,12,5,26,63]
                }]
            });
        })();
    </script>
@endpush
