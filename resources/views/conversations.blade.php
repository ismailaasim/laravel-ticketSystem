<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Tracking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .card {
            max-width: 800px;
            margin: 0 auto;
        }
        .card-body {
            padding: 1rem;
        }
        .admin-message {
            background-color: #007bff;
            color: #fff;
            text-align: right;
        }
        .user-message {
            background-color: #f0f0f0;
            color: #000;
            text-align: left;
        }
    </style>
</head>
<body>
    @if (!empty($sendDetails))
       @foreach ($sendDetails as $sendDetail)
       <div class="card mt-2 mb-5">
        <div class="card-header" style="background: #C3D9FF;">
            <b>{{ $sendDetail['from'] }}</b> posted {{ $sendDetail['date'] }}
        </div>
        <div class="card-body">           
            <div class="user-message mb-3 p-4" style="border: 1px solid black;">
                <p><strong>Subject :</strong> {{ $sendDetail['subject'] }}</p>
                <p><strong>From :</strong> {{ $sendDetail['from'] }}</p>
                <p><strong>To :</strong> {{ $sendDetail['to'] }}</p>
                <p><strong>Cc :</strong> {{ $sendDetail['cc'] }}</p>
                {{-- <p><strong>Bcc :</strong> {{ $sendDetail['bcc'] }}</p> --}}
                {{-- <p><strong>Sender :</strong> {{ $sendDetail['sender'] }}</p> --}}
                <p><strong>Body :</strong> {!! $sendDetail['body'] !!}</p>
                {{-- <p><strong>UID :</strong> {{ $sendDetail['uid'] }}</p> --}}
                {{-- <p><strong>Date :</strong> {{ $sendDetail['date'] }}</p> --}}
                {{-- <span class="small">Just now</span> --}}
            </div>           
        </div>
    </div>
       @endforeach
    @else
        <h1 class="text-center text-danger">No email notifications found</h1>
    @endif

    <!-- Bootstrap JS and dependencies (optional for components like modals, dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
