<?php
session_start();
if(!isset($_SESSION["log"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';
// function tambah dan edit
if(isset($_POST["tambah"])){
  if(tambah($_POST) > 0){
    echo 
    "<script>
    alert('data berhasil ditambahkan')
    document.location.href = 'barang.php';
    </script>";
  } else {
    echo 
    "<script>
    alert('data gagal ditambahkan')
    document.location.href = 'barang.php';
    </script>";
  }
}
if(isset($_POST["edit"])){
  if(ubah($_POST) > 0){
    echo 
    "<script>
    alert('data berhasil diubah')
    document.location.href = 'barang.php';
    </script>";
  } else {
    echo 
    "<script>
    alert('data gagal diubah')
    document.location.href = 'barang.php';
    </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>kelola admin</title>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
   

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/dataTables/datatables.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
    <!-- bs modal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   

    <!-- <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                barang
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>barang</span>
                    
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">                
                        <a class="collapse-item" href="barang.php">Data barang </a>
                        <a class="collapse-item" href="masuk.php">Barang masuk </a>
                        <a class="collapse-item" href="keluar.php">Barang keluar </a>
                    </div>
                   
                </div>

                <!-- admin -->
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#admin"
                    aria-expanded="true" aria-controls="admin">
                    <i class="fas fa-solid fa-users"></i>
                    <span>kelola admin</span>
                </a>
                

                <div id="admin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="admin.php">Data admin </a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="logout.php">
                <i class="fas fa-solid fa-right-from-bracket"></i>
                    <span>logout</span>
                </a>
                
            </li>

           

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="row">
                    <div class="col-lg-12">
                      <h1>kelola admin</h1>
                      <ol class="breadcrumb">
                        <li>
                          <a href="admin.php"><i class="icon-dashboard"></i> admin</a>
                        </li>
                      </ol>
                    </div>
                  </div>
                  
                <div class="container-fluid" >

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                          
                          <div class="table-responsive" >
                              <table class="table table-bordered table-hover table-striped" id="datatables" style="width:100%">
                                <thead>
                                      <tr>
                                          <th>No.</th>
                                          <th>username</th>
                                          <th>opsi</th>
                                         
                                      </tr>
                                 </thead>
                                 <tbody>
                                        <?php $no = 1; ?>
                                        <?php
                                        $ambiladmin = mysqli_query($conn, "SELECT * FROM user");
                                        while($data = mysqli_fetch_array($ambiladmin)):
                                          $username = $data["username"];                                                                           
                                          $idu = $data["id"];                                                                           
                                        ?>
                                        <tr>
                                            <td align="center"><?= $no++ ?></td>
                                            <td><?=$username; ?></td>
                                    
                                            <td align="center">
                                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idu;?>"><i class="fa fa-edit"> </i> Edit</button>
                                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idu;?>"><i class="fa fa-trash"> </i> hapus</button>
                                            </td>
                                        </tr>

                                        <!-- edit data -->
                                        <div class="modal fade" id="edit<?=$idu;?>">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <!-- <button type="button" class="close" data-dismiss="modal"></button> -->
                                                <h4 class="modal-title">edit data barang</h4>
                                              </div>
                                              <form action="" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                  <div class="form-group">
                                                    
                                                    <input type="text" name="username" value="<?=$username;?>" class="form-control" placeholder="username">
                                                  </div>
                                                  <div class="form-group">
                                                    
                                                    <input type="password" name="password" class="form-control" placeholder="password">
                                                  </div>
                                        
                                                  <input type="hidden" name="id" value="<?=$idu; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" class="close" data-dismiss="modal">cancel</button>
                                                  <input type="submit" class="btn btn-primary" name="editadmin" value="edit" id="">
                                                </div>
                                              </form>
                                            
                                            </div>
                                          </div>
                                        </div>

                                        <!-- delete data -->
                                        <div class="modal fade" id="delete<?=$idu;?>">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <!-- <button type="button" class="close" data-dismiss="modal"></button> -->
                                                <h4 class="modal-title">hapus barang</h4>
                                              </div>
                                              <form action="" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                  apakah anda yakin ingin menghapus <?=$username; ?>?
                                                  <input type="hidden" name="id" value="<?=$idu; ?>">
                                                  <br>
                                                  <br>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-danger" class="close" data-dismiss="modal">cancel</button>
                                                  <input type="submit" class="btn btn-primary" name="hapusadmin" value="hapus" id="">
                                                </div>
                                              </form>
                                            
                                            </div>
                                          </div>
                                        </div>
                                       <?php endwhile; ?> 
                                   </tbody>
                              </table>
                              
                              
                          </div>
                          <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">tambah admin</button>         
                        </div>
                      </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
   

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
   
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <!-- <script src="assets/dataTables/datatables.min.js"></script> -->
    <script type="text/javascript">
      $(document).ready(function(){
          $('#datatables').DataTable();
      });
    </script>
</body>
<!-- tambah data -->
                            <div id="tambah" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <!-- <button type="button" class="close" data-dismiss="modal"></button> -->
                                    <h4 class="modal-title">Tambah admin</h4>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                        <label for="nm_brg" class="control-label">username</label>
                                        <input type="text" name="username" class="form-control"  required>
                                        </div>
                                        <div class="form-group">
                                        <label for="hrg_brg" class="control-label">password</label>
                                        <input type="password" name="password" class="form-control" required>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" class="close" data-dismiss="modal">cancel</button>
                                        <input type="submit" class="btn btn-primary" name="tambahadmin" value="tambah" id="">
                                    </div>
                                    </form>
                                
                                </div>
                                </div>
                            </div>
    <!-- end -->
    <!-- edit data -->
    </html>