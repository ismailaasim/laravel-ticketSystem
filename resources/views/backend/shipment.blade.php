@extends('Backend.layout.app')

@section('main-content')
<style>
    div.dt-container div.dt-search {
    text-align: right;
    display: none;
}
</style>
    <div class="container-fluid  mt-4" style="
    min-height: 60vh;">

        <div class="row ms-3 mt-3">
            @if (session('loginURole') != 'User')
            <div class="col-lg-2 col-md-4 col-sm-6 mb-4 counts">
                <div class="card bg-b">
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
                <div class="card bg-d">
                    <div class="card-body text-center">
                        <div class="triangle-layout">
                            <div class="value value-1 text-light">Shipment Count</div>
                            <div class="value value-2 ic">
                                <i class="fas fa-ship custom-icon-color" style="color:#ffffff;"></i>
                            </div>
                            <div class="value value-3 text-light">{{ $shipments_count }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 ms-auto">
            <div class="container">
                <div class="card">
                    <div class="container-fluid card-header ">
                        <div class="row">
                            <div class="col-md-5">
                                <h3 class="card-title mb-0">Shipment</h3>
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex mx-1 shipFlex">
                                    <div class="input-container ms-auto me-2 cont1">
                                        <i class="fas fa-search"></i>
                                        <input type="text" class="form-control" id="searchInputShipments"
                                            placeholder="Search">
                                        <i class="fas fa-times" style="display:none;"></i>
                                    </div>
                                    <div class="filter-container">
                                        <button id="filterShipmentBtn" class="filter-btn btn btn-outline-secondary me-2">
                                            <i class="fa fa-filter"></i>
                                            <span id="shipmentSelectedCount" class="badge bg-secondary ms-2">0</span>
                                        </button>
                                        <div id="filterShipmentDown" class="filter-dpt1">
                                            <h4>Filter Options</h4>
                                            <div class="filter-option">
                                                <label for="subscriptionStatus">Branches:</label>
                                                <select id="filterShipmentBranch" class="form-control" name="branch[]" multiple>
                                                    <option value="all" class="child_cls">Select All</option>
                                                    @foreach ($branches as $branch)
                                                        <option value="{{ $branch->branch_name }}" class="child_cls">
                                                            {{ $branch->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                
                                            <button id="applyShipmentBtn" class="apply-btn1 btn btn-primary mt-2">Apply</button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="shipmentsTableContainer">
                        <div class="table-responsive dragscroll">
                            <table id="shipmentsTable" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Booking Number</th>
                                        <th>Booking Date</th>
                                        <th>User</th>
                                        <th>Consignee</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-dark">

                                    @if (count($shipments) > 0)
                                        @foreach ($shipments as $item)
                                        <tr>
                                            <td>{{$item->BRANCH}}</td>
                                            <td>{{$item->BKGNO}}</td>
                                            <td>{{$item->BKGDT}}</td>
                                            <td> {{$item->USER}}s</td>
                                            <td>{{$item->CONSIGNEE}}</td>
                                            <td>{{$item->STATUS}}</td>
                                            <td> <a href="{{url('/backend/view_mail_details/'.$item->id)}}" target="_blank">
                                                
                                                <button type="button" class="btn bg-s no-hover1 position-relative btn-sm">
                                                    View
                                                    @if ($item->mail_read_status == 1)
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-b">
                                                        {{$item->mail_count}}
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                    @endif
                                                </button>
                                             
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('custom-script')
    <script>
         $(document).ready(function() {
          

        function initializeShipmentDataTable() {
            if ($.fn.DataTable.isDataTable('#shipmentsTable')) {
                $('#shipmentsTable').DataTable().destroy();
            }

            $('#shipmentsTable').DataTable({
                // 'dom':'lrtip',
                "pageLength": 5,
                "pagingType": "simple_numbers",
                "language": {
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Prev"
                    }
                },
                "lengthChange": false,
                "searching": true,
                "info": false
            });
            $('[data-bs-toggle="tooltip"]').tooltip();
        }

          function bindSearchToShipDataTable() {
        $('#searchInputShipments').on('keyup', function() {
            var table = $('#shipmentsTable').DataTable();
            table.search(this.value).draw();
        });
    }

    // Initial bind of search to DataTable
    initializeShipmentDataTable();
    bindSearchToShipDataTable();

       // Initialize DataTable on page load

            $('#filterShipmentBtn').on('click', function() {
                $('#filterShipmentDown').toggle();
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('.filter-container').length) {
                    $('#filterShipmentDown').hide();
                }
            });

            $('#filterShipmentBranch').on('change', function() {
                var selectedCount = $(this).val().length;
                if ($(this).val().includes('all')) {
                    selectedCount = $('#filterShipmentBranch option').not('[value="all"]').length;
                }
                $('#shipmentSelectedCount').text(selectedCount);
            });

            $('#applyShipmentBtn').on('click', function() {
                var selectedBranches = $('#filterShipmentBranch').val();

                $.ajax({
                    url: '{{ route('shipment') }}',
                    type: 'GET',
                    data: {
                        branch: selectedBranches,
                    },
                    success: function(response) {
                        $('#shipmentsTableContainer').html($(response).find('#shipmentsTableContainer').html());

                        // Reinitialize the DataTable after updating the content
                        initializeShipmentDataTable();
                    },
                    error: function(xhr) {
                        console.log("An error occurred: " + xhr.status + " " + xhr.statusText);
                    }
                });
            });

            let isUpdating = false;
            let previousSelectedValues = [];

            $('#filterShipmentBranch').on('change', function() {
                if (isUpdating) return;
                isUpdating = true;

                let selectedOptions = $(this).val() || [];
                let previousSelectedSet = new Set(previousSelectedValues);
                let lastUncheckedValue = null;
                let lastCheckedValue = null;

                previousSelectedValues.forEach(function(value) {
                    if (!selectedOptions.includes(value)) {
                        lastUncheckedValue = value;
                    }
                });

                selectedOptions.forEach(function(value) {
                    if (!previousSelectedSet.has(value)) {
                        lastCheckedValue = value;
                    }
                });

                previousSelectedValues = selectedOptions.slice();

                if (lastUncheckedValue === 'all') {
                    $(this).find('option').prop('selected', false);
                    $(this).trigger('change');
                } else if (lastCheckedValue === 'all') {
                    $(this).find('option.child_cls').prop('selected', true);
                    $(this).trigger('change');
                } else {
                    $(this).find('option[value="all"]').prop('selected', false);
                    $(this).trigger('change');
                }

                isUpdating = false;
            });
        });
    </script>
@endpush
