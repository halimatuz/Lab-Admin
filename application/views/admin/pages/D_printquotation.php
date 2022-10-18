<?php
foreach($quotation as $quot) {
  $qtn = $quot;
}
foreach($company as $c) {
  $cmp = $c;
}

function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('/', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return  @$pecahkan[0] . ' ' . @$bulan[ (int)$pecahkan[1]] . ' ' . @$pecahkan[2];
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

    <title><?= $title . ' ' . @$qtn->name_int ?></title>
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
          <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
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
        <h5 class="text-center font-weight-bold"><u>QUOTATION</u></h5>
        <div class="row mt-5">
          <div class="col-md-6">
            <p class="font-weight-bold">No Quot.&emsp;&emsp;:&emsp;&emsp;<?= @$qtn->sk_quotation ?></p>
            <hr style="background-color: black;">
            <div style="border: 1px solid black;" class="p-1">
              <table class="font-weight-bold">
                <tr>
                  <td>To</td>
                  <td>:</td>
                  <td><?= @$qtn->name_int ?></td>
                </tr>
                <tr>
                  <td>Address&emsp;&emsp;&emsp;</td>
                  <td>:&emsp;</td>
                  <td><?= @$qtn->int_address ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <p class="font-weight-bold">Date&emsp;&emsp;:&emsp;&emsp;<?= tgl_indo(@$qtn->date_quotation); ?></p>
            <hr style="background-color: black;">
            <div style="border: 1px solid black;" class="p-1">
              <table class="font-weight-bold">
                <tr>
                  <td>Up</td>
                  <td>:</td>
                  <td><?= @$qtn->name_cp ?></td>
                </tr>
                <tr>
                  <td>Title</td>
                  <td>:</td>
                  <td><?= @$qtn->title_cp ?></td>
                </tr>
                <tr>
                  <td>Email&emsp;&emsp;&emsp;</td>
                  <td>:&emsp;</td>
                  <td><?= @$qtn->int_email ?></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
    </div>

    <div class="container mt-2">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">NO.</th>
              <th scope="col">JENIS LAYANAN</th>
              <th scope="col">BAKU MUTU / SPESIFIKASI</th>
              <th scope="col">QTY</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">A</th>
              <th colspan="3">Biaya Sampling & Analisis Laboratorium Terakreditasi KAN</th>
            </tr>
            <?php $no = 1; foreach($quotation as $qtn) : 
              $amount = ($qtn->add_price + $qtn->standart_price) * $qtn->qty;
              @$jumlah += $amount;
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= @$qtn->remarks; ?></td>
                <td><?= @$qtn->spec; ?></td>
                <td><?= @$qtn->qty; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </div>
    <div class="container mt-5">
      <p class="font-weight-bold"><u>A. Ruang Lingkup Pekerjaan:</u></p>
      <ul>
        <li>Sampling dan Analisis dilakukan setelah Purchase Order diterima</li>
        <li>Masa berlaku penawaran enam bulan</li>
        <li>Parameter yang tidak dapat dikerjakan oleh Laboratorium Delta Indonesia Laboratory akan disubkontraktorkan ke Laboratorium Penguji yang Terakreditasi KAN.</li>
      </ul>
      <br><br>
      <p class="font-weight-bold"><u>B. Termin Pembayaran:</u></p>
      <ul>
        <li>Harga diatas dapat berubah disesuaikan dengan volume pekerjaan dan parameter</li>
        <li>
          Pembayaran tagihan dibayar via transfer ke rekening DIL <br>
          <table>
            <tr>
              <td>No. Rek&emsp;&emsp;</td>
              <td>:&emsp;</td>
              <td><?= $cmp->norek ?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td><?= $cmp->behalf_account ?></td>
            </tr>
            <tr>
              <td>Bank</td>
              <td>:</td>
              <td><?= $cmp->bank ?></td>
            </tr>
          </table>
        </li>
        <li>Maksimal 30 hari setelah tagihan diterima oleh customer</li>
      </ul>
      <div class="row mt-5">
        <div class="col-md-3">
          <p style="font-size: 10px!important; font-weight: bold; margin-top: 70px; margin-bottom: -8px;"><?= $cmp->address ?> <br>Telp : <?= $cmp->phone ?></p>
          <a href="<?= $cmp->website ?>" style="font-size: 10px; color: blue; text-decoration: underline;" class="block"><?= $cmp->website ?></a>
        </div>
        <div class="col-md-5"></div>
        <div class="col-md-4">
          <img src="<?= base_url('assets/img/ttd.png') ?>" alt="" class="ml-3">
          <p class="text-center"><?= $cmp->director ?></p>
          <hr style="height:2px; background-color: black;">
          <p class="font-weight-bold text-center" style="margin-top: -10px;"><?= $cmp->name ?></p>
        </div>
      </div>
      <hr style="height:2px; background-color: black;" class="mt-4">
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