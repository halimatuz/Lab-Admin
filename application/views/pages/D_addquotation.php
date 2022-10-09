<?php

foreach($specialInstitution as $si) {
    $institution = $si;
}

?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Quotation</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="#">Dashboard</a>
        </div>
        <div class="breadcrumb-item">
          <a href="#">Modules</a>
        </div>
        <div class="breadcrumb-item">
          DataTables
        </div>
      </div>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <h6 class="text-primary">Add Quotation For <?= $institution->name_int; ?></h6>
                    <p class="font-weight-bold">No. <?php foreach($sknumber as $sn) { echo $sn->sk_quotation; } ?></p>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_quotation') {
                    foreach ($specialQuotation as $qtn) : ?>
                        <form action="<?= base_url('D_quotation/update_quotation_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Analysis</label>
                                <input type="hidden" name="id_quotation" value="<?= $qtn->id_quotation ?>">
                                <input type="hidden" name="id_int" value="<?= $institution->id_int ?>">
                                <input type="hidden" name="id_sk" value="<?= $qtn->id_sk ?>">
                                <select name="id_analysis" class="form-control select2 <?php if(form_error('id_analysis')) { echo "is-invalid"; } ?>">
                                <option value="<?= $qtn->id_analysis ?>"><?= $qtn->name_analysis ?></option>
                                    <?php foreach($analysis as $anl) : ?>
                                        <option value="<?= $anl->id_analysis ?>"><?= $anl->name_analysis ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('analysis', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="summernote-simple" name="remarks"><?= $qtn->remarks ?></textarea>
                                <?php echo form_error('remarks', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Specification</label>
                                <textarea class="summernote-simple" name="spec"><?= $qtn->spec ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control <?php if(form_error('qty')) { echo "is-invalid"; } ?>" name="qty" value="<?= $qtn->qty ?>" autocomplete="off" placeholder="Insert quantity">
                                <?php echo form_error('qty', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Additional Price</label>
                                <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    Rp
                                    </div>
                                </div>
                                <input type="number" class="form-control <?php if(form_error('add_price')) { echo "is-invalid"; } ?>" id="tanpa-rupiah" name="add_price" value="<?= $qtn->add_price ?>" autocomplete="off" placeholder="Insert standart price...">
                                </div>
                                <?php echo form_error('add_price', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Quotation</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_quotation/add_quotation/') . $institution->id_int ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_quotation/add_quotation_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Analysis</label>
                                <input type="hidden" name="id_int" value="<?= $institution->id_int ?>">
                                <select name="id_analysis" class="form-control select2 <?php if(form_error('id_analysis')) { echo "is-invalid"; } ?>">
                                <option value="<?php if( set_value('id_analysis') == NULL) { echo "";}else { echo set_value('id_analysis');}?>"><?php if( set_value('id_analysis') == NULL) { echo "-- Select Analysis --";}else { echo set_value('analysis');}?></option>
                                    <?php foreach($analysis as $anl) : ?>
                                        <option value="<?= $anl->id_analysis ?>"><?= $anl->name_analysis ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('analysis', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea class="summernote-simple" name="remarks"><?= set_value('analysis') ?></textarea>
                                <?php echo form_error('remarks', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label for="">Specification</label>
                                <textarea class="summernote-simple" name="spec"><?= set_value('analysis') ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control <?php if(form_error('qty')) { echo "is-invalid"; } ?>" name="qty" value="<?= set_value('qty')?>" autocomplete="off" placeholder="Insert quantity">
                                <?php echo form_error('qty', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Additional Price</label>
                                <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    Rp
                                    </div>
                                </div>
                                <input type="number" class="form-control <?php if(form_error('add_price')) { echo "is-invalid"; } ?>" id="tanpa-rupiah" name="add_price" value="<?= set_value('add_price')?>" autocomplete="off" placeholder="Insert standart price...">
                                </div>
                                <?php echo form_error('add_price', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Quotation</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <a href="<?= base_url('D_quotation/print_quotation/') . $institution->id_int ?>" class="btn btn-primary">Print</a>
                        <hr>
                        <?php if($quotation == NULL) { ?>
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                                </div>
                                <h2>We couldn't find any data</h2>
                                <p class="lead">
                                Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                                </p>
                            </div>
                        <?php } else { ?>
                        <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Analysis</th>
                                    <th>Remarks</th>
                                    <th>Spec</th>
                                    <th>Quantity</th>
                                    <th>Standard Price</th>
                                    <th>Additional Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($quotation as $row) :
                                $amount = ($row->add_price + $row->standart_price) * $row->qty;
                                @$jumlah += $amount; ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->name_analysis); ?></td>
                                        <td><?= ($row->remarks); ?></td>
                                        <td><?= ($row->spec); ?></td>
                                        <td><?= htmlspecialchars($row->qty); ?></td>
                                        <td>Rp <?= htmlspecialchars(number_format($row->standart_price, 0, ',', '.')) ?></td>
                                        <td>Rp <?= htmlspecialchars(number_format($row->add_price, 0, ',', '.')) ?></td>
                                        <td>
                                            <a href="<?= base_url('D_quotation/update_quotation/') . $row->id_int . '/' . $row->id_quotation ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('D_quotation/delete_quotation/') . $row->id_quotation . '/' . $row->id_int . '/' . $row->id_analysis ?>"class="btn btn-danger tombol-hapus" type="submit"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr class="font-weight-bold">
                                    <td colspan="7">Total:</td>
                                    <td>Rp&nbsp;<?= htmlspecialchars(number_format($jumlah, 0, ',', '.'))?></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>