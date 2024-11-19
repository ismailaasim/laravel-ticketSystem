<!DOCTYPE html>
<html>

<head>
    <title>Shipments</title>
    <!-- Include DataTables CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

</head>

<body>
    <div class="container">
        <h2 class="mb-5 mt-1">Shipment Details</h2>
        <table id="productsTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Branch</th>
                    <th>BookingNo</th>
                    <th>BookingDate</th>
                    <th>AgentName</th>
                    <th>Customer</th>
                    <th>Shipper</th>
                    <th>Consignee</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shipments as $shipment)
                    <tr>
                        <td>{{ $shipment->id }}</td>
                        <td>{{ $shipment->BRANCH }}</td>
                        <td>{{ $shipment->BKGNO }}</td>
                        <td>{{ $shipment->BKGDT }}</td>
                        <td>{{ $shipment->AGTNAME }}</td>
                        <td>{{ $shipment->CUSTOMER }}</td>
                        <td>{{ $shipment->SHIPPER }}</td>
                        <td>{{ $shipment->CONSIGNEE }}</td>
                        <td>{{ $shipment->USER }}</td>
                        <td><a class="btn btn-sm bg-success" href="{{url('/home/'.$shipment->id)}}">Mail</a>&nbsp;   <a href="{{url('/view_mail_details/'.$shipment->id)}}"  class="btn btn-sm bg-info mt-1">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable();
        });
    </script>
</body>

</html>
