<?php
session_start();
session_regenerate_id();
ob_start();
include "config/koneksi.php";
include "config/function.php";

if (!isset($_SESSION["NAMA"])) {
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/template/assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />
    <?php include "inc/css.php"?>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
      
        <?php include "inc/sidebar.php"?>

        <!-- Layout container -->
        <div class="layout-page">

          <?php include "inc/navbar.php"?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
             <div class="container-xxl grow container-p-y">
                 <div class="row">
                    <div class="col-12-md">
                        <?php 
                        if (isset($_GET["page"])) {
                            if (file_exists("pages/" . $_GET["page"] . ".php")){
                                include "pages/" . $_GET["page"] . ".php";
                            } else {
                                echo "<h1>Halaman Tidak ditemukan</h1>";
                            }
                        } else {
                            include "pages/dashboard.php";
                        };
                        ?>
                    </div>
                 </div>
             </div>
            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> -->

    <?php include "inc/js.php"?>
  </body>
</html>