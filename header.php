<?php
include "config.php";
session_start();
if(!isset($_SESSION['username'])){
	?>
	<script>window.location.assign("login.php")</script>
	<?php
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Sekolah Dasar Negeri Karang Tengah 7</title>

    <!-- Custom fonts for this template-->
  	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  	<!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-0">
        <div class="text-center">
          <img class="img-fluid px5" style="width: 5rem;" src="images/logosd.png" alt="">
        </div>
        </div>
        <div class="sidebar-brand-text mx-1">SDN Karang Tengah 7</sup></div>
       </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
	 <!-- Heading -->
	 <div class="sidebar-heading">
        Dashboard
      </div>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Beranda</span></a>
	  </li>
	 

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="kriteria.php">
          <i class="fas fa-book"></i>
          <span>Kriteria</span></a>
	  </li>
	  
      <li class="nav-item">
        <a class="nav-link" href="subkriteria.php">
          <i class="fas fa-book-open"></i>
          <span>Sub Kriteria</span></a>
	  </li>
	  
      <li class="nav-item">
        <a class="nav-link" href="alternatif.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Data Siswa</span></a>
	  </li>
	  
      <li class="nav-item">
        <a class="nav-link" href="perangkingan.php">
          <i class="fas fa-chart-bar"></i>
          <span>Perangkingan</span></a>
	  </li>
	  
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-file-pdf"></i>
          <span>Laporan</span></a>
	  </li>
	  
	  <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pengguna
	  </div>
	  
	  <li class="nav-item">
        <a class="nav-link" href="operator.php">
          <i class="fas fa-user-cog"></i>
          <span>Operator</span></a>
	  </li>
	  
      <li class="nav-item">
        <a class="nav-link" href="ubahpassword.php">
          <i class="fas fa-key"></i>
          <span>Ubah Password</span></a>
	  </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

    </ul>
    
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              
             
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Keluar
                </a>

            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">