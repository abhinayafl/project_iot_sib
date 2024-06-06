@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Tabel History Sensor</h5>
                        </div>
                    </div>
                    <div>
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Temperature</th>
                                <th scope="col">Humidity</th>
                                <th scope="col">Moisture</th>
                                <th scope="col">Intensity</th>
                              </tr>
                            </thead>
                            <tbody class="table-group-divider">
                              <tr>
                                <th scope="row">1</th>
                                <td>32°</td>
                                <td>40%</td>
                                <td>61%</td>
                                <td>119 Lux</td>
                              </tr>
                              <tr>
                                <th scope="row">2</th>
                                <td>33°</td>
                                <td>43%</td>
                                <td>63%</td>
                                <td>118 Lux</td>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>31°</td>
                                <td>44%</td>
                                <td>62%</td>
                                <td>120 Lux</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
