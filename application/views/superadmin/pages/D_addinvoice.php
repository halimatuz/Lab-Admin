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
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Invoice</h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
                <h4>Add Invoice</h4>
                <a href="<?= base_url('D_superadmin/print_invoice/') . $int->id_sk ?>" class="btn btn-primary ml-auto"><i class="fas fa-print"></i> Print</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('D_superadmin/save_invoice') ?>" method="POST">
                    <input type="hidden" name="id_sk" value="<?= $int->id_sk ?>">
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
                                        <td><input type="date" name="date_inv" class="form-control inline-block" value="<?= @$inv->date_inv ?>"></td>
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
                                    <td class=""><input type="date" name="po_date" class="form-control" value="<?= @$inv->po_date ?>"></td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Po No.&emsp;</td>
                                    <td class="">:&emsp;</td>
                                    <td class=""><?= $sk->sk_quotation ?></td>
                                </tr>
                                <tr>
                                    <td class="text-uppercase">Subject&emsp;</td>
                                    <td class="">:&emsp;</td>
                                    <td class=""><input type="text" name="subject" class="form-control" placeholder="Insert subject" value="<?= @$inv->subject ?>"></td>
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
                            <tr style="border: 0px;">
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td>TOTAL</td>
                                <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah, 0, ',', '.')) ?></td>
                            </tr>
                            <tr style="border: 0px;">
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td>
                                    DISKON
                                    <div class="input-group">
                                        <input type="number" name="discount" class="form-control currency" style="width: 30px;" value="<?= @$inv->discount ?>">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                %
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-success">- Rp&nbsp;<?= htmlspecialchars(number_format($jumlah * (@$inv->discount / 100), 0, ',', '.')) ?></td>
                            </tr>
                            <tr>
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td>
                                    PPN
                                    <div class="input-group">
                                        <input type="number" name="ppn" class="form-control currency" style="width: 30px;" value="<?= @$inv->ppn ?>">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                %
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah * (@$inv->ppn / 100), 0, ',', '.')) ?></td>
                            </tr>
                            <tr class="font-weight-bold">
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;"></td>
                                <td style="border: 0px;">AMOUNT PAID</td>
                                <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah - ($jumlah * (@$inv->discount / 100)) + ($jumlah * (@$inv->ppn / 100)), 0, ',', '.')) ?></td>
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
                    
                    <div class="w-50 p-2 mb-2" style="border: 1px solid black;">
                        <p class="font-weight-bold"><u>Terbilang:</u></p>
                        <input type="text" name="amount_in_words" class="form-control" placeholder="Insert Amount in words" value="<?= @$inv->amount_in_words ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>

                </div>
            </form>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>
