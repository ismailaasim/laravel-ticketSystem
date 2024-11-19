<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.layout.common-header')
    
</head>

<body class="g-sidenav-show bg-gray-100">
       
   @include('Backend.layout.aside')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

      @include('Backend.layout.navbar')

      @section('main-content')
      @show
      @include('Backend.layout.footer')
  
    @include('Backend.layout.common-footer')
    @stack('custom-script')
</body>
</html>