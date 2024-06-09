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
                                <th>Value</th>
                                <th>Dibuat</th>
                                <th>Diupdate</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-js')
    <script>
        $(document).ready(function() {
            var dataTable = $('#sensor-table').DataTable();
            $('#sensor-type').change(function() {
                var selectedValue = $(this).val();
                dataTable.clear().draw();
                console.log(selectedValue);
                $.ajax({
                    url: '/api/sensors/history?type=' + selectedValue,
                    type: 'GET',
                    success: function(data) {
                        $.each(data, function(index, item) {
                            dataTable.row.add([
                                item.id,
                                item.value,
                                item.created_at,
                                item.updated_at
                            ]).draw();
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
