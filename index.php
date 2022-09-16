<?php 
    date_default_timezone_set("Asia/Jakarta");
    include "config.php";

    session_start();
    require_once "config.php";
    if (!isset($_SESSION["is_logged"])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Vendor -->
    <link rel="stylesheet" href="style.css" />
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="vendor/boxicons/css/boxicons.min.css" />
    <link rel="stylesheet" href="vendor/aos/aos.css" />
    <link rel="stylesheet" href="vendor/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-chosen.css" />


    <title>SPK Bansos C19</title>
</head>

<body>
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>
    <!--Header-->
    <header id="header" class="d-flex flex-column align-content-center">
        <div class="profile">
            <img src="img/user.png" alt="" class="img rounded-circle" width="120" height="120" />
            <h1 class="text-light"><a href="">Admin</a></h1>
            <div class="edit">
                <div class="social-links text-center">
                    <a href="#"><i class="bx bx-log-out"></i> </a>
                </div>
                <a href="logout.php">
                    <h4>Log out</h4>
                </a>
            </div>
        </div>

        <nav id="navbar" class="nav nav-menu navbar-nav mt-10">
            <ul>
                <li>
                    <a href="index.php" class="nav-link"><i class="bx bx-home"> </i> <span>Home</span></a>
                </li>
                <li>
                    <a href="?page=edit_bobot" class="nav-link"><i class="bx bx-detail"></i>
                        <span>Kriteria</span> </a>
                </li>
                <li>
                    <a href="?page=data_KK" class="nav-link"><i class="bx bx-file-blank"></i> <span>Alternatif</span>
                    </a>
                </li>
                <li>
                    <a href="?page=perankingan" class="nav-link"><i class="bx bx-book-content"></i> <span>TOPSIS</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <!--End Header-->

    <!-- awal container -->
    <div>
        <?php
      $page = isset($_GET['page']) ? $_GET['page'] : "";
      $action = isset($_GET['action']) ? $_GET['action'] : "";

      if ($page==""){
          include "welcome.php";
      }elseif ($page=="data_KK"){
          if ($action==""){
              include "tampil_KK.php";
          }elseif ($action=="tambah"){
              include "tambah_KK.php";
          }elseif ($action=="update"){
              include "update_KK.php";
          }else{
              include "hapus_KK.php";
          }
      }elseif ($page=="perankingan"){
          if ($action==""){
              include "perankingan.php";
          }
      }elseif ($page=="edit_bobot"){
          if ($action==""){
              include "edit_bobot.php";
          }elseif ($action=="update"){
              include "update_bobot.php";
          }
      }else{
          include "welcome.php";
      }
      ?>
    </div>
    <!-- akhir container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery/chosen.jquery.min.js"></script>
    <script src="vendor/jquery/jquery-3.4.1.slim.min.js"></script>
    <script src="vendor/jquery/jquery.dataTables.min.js"></script>
    <script src="vendor/jquery/popper.min.js"></script>
    <script src="vendor/aos/aos.js"></script>
    <script src="vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery/dist/jquery.min.js"></script>
    <script src="main.js" type="text/javascript"></script>
</body>

</html>