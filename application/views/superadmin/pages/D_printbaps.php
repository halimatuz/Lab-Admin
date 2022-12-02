<?php
date_default_timezone_set('Asia/Jakarta');
foreach($institution as $i) {
    $int = $i;
}

foreach(@$bpas as $b) {
  @$bp = $b;
}

foreach($company as $c) {
  $cmp = $c;
}

foreach($sk_number as $s) {
  $sk = $s;
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

    <title><?= $title ?></title>
    <style>
      * {
          -webkit-print-color-adjust: exact !important;   /* Chrome, Safari 6 – 15.3, Edge */
          color-adjust: exact !important;                 /* Firefox 48 – 96 */
      }

      table.table-bordered {
          border:1px solid black!important;
      }
      table.table-bordered > thead > tr > th {
          border:1px solid black!important;
          padding-bottom: 5px!important;
          padding-top: 5px!important;
      }
      table.table-bordered tr th {
          border:1px solid black!important;
          padding-bottom: 0px!important;
          padding-top: 0px!important;
      }
      table.table-bordered > tbody > tr > td {
          border:1px solid black!important;
          padding-bottom: 0px!important;
          padding-top: 0px!important;
      }
      p {
        font-size: 14px!important;
        line-height: 16px!important;
      }
      li {
        font-size: 14px!important;
      }
      tr {
        font-size: 14px!important;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <img src="<?= base_url('assets/img/company_profile/logo/') . $cmp->img_logo ?>" alt="" width="220">
        </div>
        <div class="col-md-3">
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
        <h5 class="text-center"><u>Berita Acara Pengambilan Sampel</u></h5>
        <p class="text-center">Nomor: <?= $int->sk_baps ?></p>
        <br>
        <p>Telah dilakukan pengambilan sampel udara oleh pihak PT Delta Indonesia Laboratory pada</p>
        <table>
          <tr>
            <td>Perusahaan&emsp;</td>
            <td>:&emsp;</td>
            <td class="font-weight-bold"><?= $int->name_int ?></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td class="font-weight-bold"><?= $int->int_address ?></td>
          </tr>
          <tr>
            <td>Telp</td>
            <td>:</td>
            <td class="font-weight-bold"><?= $int->int_phone ?></td>
          </tr>
        </table>
        <p>Pada hari <?= date("l", strtotime($int->date_sample)) ?> tanggal <?= date("d F Y", strtotime($int->date_sample)) ?> pukul <?= date("H:i", strtotime($int->date_sample)) ?> dengan lokasi masing-masing:</p>

        <div class="row">
            <div class="col-md-6">
                <table>
                    <tr>
                        <td>Udara Ambien</td>
                        <td>:</td>
                        <td><?= @$bp->air_ambient ?></td>
                        <td>titik</td>
                    </tr>
                    <tr>
                        <td>Emisi Cerobong&emsp;</td>
                        <td>:&nbsp;</td>
                        <td><?= @$bp->chimney_emission ?>&nbsp;</td>
                        <td>titik</td>
                    </tr>
                    <tr>
                        <td>Pencahayaan</td>
                        <td>:</td>
                        <td><?= @$bp->lightning ?></td>
                        <td>titik</td>
                    </tr>
                    <tr>
                        <td>Heat Stress</td>
                        <td>:</td>
                        <td><?= @$bp->heat_stress ?></td>
                        <td>titik</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table>
                    <tr>
                        <td>Udara Ruang Kerja&emsp;</td>
                        <td>:</td>
                        <td><?= @$bp->workspace_air ?></td>
                        <td>titik</td>
                    </tr>
                    <tr>
                        <td>Kebauan</td>
                        <td>:&nbsp;</td>
                        <td><?= @$bp->smell ?>&nbsp;</td>
                        <td>titik</td>
                    </tr>
                    <tr>
                        <td>Kebisingan</td>
                        <td>:</td>
                        <td><?= @$bp->noise ?></td>
                        <td>titik</td>
                    </tr>
                    <tr>
                        <td>Air Limbah</td>
                        <td>:</td>
                        <td><?= @$bp->wastewater ?></td>
                        <td>titik</td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="table table-bordered table-bordered-dark table-no-padding mt-3">
            <tr class="text-center">
                <td>No.</td>
                <td>Lokasi</td>
                <td>Parameters</td>
                <td>Regulasi</td>
                <td>Jenis Sampel</td>
                <td>Waktu Pengukuran (Jam)</td>
            </tr>
              <?php $no = 1; foreach(@$sampling_det as $row) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->location ?></td>
                    <td><?= $row->sample_desc ?></td>
                    <td><?= $row->name_regulation ?></td>
                    <td><?= $row->alias_analysis ?></td>
                    <td><?= $row->measurement_time ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="row">
          <div class="col-3 text-center position-relative">
            <p>Pihak Laboratorium</p>
            <br><br><br>
            <?php echo @$bp->name_smp == null ? "<br>" : '' ?>
            <p style="margin-bottom: -10px;"><?= @$bp->name_smp ?></p>
            <p>(.................................................................)</p>
            <p style="margin-top: -15px;">Petugas Pengambil Sampel</p>
          </div>
          <div class="col-6"></div>
          <div class="col-3 text-center">
            <p class="text-center">Pihak Perusahaan</p>
            <?php if($sk->int_signature_baps == NULL) { ?>
            <br><br><br>
            <?php } else { ?>
            <img src="<?= base_url('') . $sk->int_signature_baps ?>" alt="" width="180px">
            <?php } ?>
            <p style="margin-bottom: -10px;"><?= @$sk->int_person_baps ?></p>
            <p class="text-center">(.................................................................)</p>
          </div>
        </div>
      <p class="mt-2">*Note:</p>
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