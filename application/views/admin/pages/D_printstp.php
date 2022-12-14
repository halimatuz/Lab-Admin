<?php
foreach($sampling_det as $sd) {
  $smpl_det = $sd;
}

foreach($company as $c) {
  $cmp = $c;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?= $title . ' ' . $smpl_det->name_int ?></title>
    <style>
      table.table-bordered {
          border:1px solid black!important;
      }
      table.table-bordered > thead > tr > th {
          border:1px solid black!important;
      }
      table.table-bordered tr th {
          border:1px solid black!important;
      }
      table.table-bordered > tbody > tr > td {
          border:1px solid black!important;
      }
      p {
        line-height: 16px!important;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
        </div>
        <div class="col-md-6">
          <img src="<?= base_url('assets/img/kan.png') ?>" alt="" width="150px" style="margin-left: 300px;">
          <p style="font-size:10px; font-weight: bold; margin-top:10px;" class="text-right">SK-KLHK No 00161/LPJ/Labling-1/LRK/KLHK</p>
          <p style="font-size: 9px; margin-left: 75px; margin-top: -10px;" class="text-right">7.8.1/DIL/VII/2018/FORM REV . 2</p>
        </div>
      </div>
      <hr style="height: 2px; background-color: black;">
    </div>
    <div class="container">
        <h5 class="text-center font-weight-bold"><u>SURAT TUGAS PENGUJIAN SAMPEL</u></h5>
        <p class="text-small text-center">No. <?= $smpl_det->sk_analysis ?></p>
        <div class="container mt-5">
          <p>Memerintahkan kepada :</p>
          <?php $no = 1; foreach($sampler as $smp) {
            echo '<p>' . $no++ . '. ' . $smp->name_smp . '</p>';
          } ?>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Sampel ID</th>
              <th scope="col">Parameter Uji</th>
              <th scope="col">Tipe Sampel</th>
              <th scope="col">Deadline Pengujian</th>
              <th scope="col">Keterangan</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; $no_sampel = 1; foreach($sampling_det as $sampling) :
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $sampling->id_sk . '.' . '0' . $no_sampel++; ?></td>
                <td><?= $sampling->sample_desc; ?></td>
                <td><?= $sampling->sample_type; ?></td>
                <td><?= $sampling->deadline; ?></td>
                <td><?= $sampling->description; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-3">
          <p class="text-center">Admin</p>
          <br><br><br>
          <p class="text-center font-weight-bold mt-3">Novita Putridiana</p>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
          <p class="text-center">Bekasi, <?= date('dS F, Y', strtotime($smpl_det->date_analysis)); ?><br><?= $cmp->name ?></p>
          <br><br><br>
          <p class="text-center"><u class="font-weight-bold">Fadhelun</u><br>PJ Teknis</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
          <div class="col-md-3">
            <p style="font-size: 10px!important; font-weight: bold; margin-top: 70px; margin-bottom: -8px;"><?= $cmp->address ?> <br>Telp : <?= $cmp->phone ?></p>
            <a href="<?= $cmp->website ?>" style="font-size: 10px; color: blue; text-decoration: underline;" class="block"><?= $cmp->website ?></a>
          </div>
          <div class="col-md-9"></div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      window.print();
    </script>
  </body>
</html>