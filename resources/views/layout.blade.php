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

   
 
     
        
        @yield('content')

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="" target="_blank" class="pe-1 text-primary text-decoration-underline">albarack</a> Distributed by <a href="">Fitrah</a></p>
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