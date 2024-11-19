<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shiptment Mails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('flash_message'))
                <div class="alert alert-success alert-dismissible fade show m-5" role="alert">
                    <h6>{{ Session::get('flash_message') }}</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                
            @endif
                {{-- <h1 class="text-center">Laravel 9 How To Upload Image Using Ckeditor</h1><br> --}}
                <form method="post" action="{{ route('store') }}" class="form form-horizontal mt-5">
                    @csrf                    
                    <div class="form-group">
                        <label>To</label>
                        <input type="text" name="mail_to" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Cc</label>
                        <input type="text" name="mail_cc" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="name" value="Booking ERP [#{{$booking->BKGNO}}]" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="summary-ckeditor" name="description"></textarea>
                    </div>                
                    <div class="form-group mt-2">
                        <input type="submit" value="Submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('summary-ckeditor', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
</body>

</html>
