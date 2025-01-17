<style>
  @media(max-width:360px){
    .breadcrumb-item h3 a{
    font-size: 19px
  }
  .breadcrumb-item p{
    font-size: 13px;
  }
  }
  </style>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
  <div class="container-fluid py-1 px-4">
    <nav aria-label="breadcrumb">
      
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item">
              <h3><a class="text-dark fw-bold" href="{{ route('user-List') }}">Dashboard</a></h3>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
              <p>{{ $pageName }}</p>
          </li>
      </ol>
     
      
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
         
        
      </div>
      <ul class="navbar-nav  justify-content-end">
        
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
      
      </ul>
    </div>
  </div>
</nav>



