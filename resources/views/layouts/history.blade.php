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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
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
        });
    </script>
@endsection
