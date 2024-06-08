@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Kontrol Pompa Air</h5>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="waterPumpSwitch">
                            <label class="form-check-label" for="waterPumpSwitch">Tombol Untuk Kontrol Pompa Air</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Kontrol Lampu</h5>
                        </div>
                    </div>
                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="lampSwitch">
                            <label class="form-check-label" for="lampSwitch">Tombol Untuk Kontrol Lampu</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Toggle water pump status
            $('#waterPumpSwitch').change(function() {
                var isChecked = $(this).is(':checked');
                var status = isChecked ? 'Nyala' : 'Mati';
                var dataToSend = isChecked ? 1 : 0;

                $.ajax({
                    url: "{{ route('api.toggle.waterPump') }}",
                    type: "POST",
                    data: {
                        value: dataToSend,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Pompa Air ' + status + ' - Data telah dikirim');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Toggle lamp status
            $('#lampSwitch').change(function() {
                var isChecked = $(this).is(':checked');
                var status = isChecked ? 'Nyala' : 'Mati';
                var dataToSend = isChecked ? 1 : 0;

                $.ajax({
                    url: "{{ route('api.toggle.lamp') }}",
                    type: "POST",
                    data: {
                        value: dataToSend,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Lampu ' + status + ' - Data telah dikirim');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
