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
                    <?php 
                    if($this->uri->segment(2) == 'update_stp') {
                    foreach ($special_assign as $sa) : ?>
                    <div class="col-md-4">
                        <h6 class="text-primary">Add STP For <?= $sk_number->name_int; ?></h6>
                        <p class="font-weight-bold">No. <?= $sk_number->sk_analysis; ?></p>
                        <hr>
                        <form action="<?= base_url('D_stp/update_stp_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Test Parameters</label>
                                <input type="text" class="form-control" value="<?= $sa->sample_desc ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Sample Type</label>
                                <input type="hidden" name="id_sampling" value="<?= $sa->id_sampling ?>">
                                <input type="hidden" name="id_sk" value="<?= $sa->id_sk ?>">
                                <input type="text" name="sample_type" value="<?= set_value('sample_type')?>" class="form-control">
                                <?php echo form_error('sample type', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Deadline Testing</label>
                                <input type="date" name="deadline" class="form-control" value="<?= set_value('deadline')?>">
                                <?php echo form_error('deadline', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control"><?= set_value('description')?></textarea>
                                <?php echo form_error('description', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update STP</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_stp/add_stp/') . $sk_number->id_sk ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } ?>
                </div>
                    <div class="<?php if($this->uri->segment(2) == 'update_stp') {echo 'col-md-8';}else{echo 'col-md-12';} ?>">
                        <a href="<?= base_url('D_stp/print_stp/') . $sk_number->id_sk ?>" class="btn btn-primary" target="_blank">Print</a>
                        <hr>
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
                        <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Test Parameters</th>
                                    <th>Sample Type</th>
                                    <th>Deadline Testing</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($sampling_det as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->sample_desc); ?></td>
                                        <td><?= htmlspecialchars($row->sample_type); ?></td>
                                        <td><?= htmlspecialchars($row->deadline); ?></td>
                                        <td><?= ($row->description); ?></td>
                                        <td>
                                            <a href="<?= base_url('D_stp/update_stp/') . $row->id_sampling . '/' . $row->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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