<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML Convertion</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        {{-- <h2>Basic Bootstrap Table</h2> --}}
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Organization Name</th>
                    <th>Consignee Name</th>
                    <th>Consignor Name</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @if (count($shipments) > 0)
                    @foreach ($shipments as $key => $shipment)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $shipment->Organisation_Name }}</td>
                            <td>{{ $shipment->Shipment_Consignee_Organisation_Name }}</td>
                            <td>{{ $shipment->Shipment_Consignor_Organisation_Name }}</td>
                            <td><a href="{{ url('export/' . $shipment->id) }}" class="btn btn-success">Download</a></td>
                        </tr>
                    @endforeach
                @else
                @endif


            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
