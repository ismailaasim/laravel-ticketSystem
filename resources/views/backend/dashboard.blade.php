@extends('Backend.layout.app')

@section('main-content')

    <div class="container-fluid mt-4">
        <div class="row ms-3 mt-4">

            @if (session('loginURole') != 'User')
                <div class="col-lg-2 col-md-4 col-sm-6 mb-4  counts">
                    <div class="card bg-b h-100">
                        <div class="card-body text-center">
                            <div class="triangle-layout">
                                <div class="value value-1 text-light">User Count</div>
                                <div class="value value-2">
                                    <i class="fas fa-user custom-icon-color" style="color:#ffffff;"></i>
                                </div>
                                <div class="value value-3 text-light">{{ $UsersCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-lg-2 col-md-4 col-sm-6 mb-4 counts">
                <div class="card bg-d h-100 ">
                    <div class="card-body text-center">
                        <div class="triangle-layout">
                            <div class="value value-1 text-light">Shipment Count</div>
                            <div class="value value-2">
                                <i class="fas fa-ship custom-icon-color" style="color:#ffffff;"></i>
                            </div>
                            <div class="value value-3 text-light">{{ $shipments_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('custom-script')
@endpush
