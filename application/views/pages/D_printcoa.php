<?php
foreach($coa as $co) {
  $coa_det = $co;
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

    <title><?= $title . ' ' . $coa_det->name_int ?></title>
    <style>
      table.table-bordered {
          border:1px solid black!important;
      }
      table.table-bordered th{
          padding-top: 0px!important;
          padding-bottom: 0px!important;
      }
      table.table-bordered td{
          padding-top: 0px!important;
          padding-bottom: 0px!important;
      }
      .no-padding {
        padding-top: 0px!important;
        padding-bottom: 0px!important;
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
      td {
        padding-top: 10px!important;
      }
    </style>
  </head>
  <body>
    <div class="container mb-5">
      <div class="row">
        <div class="col-md-6">
          <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
        </div>
        <div class="col-md-6">
          <h4 class="font-weight-bold text-right mb-4">PT. Delta Indonesia Laboratory</h4>
          <p class="text-right">Jln. Perum Prima Harapan Regency, Gedung Prima Orchard Block C, No 2</p>
          <p class="text-right">Bekasi Utara, Kota Bekasi 17123, Provinsi Jawa Barat</p>
          <p class="text-right">Telp : 021 - 88382018</p>
        </div>
      </div>
    </div>

    <div class="container mt-5">
        <h3 class="text-center font-weight-bold">CERTIFICATE OF ANALYSIS (COA)</h1>
        <p class="text-small text-center">Certificate No. <?= $coa_det->no_certificate ?></p>
        <div class="col-md-11 mx-auto">
            <table class="mt-5">
                <tr>
                    <td>Customer</td>
                    <td>:</td>
                    <td><?= $coa_det->name_int ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?= $coa_det->int_address ?></td>
                </tr>
                <tr>
                    <td>Contact Name</td>
                    <td>:&emsp;</td>
                    <td><?= $coa_det->name_cp ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?= $coa_det->int_email ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?= $coa_det->int_phone ?></td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td>:</td>
                    <td>
                        <?php foreach($analysis as $anl) : ?>
                            - <?= $anl->name_analysis ?> <br>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td>Sample taken by</td>
                    <td>:</td>
                    <td>PT. Delta Indonesia Laboratory</td>
                </tr>
                <tr>
                    <td>Sample Receive Date</td>
                    <td>:</td>
                    <td><?= $coa_det->date_sample ?></td>
                </tr>
                <tr>
                    <td>Sample Analysis Date&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</td>
                    <td>:</td>
                    <td><?= $coa_det->date_analysis ?></td>
                </tr>
                <tr>
                    <td>Report Date</td>
                    <td>:</td>
                    <td><?= $coa_det->date_report ?></td>
                </tr>
            </table>
        </div>
    </div>


    <?php 
    foreach($analysis as $anl) :
    if($anl->name_analysis == 'Clean Water') { ?>               
    <div class="container mb-5" style="margin-top: 1000px;">
      <div class="row">
        <div class="col-md-6">
          <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
        </div>
        <div class="col-md-6">
          <h4 class="font-weight-bold text-right mb-4">PT. Delta Indonesia Laboratory</h4>
          <p class="text-right">Jln. Perum Prima Harapan Regency, Gedung Prima Orchard Block C, No 2</p>
          <p class="text-right">Bekasi Utara, Kota Bekasi 17123, Provinsi Jawa Barat</p>
          <p class="text-right">Telp : 021 - 88382018</p>
        </div>
      </div>
    </div>

    <div class="container">
        <h3 class="text-center font-weight-bold">CERTIFICATE OF ANALYSIS (COA)</h1>
        <p class="text-small text-center">Certificate No. <?= $anl->no_certificate ?></p>
        <table class="table table-bordered">
            <tr>
                <th>Sample No.</th>
                <th>Sampling Location</th>
                <th>Sample Description</th>
                <th>Sampling Date</th>
                <th>Sampling Time</th>
                <th>Date Received</th>
                <th>Interval Testing Date</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><?= $anl->name_analysis ?></td>
                <td><?= $anl->date_analysis ?></td>
                <td></td>
                <td><?= $anl->date_sample ?></td>
                <td></td>
            </tr>
        </table>
        <table class="table table-bordered mt-5">
            <tr>
                <th>No</th>
                <th>Parameters</th>
                <th>Unit</th>
                <th>Testing Result</th>
                <th>Regulatory Standard**</th>
                <th>Methods</th>
            </tr>
            <tr>
                <td></td>
                <th colspan="5">Physical Parameters:</th>
            </tr>
            <?php $no=1; foreach($coa as $c) : if($c->category_params == 'Physical' && $c->name_analysis == 'Clean Water') {  
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $c->params ?></td>
                <td><?= $c->unit ?></td>
                <td><?= $c->result ?></td>
                <td><?= $c->reg_standart_1 ?></td>
                <td><?= $c->name_method ?></td>
            </tr>
            <?php } endforeach; ?>
            <tr>
                <td></td>
                <th colspan="5">Chemistry Parameters:</th>
            </tr>
            <?php $no=1; foreach($coa as $c) : if($c->category_params == 'Chemistry' && $c->name_analysis == 'Clean Water') {  
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $c->params ?></td>
                <td><?= $c->unit ?></td>
                <td><?= $c->result ?></td>
                <td><?= $c->reg_standart_1 ?></td>
                <td><?= $c->name_method ?></td>
            </tr>
            <?php } endforeach; ?>
            <tr>
                <td></td>
                <th colspan="5">Microbiology Parameters:</th>
            </tr>
            <?php $no=1; foreach($coa as $c) : if($c->category_params == 'Microbiology' && $c->name_analysis == 'Clean Water') {  
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $c->params ?></td>
                <td><?= $c->unit ?></td>
                <td><?= $c->result ?></td>
                <td><?= $c->reg_standart_1 ?></td>
                <td><?= $c->name_method ?></td>
            </tr>
            <?php } endforeach; ?>
        </table>

        <table>
          <tr>
            <td><b>Notes:</b></td>
          </tr>
          <tr>
            <td class="no-padding"><</td>
            <td class="no-padding">Less Than MDL (Method Detection Limit)</td>
          </tr>
          <tr>
            <td class="no-padding">**&emsp;&emsp;&emsp;</td>
            <td class="no-padding">Regulation of the Minister of Helath No. 32 of 2017 Regarding Environtmental Health Quality Standards for Water Media for Sanitary Hygiene Purposes</td>
          </tr>
        </table>
    </div>
    <?php } endforeach; ?>
    
    <?php 
    foreach($analysis as $anl) :
    if($anl->name_analysis == 'Air Emission (Non-Isocinetic)') { ?>               
    <div class="container mb-5" style="margin-top: 1000px;">
      <div class="row">
        <div class="col-md-6">
          <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
        </div>
        <div class="col-md-6">
          <h4 class="font-weight-bold text-right mb-4">PT. Delta Indonesia Laboratory</h4>
          <p class="text-right">Jln. Perum Prima Harapan Regency, Gedung Prima Orchard Block C, No 2</p>
          <p class="text-right">Bekasi Utara, Kota Bekasi 17123, Provinsi Jawa Barat</p>
          <p class="text-right">Telp : 021 - 88382018</p>
        </div>
      </div>
    </div>

    <div class="container">
        <h3 class="text-center font-weight-bold">CERTIFICATE OF ANALYSIS (COA)</h1>
        <p class="text-small text-center">Certificate No. <?= $anl->no_certificate ?></p>
        <table class="table table-bordered">
            <tr>
                <th>Sample No.</th>
                <th>Sampling Location</th>
                <th>Sample Description</th>
                <th>Sampling Date</th>
                <th>Sampling Time</th>
                <th>Date Received</th>
                <th>Interval Testing Date</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><?= $anl->name_analysis ?></td>
                <td><?= $anl->date_analysis ?></td>
                <td></td>
                <td><?= $anl->date_sample ?></td>
                <td></td>
            </tr>
        </table>
        <table class="table table-bordered mt-5">
            <tr>
                <th>No</th>
                <th>Parameters</th>
                <th>Testing Result</th>
                <th>Regulatory Standard**</th>
                <th>Unit</th>
                <th>Methods</th>
            </tr>
            <?php $no=1; foreach($coa as $c) : if($c->name_analysis == 'Air Emission (Non-Isocinetic)') {  
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $c->params ?></td>
                <td><?= $c->result ?></td>
                <td><?= $c->reg_standart_1 ?></td>
                <td><?= $c->unit ?></td>
                <td><?= $c->name_method ?></td>
            </tr>
            <?php } endforeach; ?>
            <tr>
              <td colspan="6">Coordinate :<br>Velocity :</td>
            </tr>
        </table>

        <table>
          <tr>
            <td><b>Notes:</b></td>
          </tr>
          <tr>
            <td class="no-padding"><</td>
            <td class="no-padding">Less Than MDL (Method Detection Limit)</td>
          </tr>
          <tr>
            <td class="no-padding">*</td>
            <td class="no-padding">Accredited Parameters</td>
          </tr>
          <tr>
            <td class="no-padding">**&emsp;&emsp;&emsp;</td>
            <td class="no-padding">Regulation of the Minister of Helath No. 32 of 2017 Regarding Environtmental Health Quality Standards for Water Media for Sanitary Hygiene Purposes</td>
          </tr>
        </table>
    </div>
    <?php } endforeach; ?>


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