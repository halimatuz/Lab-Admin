<?php
foreach($institution as $i) {
  $int = $i;
}

foreach($sk_number as $s) {
  $sk = $s;
}

foreach($quotation as $qtn) {
  $amount = ($qtn->add_price + $qtn->standart_price) * $qtn->qty;
  @$jumlah += $amount;
}

foreach($company as $c) {
  $cmp = $c;
}

foreach(@$invoice as $in) {
  @$inv = $in;
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
        border-color: #000!important;
      }
      table.table-bordered > thead > tr > th {
          padding-bottom: 5px!important;
          padding-top: 5px!important;
      }
      table.table-bordered tr th {
          border:1px solid black!important;
          padding-bottom: 0px!important;
          padding-top: 0px!important;
          border-color: #000;
      }
      table.table-bordered > tbody > tr > td {
          padding-bottom: 0px!important;
          padding-top: 0px!important;
          border-color: #000;
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

      @media print {
        table.table-bordered {
          border-color: #000!important;
        }
        table.table-bordered > thead > tr > th {
            padding-bottom: 5px!important;
            padding-top: 5px!important;
        }
        table.table-bordered tr th {
            border:1px solid black!important;
            padding-bottom: 0px!important;
            padding-top: 0px!important;
            border-color: #000!important;
        }
        table.table-bordered > tbody > tr > td {
            padding-bottom: 0px!important;
            padding-top: 0px!important;
            border-color: #000!important;
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
        <h4 class="font-weight-bold text-center"><u>I N V O I C E</u></h4>
          <div class="d-flex justify-content-between">
              <div class="w-100">
                  No : <?= $int->sk_inv ?>
              </div>
              <div class="w-100">
                  <div class="float-right">
                      <table>
                          <tr>
                              <td>Date&emsp;:&emsp;</td>
                              <td><?= @$inv->date_inv ?></td>
                          </tr>
                      </table>
                  </div>
              </div>
          </div>
          <p class="font-weight-bold text-uppercase">Customer</p>
          <div class="d-flex font-weight-bold">
              <div class="w-100 p-4 mr-3" style="border: 1px solid black;">
                  <table>
                      <tr>
                          <td class="text-uppercase">Nama</td>
                          <td class="">:</td>
                          <td class=""><?= $int->name_int ?></td>
                      </tr>
                      <tr>
                          <td class="text-uppercase">Alamat&emsp;</td>
                          <td class="">:&emsp;</td>
                          <td class=""><?= $int->int_address ?></td>
                      </tr>
                  </table>
              </div>
              <div class="w-100 p-4" style="border: 1px solid black;">
                  <table>
                      <tr>
                          <td class="text-uppercase">Po Date</td>
                          <td class="">:</td>
                          <td class=""><?= @$inv->po_date ?></td>
                      </tr>
                      <tr>
                          <td class="text-uppercase">Po No.&emsp;</td>
                          <td class="">:&emsp;</td>
                          <td class=""><?= $sk->sk_quotation ?></td>
                      </tr>
                      <tr>
                          <td class="text-uppercase">Subject&emsp;</td>
                          <td class="">:&emsp;</td>
                          <td class=""><?= @$inv->subject ?></td>
                      </tr>
                  </table>
              </div>
          </div>

          <div class="table-responsive mt-3">
              <table class="table table-bordered table-no-padding" style="border-color:#000;">
                  <tr class="text-center text-uppercase">
                      <th>No.</th>
                      <th>Description</th>
                      <th>Qty</th>
                      <th>Unit Price</th>
                      <th>Amount</th>
                  </tr>
                  <tr>
                      <td>1</td>
                      <td>Biaya Sampling & Analisis Laboratorium Terakreditasi KAN <?= $int->name_int ?></td>
                      <td>100%</td>
                      <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah, 0, ',', '.')) ?></td>
                      <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah, 0, ',', '.')) ?></td>
                  </tr>
                  <tr style="border: 0px!important;">
                      <td style="border: 0px!important;"></td>
                      <td style="border: 0px!important;"></td>
                      <td style="border: 0px!important;"></td>
                      <td>TOTAL</td>
                      <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah, 0, ',', '.')) ?></td>
                  </tr>
                  <tr>
                      <td style="border: 0px!important;"></td>
                      <td style="border: 0px!important;"></td>
                      <td style="border: 0px!important;"></td>
                      <td>PPN <span class="font-weight-bold">10%</span></td>
                      <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah * 0.1, 0, ',', '.')) ?></td>
                  </tr>
                  <tr class="font-weight-bold">
                      <td style="border: 0px!important;"></td>
                      <td style="border: 0px!important;"></td>
                      <td style="border: 0px!important;"></td>
                      <td style="border: 0px!important;">AMOUNT PAID</td>
                      <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah + $jumlah * 0.1, 0, ',', '.')) ?></td>
                  </tr>
              </table>
          </div>

          <div class="w-50 p-2 mb-2 mt-3" style="border: 1px solid black;">
              <p>
                  Please pay the invoice FULL AMOUNT <br>
                  ( without BANK charge) <br>
              </p>
              <table>
                  <tr>
                      <td>Name</td>
                      <td>:</td>
                      <td><?= $cmp->behalf_account ?></td>
                  </tr>
                  <tr>
                      <td>A/C No.&emsp;</td>
                      <td>:&emsp;</td>
                      <td><?= $cmp->norek ?></td>
                  </tr>
                  <tr>
                      <td>BANK</td>
                      <td>:</td>
                      <td><?= $cmp->bank ?></td>
                  </tr>
              </table>
          </div>
          
          <div class="d-flex justify-content-between align-items-end">
            <div class="w-100">
              <div class="p-2 mb-2" style="border: 1px solid black;">
                  <p class="font-weight-bold"><u>Terbilang:</u></p>
                  <?= @$inv->amount_in_words ?>
              </div>
            </div>
            <div class="w-100 text-center">
              <div class="w-50 float-right">
                <p style="margin-bottom: -15px;"><?= $cmp->director ?></p>
                <hr style="height: 2px; background-color: black;">
                <p class="font-weight-bold" style="margin-top: -15px;">Direktur</p>
              </div>
            </div>
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