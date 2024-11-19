
<style>
  .custom_color {
    color:red;
    background-color: skyblue !important;
}
</style>
@extends('master.layout')
<div class="container">
  @include('navbar')
</div>
@section('main_content')

<div class="card custom_color" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
    
@endsection




