<?php
foreach($institution as $i) {
    $int = $i;
}

foreach(@$test_req as $test) {
    @$test_r = $test;
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

    <title><?= $title ?></title>
    <style>
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
          <img src="<?= base_url('assets/img/company_profile/') . $cmp->img_logo ?>" alt="" width="220">
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
        <h4 class="text-center"><u>PERMINTAAN PENGUJIAN</u></h4>
        <p class="text-center"><u>Penerimaan Contoh Uji dan Kaji Ulang Permintaan Pengujian</u></p>
        <br>
        <p class="font-weight-bold">I. PERMINTAAN PENGUJIAN</p>
        <table class="table table-bordered table-bordered-dark table-no-padding">
            <tr>
                <th colspan="4">KODE CONTOH UJI</th>
            </tr>
            <tr>
                <td colspan="4">DIISI OLEH PELANGGAN (DENGAN HURUF KAPITAL)</td>
            </tr>
            <tr>
                <td class="font-weight-bold" width="10">1)</td>
                <td class="font-weight-bold">Nama Pelanggan</td>
                <td class="font-weight-bold" width="10">:</td>
                <td><?= $int->name_int ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold" width="10">2)</td>
                <td class="font-weight-bold">Alamat Pelanggan</td>
                <td class="font-weight-bold" width="10">:</td>
                <td><?= $int->int_address ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold" width="10"></td>
                <td class="font-weight-bold">No. Telp/HP.</td>
                <td class="font-weight-bold" width="10">:</td>
                <td><?= $int->int_phone ?></td>
            </tr>
            <tr>
                <td class="font-weight-bold" width="10">3)</td>
                <td class="font-weight-bold">Nama/Jenis Contoh</td>
                <td class="font-weight-bold" width="10">:</td>
                <td>
                  <?= @$test_r->sample_type ?>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold" width="10">4)</td>
                <td class="font-weight-bold">Tanggal Masuk Contoh Uji</td>
                <td class="font-weight-bold" width="10">:</td>
                <td>
                  <?= @$test_r->entry_date ?>
                </td>
            </tr>
            <tr>
                <td class="font-weight-bold" width="10">5)</td>
                <td class="font-weight-bold">Kegiatan/Paket Pekerjaan</td>
                <td class="font-weight-bold" width="10">:</td>
                <td>
                  <?= @$test_r->work_package ?>
                </td>
            </tr>
        </table>

        <table class="table table-bordered table-bordered-dark table-no-padding">
            <tr>
                <th width="10">6)</th>
                <th colspan="4">Rincian Pengujian</th>
            </tr>
            <tr class="text-center">
                <td>No.</td>
                <td>Uraian Parameter Contoh Uji</td>
                <td>Regulasi</td>
                <td>Jumlah Contoh</td>
            </tr>
            <?php $no = 1; foreach(@$test_req_details as $row) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->params ?></td>
                    <td><?= $row->name_regulation ?></td>
                    <td class="text-center"><?= $row->total_example ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <p>DIISI OLEH PETUGAS ADMINISTRASI LABORATORIUM</p>
        <p class="font-weight-bold">II. PENERIMAAN SAMPEL / CONTOH UJI</p>

        <table class="table table-bordered table-bordered-dark table-no-padding">
            <tr>
                <th width="10">No.</th>
                <th>Uraian</th>
                <th>Kondisi Contoh</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>1)</td>
                <td>Jumlah</td>
                <td>
                  <?php if(@$test_r->amount == 1) { ?>
                    Cukup / <s>Tidak</s>
                  <?php } else { ?>
                    <s>Cukup</s> / Tidak
                  <?php } ?>
                </td>
                <td>
                  <?= @$test_r->amount_desc ?>
                </td>
            </tr>
            <tr>
                <td>2)</td>
                <td>Kondisi</td>
                <td>
                  <?php if(@$test_r->condition == 1) { ?>
                    Baik / <s>Tidak</s>
                  <?php } else { ?>
                    <s>Baik</s> / Tidak
                  <?php } ?>
                </td>
                <td>
                  <?= @$test_r->condition_desc ?>
                </td>
            </tr>
            <tr>
                <td>3)</td>
                <td>Tempat contoh uji / wadah</td>
                <td>
                  <?php if(@$test_r->receptacle == 1) { ?>
                    Baik / <s>Tidak</s>
                  <?php } else { ?>
                    <s>Baik</s> / Tidak
                  <?php } ?>
                </td>
                <td>
                  <?= @$test_r->receptacle_desc ?>
                </td>
            </tr>
        </table>

        <table class="table table-bordered table-bordered-dark table-no-padding">
            <tr>
                <td width="48">4)</td>
                <td>
                    Catatan: <br>
                    <?= @$test_r->note_sample ?>
                </td>
                <td>
                    Penerima Contoh: <br>
                    <?= @$test_r->sample_receiver ?>
                </td>
            </tr>
        </table>

        <p class="font-weight-bold">III. KAJI ULANG PERMINTAAN PENGUJIAN</p>

        <table class="table table-bordered table-bordered-dark table-no-padding">
            <tr>
                <td width="10">1)</td>
                <td>Kemampuan SDM</td>
                <td width="10">:</td>
                <td>
                    <?php if(@$test_r->hr_capabilities == 1) { ?>
                      Ya / <s>Tidak</s>
                    <?php } else { ?>
                      <s>Ya</s> / Tidak
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td width="10">2)</td>
                <td>Kesesuaian Metode</td>
                <td width="10">:</td>
                <td>
                    <?php if(@$test_r->method_suitability == 1) { ?>
                      Ya / <s>Tidak</s>
                    <?php } else { ?>
                      <s>Ya</s> / Tidak
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td width="10">3)</td>
                <td>Kemampuan Peralatan</td>
                <td width="10">:</td>
                <td>
                    <?php if(@$test_r->equipment_capability == 1) { ?>
                      Ya / <s>Tidak</s>
                    <?php } else { ?>
                      <s>Ya</s> / Tidak
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td width="10">4)</td>
                <td>Kesimpulan</td>
                <td width="10">:</td>
                <td>
                    <?php if(@$test_r->conclusion == 1) { ?>
                      Bisa / <s>Tidak Bisa</s>
                    <?php } else { ?>
                      <s>Bisa</s> / Tidak Bisa
                    <?php } ?>
                    Dilaksanakan
                </td>
            </tr>
            <tr>
                <td width="10"></td>
                <td>Waktu pelaksanaan pengujian maksimum</td>
                <td>:</td>
                <td>
                    <?= @$test_r->max_time ?> hari kerja *)
                </td>
            </tr>
        </table>

        <table class="table table-bordered table-bordered-dark table-no-padding">
            <tr>
                <td width="36">5)</td>
                <td>
                    Catatan: <br>
                    <?= @$test_r->note_request ?>
                </td>
                <td>
                    Penanggung Jawab Teknis: <br>
                    <?= @$test_r->technical_respon ?>
                </td>
            </tr>
        </table>

        <div class="row">
          <div class="col-3">
            <p class="text-center">PJ Teknis</p>
            <br><br><br>
            <p class="text-center">(.................................................................)</p>
          </div>
          <div class="col-6"></div>
          <div class="col-3">
            <p class="text-center">Pelanggan</p>
            <br><br><br>
            <p class="text-center">(.................................................................)</p>
          </div>
        </div>
        <br><br>
        <p style="font-size: 14px;">Catatan:</p>
        <div style="font-size: 14px;" class="ml-3">
          - Apabila terdapat perubahan yang mengakibatkan pengujian tidak dapat dilakukan atau disubkontrakkan, maka akan ada pemberitahuan dari Laboratorium DIL Kota Bekasi paling lambar 3 (tiga) hari kerja sejak Permintaan Pengujian dterima.
          <br>
          *) Penerbitan Certificate Of Analysis (COA) maksimal 7 (tujuh) hari kerja setelah selesai pelaksanaan uji
        </div>
        </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      // window.print();
    </script>
  </body>
</html>