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
      <div class="row">
        <div class="col-12 col-md-9 mx-auto">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h5 class="text-center text-primary">Please point the QR Code in front of your camera!</h5>
                        <hr>
                        <?php
                        $attributes = array('id' => 'button');
                        echo form_open('D_scancoa/cek_id',$attributes);?>
                        <div class="mx-auto">
                            <video id="video" style="border: 1px solid gray;" width="50%"></video>
                        </div>
                        <div id="sourceSelectPanel" style="display:none;" class="mx-auto mt-2">
                            <label for="sourceSelect">Change video source:</label>
                            <select id="sourceSelect"></select>
                        </div>
                        <textarea hidden="" name="id_sk" id="result" readonly></textarea>
                        <?php echo form_close();?>
                    </div>
                </div>
                <a href="<?= base_url(); ?>" class="btn btn-primary mx-auto mt-4" style="position: relative; left:50%; transform: translateX(-50%);">Kembali</a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>
</body>