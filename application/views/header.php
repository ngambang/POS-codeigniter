<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=$settingan[0]['nama_toko']?></title>

  <!-- Custom fonts for this template-->
  <link href="<?=base_url()?>template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?=base_url()?>template/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=base_url()?>template/css/sb-admin.css" rel="stylesheet">
  <link href="<?=base_url()?>template/css/custom.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="<?=base_url()?>/assets/easy-autocomplete.min.css"> -->
  <link rel="stylesheet" href="<?=base_url()?>assets/jquery.ui.css">
  <style>
  .ui-autocomplete { z-index:2147483647; }
  </style>
</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html"><?=$settingan[0]['nama_toko']?></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form method='get' class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" name='cari' value='<?=@$_GET['cari']?>' class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>


  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">

        <li class="nav-item <?=($this->uri->segment(1) !=='' && $this->uri->segment(1) =='home')?"active":''?>">
            <a class="nav-link" href="<?=base_url('home')?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span> Kasir</span>
            </a>
        </li>
        <li class="nav-item <?=($this->uri->segment(1) !=='' && $this->uri->segment(1) =='produk')?"active":''?>">
            <a class="nav-link" href="<?=base_url('produk')?>">
            <i class="fas fa-fw fa-folder"></i>
            <span> Produk</span>
            </a>
        </li>
        <li class="nav-item <?=($this->uri->segment(1) !=='' && $this->uri->segment(1) =='stok')?"active":''?>">
            <a class="nav-link" href="<?=base_url('stok')?>">
            <i class="fas fa-fw fa-clipboard"></i>
            <span> Stok</span>
            </a>
        </li>
        <li class="nav-item <?=($this->uri->segment(1) !=='' && $this->uri->segment(1) =='laporan')?"active":''?>">
            <a class="nav-link" href="<?=base_url('laporan')?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span> Laporan</span></a>
        </li>
  
        <li class="nav-item">
            <a class="nav-link" href="<?=base_url('logout')?>">
            <i class="fas fa-sign-out-alt"></i>
            <span> Keluar</span></a>
        </li>
    </ul>
    
    <!-- konten utama -->
    <div id="content-wrapper">