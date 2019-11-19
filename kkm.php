
<?php 
include_once "head.php";
session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['kd_level']!="1"){
  echo "<script>alert('anda tidak bisa masuk bos');window.history.go(-1);</script>";
include "koneksi.php";

	}
    
?>
  
  <body>
  <body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- Left navbar links -->
<ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
</li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="logout.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                 Logout
                </h3>
              </div>
            </div>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="halaman_admin.php" class="brand-link">
      <img src="sd.png" alt=" Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SIAPORT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="" class="img-circle elevation-2" alt="User Image">
        </div>
        <div  class="info">
          <a href="#" class="d-block"><?php echo $data['nama'];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
                <a href="./wali_murid.php" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard </p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Data Guru & Siswa
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="p" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Guru</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Data Siswa & Siswi</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Hadir Siswa & Siswi</p>
                    </a>
                  </li>
                </ul>
                <li class="nav-header">INPUT NILAI</li>
              <li class="nav-item">
                <a href="kkm.php" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                  Nilai KKM
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.php" class="nav-link">
                  <i class="nav-icon far fa-calendar-alt"></i>
                  <p>
                   Nilai Harian, PTS & PAS
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/data_guru.php" class="nav-link">
                  <i class="nav-icon far fa-image"></i>
                  <p>
                    Raport
                  </p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
  

<!--tabel kkm-->
<div class="container">
  <table class="table">
  <thead class="thead-dark">

    
    <tr>
      <th style="text-align:center;">No</th>
      <th style="text-align:center;">Mata Pelajaran</th>
      <th style="text-align:center;">Nilai KKM</th>
      <th style="text-align:center;"></th>
      
    </tr>
    <?php $no = 1;
    
    
    ?>
  </thead>
  <tbody>
    <tr>
    <?php
    $sql = mysqli_query($koneksi, "SELECT * FROM kkmm ");
    while($data = mysqli_fetch_array($sql)) {
    
    ?>

      <th style="text-align:center;" class="pokeh"><?php echo $no++; ?></th>
      <td style="text-align:center;"class="pokeh"><?php echo $data['mata_pelajaran']; ?></td>
      <td style="text-align:center;"class="pokeh"><?php echo $data['kkm']; ?></td>
      <td style="text-align:center;"class="pokeh">
        <a href="edit.php?id=<?php echo $data['id_mata_pelajaran']; ?>">EDIT</a>
        <a href="hapus.php?id=<?php echo $data['id_mata_pelajaran']; ?>">HAPUS</a></td>

    </tr>
    <?php } ?>
    
  </tbody>
</table>
</div>
 <!-- /.content-wrapper -->
 <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="wali_kelas.php">SIAPORT</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>
 
	<br/>
	<br/>
 
	<a><a href="https://www.malasngoding.com/membuat-login-multi-user-level-dengan-php-dan-mysqli"></a>
  <script src="../js/JQuery.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>