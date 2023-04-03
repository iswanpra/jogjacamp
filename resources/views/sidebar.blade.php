<?php
$userLogin = new \App\Helpers\UserLogin;
$userLogin->Demontration();
$roles = \App\Helpers\UserLogin::getRoles();
?>
<div class="page-header navbar navbar-fixed-top" style="height: 74px">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO https://spbe-dev.layanan.go.id/tata-kelola -->
    <a href="{{ url('logout_direct') }}" class="page-logo" style="text-decoration: none;background-color: rgb(226 71 72);height: 167px;margin-top: -17px;width: 16.5%;">
      <div style="display:flex;width: 115%;margin-left: -13px;" id="title-logo">
       <img src="{{ asset('images/logo.png') }}" class="img-responsive img-logo"> 
      <div id="header-title">Manajemen dan <span style="color:rgb(191 191 191) !important;">Tata Kelola SPBE</span></div>
      </div>
      <div class="menu-toggler sidebar-toggler hide">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      </div>
    </a>
    <div class="sidebar-toggler-wrapper">
        <i class="fa fa-bars sidebar-toggler" id="bar-menu" data-menus="0"></i>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu" style="margin-top: -36px;">
      <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        
        <li style="margin-top: 18px;" class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="false" data-close-others="true">
          <i class="icon-bell"></i>
          <span class="badge badge-default" id="data-pengajual-all">0</span>
          </a>

          <ul class="dropdown-menu">
            
            <li class="external" style="background-color: #d64635;">
              <h3 style="color: white;"><span class="bold"></span> Update hari ini</h3>
              <!-- <a href="extra_profile.html">view all</a> -->
            </li>
            <li>
              <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283" id="dataNotif">
                <!-- <li>
                  <a href="javascript:;">
                  <span class="time">just now</span>
                  <span class="details">
                  <span class="label label-sm label-icon label-success">
                  <i class="fa fa-plus"></i>
                  </span>
                  New user registered. </span>
                  </a>
                </li> -->
                
              </ul>
            </li>
          </ul>
        </li>
        
      
        <!-- END TODO DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
           
          <span class="username username-hide-on-mobile">
            <div style="font-size: 16px; color: black; font-weight: bold;">{{ Session::get('token')['instansis']}} </div>
            <div style="float: right;">{{ $roles }}</div>
          
           </span>
           
           <img src="{{ asset('images/PANRB.png') }}" class="img-responsive" style="margin-top: -8px;float: initial;margin-left: 20px; height: 60px;"> 
          <i class="fa fa-angle-down"></i>
          </a>
          <!-- <ul class="dropdown-menu dropdown-menu-default">
            
            <li>
              <a href="extra_lock.html">
              <i class="icon-lock"></i> Lock Screen </a>
            </li>
            <li>
              <a href="{{ url('logout') }}">
              <i class="icon-key"></i> Log Out </a>
            </li>
          </ul> -->
        </li>
        <!-- END USER LOGIN DROPDOWN -->
        <li class="dropdown dropdown-quick-sidebar-toggler">
          <a href="javascript:;" class="dropdown-toggle">
          <!-- <i class="icon-logout"></i> -->
          </a>
        </li>
        <!-- END QUICK SIDEBAR TOGGLER -->
      </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
  <!-- BEGIN SIDEBAR -->
  <div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
      <div style="background-color: rgb(250, 250, 250);position: initial; margin-top: -104px;">RESERVASI KONSULTASI</div>
      <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" id="menu-pengajuan-all" style="width: 16.5%;">
     
        <li class="sidebar-search-wrapper" style="height: 37px;margin-top: 229px;margin-left: 10px;font-weight: bold;">
          RESERVASI KONSULTASI
        </li>
        <li>
          <a href="{{url('dashboard')}}">
            <i class="icon-home"></i>
            <span class="title">Dashboard  </span>
            <span class="selected"></span>
          </a>
        </li>
      
        @if(in_array($roles,['SUPERADMIN','ADMIN INSTANSI']))
        <li>
          <a href="{{url('admin/daftar-pengajuan')}}">
            <i class="icon-docs"></i>
            <span class="title">Pengajuan Konsultasi  </span>
            <span class="arrow "></span>
          </a>
        </li>
        <li>
          <a href="{{ url('/kegiatan') }}">
          <i class="icon-puzzle"></i>
          <span class="title">Daftar Bidang</span>
          <span class="arrow "></span>
          </a>
        </li>
        @endif
        <!--if(in_array($roles,['SUPERADMIN','ADMIN INSTANSI']))
        <li>
          <a href="{{ url('settings/kalender') }}">
          <i class="icon-settings"></i>
          <span class="title">Kalender Konsultasi</span>
          <span class="arrow "></span>
          </a>
        </li>
        endif-->
        
        @if($roles==='SUPERADMIN')
        <li>
          <a href="{{ url('settings/hari-libur') }}">
          <i class="icon-settings"></i>
          <span class="title">Pengaturan Hari Libur</span>
          <span class="arrow "></span>
          </a>
        </li>
        @endif
        @if($roles==='USER IPPD')
        <!-- <li class="heading">
          <h3 class="uppercase">User Area</h3>
        </li> -->
        <li>
          <a href="{{url('addformkonsultasi')}}">
          <i class="fa fa-table"></i>
            <span class="title">Tambah konsultasi</span>
          </a>
        </li>
        <li>
          <a href="{{url('profile')}}">
          <i class="icon-user"></i>
          <span class="title">Profile</span>
          <span class="arrow "></span>
          </a>
        </li>
        @endif

      </ul>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
