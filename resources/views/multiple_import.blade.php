<!DOCTYPE html>
<html>
<head>
    <title>Import Shipments</title>
</head>
<body>
    <form action="{{ route('import.multiple.shipments') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Import</button>
    </form>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @if (session('errors'))
        <ul>
            @foreach (session('errors') as $errorArray)
                @foreach ($errorArray as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        </ul>
    @endif
</body>
</html>
