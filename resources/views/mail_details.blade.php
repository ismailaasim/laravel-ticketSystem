<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
        
        <div class="container">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Mail Content</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($getall) > 0 )
                    @foreach ($getall as $item)
                    <tr>
                        <td style="width: 300px;">{{ $item->name }}</td>
                        <td>{!! $item->description !!}</td>
                    </tr>
                    @endforeach
                    
                    @endif
                    
                  
                </tbody>
            </table>
        </div>
   

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
</body>
</html>