<!DOCTYPE html>
<html lang="en">
<head>
<title>Laravel 9 How To Upload Image Using Ckeditor</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Laravel 9 How To Upload Image Using Ckeditor</h1><br> 
                <form method="post"  class="form form-horizontal">               
                  @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="name" class="form-control"/>
                    </div>  
                    <div class="form-group">
                        <label>Description</label>
                         <textarea class="form-control" id="summary-ckeditor" name="description"></textarea> 
                    </div>  
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control"/>
                    </div>   
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary"/>
                    </div> 
                </form>             
            </div>
            @if ( Session::has('flash_message') )
                <div class="alert alert-success">
                    <h3>{{ Session::get('flash_message') }}</h3>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script>
    CKEDITOR.replace('summary-ckeditor', {
        
    });
    </script> 
</body>
</html>