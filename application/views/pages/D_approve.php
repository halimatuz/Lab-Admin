<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $title; ?> | DIL Information</title>
  <link rel="shortcut icon" href="<?= base_url() ?>assets/img/logo-icon.png" type="image/x-icon">

  <!-- Select 2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/select2/dist/css/select2.min.css">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
  <style>
    lottie-player {
    margin: -80px auto;
  }
  </style>
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>
<body>
<!-- Main Content -->
<div class="px-4 mt-5">
  <section class="section">

    <div class="section-body">
    <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12 col-md-9 mx-auto">
          <div class="card card-success">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="<?= base_url('assets/img/logo.png') ?>" alt="" style="transform: translateX(-50%); position: relative; left:50%;" width="150px">
                        <h4 class="font-weight-bold text-center mt-2">PT. DELTA INDONESIA LABORATORY</h4>
                        <p class="text-center">Jl. Perum Prima Harapan Regency, Gedung Prima Orchard Block C, No. 2, Bekasi Utara, Kota Bekasi 17123, Provinsi Jawa Barat. Telp. (021) 88382018</p>
                        <hr>
                        <lottie-player src="<?= base_url('assets/lottie/success.json') ?>" background="transparent"  speed="1"  style="width: 350px; height: 350px;" autoplay></lottie-player>
                        <?php foreach($result as $rsl) : ?>
                            <h4 class="text-success text-center">No. Certificate <?= $rsl->no_certificate ?> Approved!</h4>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>
</body>