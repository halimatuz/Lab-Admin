<?php

foreach($specialSK as $sk) {
    $sk_number = $sk;
}

?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data STP <?= $sk_number->name_int; ?></h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Insert STPS Date</h4>
            </div>
            <div class="card-body">
              <form action="<?= base_url('D_superadmin/add_stp_date') ?>" method="POST">
                <div class="form-group">
                  <div class="row">
                    <div class="col-9">
                      <input type="hidden" name="id_sk" value="<?= $sk_number->id_sk ?>">
                      <input type="date" name="date_analysis" class="form-control <?php if(form_error('date_analysis')) { echo "is-invalid"; } ?>" value="<?= $sk_number->date_analysis ?>">
                      <?php echo form_error('date_analysis', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="col-3">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
                <div class="row">
                    
                </div>
                    <div class="col-md-12">
                          <a href="<?= base_url('D_superadmin/print_stp/') . $sk_number->id_sk ?>" class="btn btn-primary float-right" target="_blank">Print</a>
                        <div class="float-left">
                          <h6 class="text-primary">Add STP For <?= $sk_number->name_int; ?></h6>
                          <p class="font-weight-bold">No. <?= $sk_number->sk_analysis; ?></p>
                        </div>
                        <?php if($sampling_det == NULL) { ?>
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
                        <form action="<?= base_url('D_superadmin/update_stp_action') ?>" method="POST">
                          <div class="table-responsive">
                          <table class="table table-striped">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>ID Sample</th>
                                      <th>Test Parameters</th>
                                      <th>Sample Type</th>
                                      <th>Deadline Testing</th>
                                      <th>Description</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $no = 1;
                                  foreach ($sampling_det as $row) : ?>
                                      <tr>
                                          <td><?= $no; ?></td>
                                          <td><input type="text" name="sample_id[]" class="form-control" value="<?= $row->id_sk . '.' . sprintf('%02d', $no++); ?>" readonly></td>
                                          <td><?= htmlspecialchars($row->sample_desc); ?></td>
                                          <input type="hidden" name="id_sampling[]" value="<?= $row->id_sampling ?>">
                                          <input type="hidden" name="id_sk" value="<?= $row->id_sk ?>">
                                          <td><?= $row->name_analysis ?></td>
                                          <td><input type="date" class="form-control" name="deadline[]" value="<?= $row->deadline ?>"></td>
                                          <td><input type="text" class="form-control" name="description[]" value="<?= $row->description ?>"></td>
                                      </tr>
                                  <?php endforeach; ?>
                              </tbody>
                              </table>
                          </div>
                          <button type="submit" class="btn btn-primary float-right"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                          <a href="<?= base_url('D_superadmin/data_stp_index') ?>" class="btn btn-danger float-left"><i class="fas fa-arrow-left"></i> Back to List Quotation</a>
                        </form>
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