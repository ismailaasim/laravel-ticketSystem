<?php $page = basename(request()->path());
?>
@php
    $currentPath = request()->path();
    $isActive = $currentPath == 'backend/shipment' || Str::startsWith($currentPath, 'backend/view_mail_details');
@endphp
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start ms-3 "
    id="sidenav-main">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
    <div class="sidebarnav-header mx-2 d-flex py-4 mt-4">
        <img src="{{ asset('assets/img/logo1.png') }}" alt="User Icon" class="user-icon">
        <p class="user-name">Welcome back,<br><span><b>{{ $loggedInUserName }}</b> -
                ({{ $loggedInUserDesignation }})</span> </p>
        <i class="fa fa-cog py-2"></i>
    </div>

    <div class="collapse navbar-collapse mt-4 w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item u1">
                <a class="nav-link {{ $page == 'dashboard' ? 'active bg-white' : '' }}" href="{{ route('dashboard') }}"
                   
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('assets/img/shipmenti.png') }}" alt="User Icon" width="25" height="25"
                            style="margin-right: 5px;">
                        <span class="ms-2" style="font-size:15px">Dashboard</span>
                    </div>
                    {{-- <span class="badge rounded-pill bg-b ">120</span> --}}
                    <i class="fas fa-bars ms-1 custom-icon"></i>
                </a>
            </li>
            @if (session('loginURole') != 'User')
                <li class="nav-item u1">
                    <a class="nav-link {{ $page == 'user-list' ? 'active bg-white' : '' }}" href="{{ url('backend/user-list') }}"
                       
                        style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center;">
                            <img src="{{ asset('assets/img/useri.png') }}" alt="User Icon" width="25"
                                height="25" style="margin-right: 5px;">
                            <span class="ms-2" style="font-size:15px">User</span>
                        </div>
                        <span class="badge rounded-pill bg-b ">{{ $UsersCount }}</span>
                        <i class="fas fa-bars ms-1 custom-icon"></i>
                    </a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link {{ $isActive ? 'active bg-white' : '' }}" href="{{ route('shipment') }}"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('assets/img/shipmenti.png') }}" alt="User Icon" width="25"
                            height="25" style="margin-right: 5px;">
                        <span class="ms-2" style="font-size:15px">Shipment</span>
                    </div>
                    <span class="badge rounded-pill bg-d">{{ $shipments_count }}</span>
                    <i class="fas fa-bars ms-1 custom-icon"></i>
                </a>
            </li>

        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="sign-out-link ms-3 mt-2 w-100 {{ $page == '' ? 'active bg-white' : '' }}"
                href="{{ route('logout-user') }}">
                <img src="{{ asset('assets/img/signouti.png') }}" alt="User Icon" width="20" height="20">
                Sign Out
            </a>
        </div>
    </div>
</aside>
