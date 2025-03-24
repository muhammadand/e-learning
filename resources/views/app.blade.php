<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> E-learning</title>
  <link rel="stylesheet" href="{{asset('assets/images/logos/favicon.png')}}">
  <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}">
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/seodashlogo.png" />
  <!-- Tambahkan di bagian <head> -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>

<!-- Tambahkan di bagian sebelum penutupan </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-text" style="font-size: 20px; font-weight: bold; color: #333; text-decoration: none; display: flex; align-items: center;">
            KampusKomputer.com
        </a>
        
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
           
 

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">KELOLA USER</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('courses.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-book"></i>

                </span>
                <span class="hide-menu">Courses</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('courses.enrol')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>

                </span>
                <span class="hide-menu">Enrol Courses</span>
              </a>
            </li>
           
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('cpmks.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>

                </span>
                <span class="hide-menu">CPMK</span>
              </a>
            </li> --}}
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('course_cpl.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>

                </span>
                <span class="hide-menu">Course-CPL</span>
              </a>
            </li> --}}
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('cpl_cpmk.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>

                </span>
                <span class="hide-menu">CPL-CPMK</span>
              </a>
            </li> --}}
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('materials.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>

                </span>
                <span class="hide-menu">Materials</span>
              </a>
            </li> --}}
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">KELOLA AKDEMIK</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('users.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users"></i>

                </span>
                <span class="hide-menu">Users</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('faculties.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-building"></i>
                </span>
                <span class="hide-menu">Fakultas</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('study_programs.index')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-school"></i>
                </span>
                <span class="hide-menu">Program study</span>
              </a>
            </li>

         
        
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            
           

            

             
          </ul>
          
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                 

              
                  <img src="{{ $fotoProfil }}" alt="" width="35" height="35" class="rounded-circle">
                
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="{{route('profile.show')}}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button>
                   </form>
                    
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
        
        @yield('content')

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="" target="_blank" class="pe-1 text-primary text-decoration-underline">albarack</a> Distributed by <a href="">Fitrah</a></p>
        </div>
      </div>
    </div>
  </div>
    <script src="{{asset('assets/js/dashboard.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/dist/simplebar.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>





  </body>
  
  </html>