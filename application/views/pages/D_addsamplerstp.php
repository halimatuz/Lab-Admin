<?php

foreach($specialSK as $sk) {
    $sk_number = $sk;
}

?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Sampler STP</h1>
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
                    <h6 class="text-primary">Assign Sampler STP For <?= $sk_number->name_int; ?></h6>
                    <p class="font-weight-bold">No. <?= $sk_number->sk_sample; ?></p>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_sampler_stp') {
                    foreach ($special_assign as $sa) : ?>
                        <form action="<?= base_url('D_stp/update_sampler_stp_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Sampler</label>
                                <input type="hidden" name="id_assign" value="<?= $sa->id_assign ?>">
                                <input type="hidden" name="id_sk" value="<?= $sa->id_sk ?>">
                                <select name="id_sampler" class="form-control select2 <?php if(form_error('id_sampler')) { echo "is-invalid"; } ?>">
                                <option value="<?= $sa->id_sampler ?>"><?= $sa->name_smp ?></option>
                                    <?php foreach($sampler as $smpl) : ?>
                                        <option value="<?= $smpl->id_sampler ?>"><?= $smpl->name_smp ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_sample', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Sampler STP</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_stp/add_sampler_stp/') . $sk_number->id_sk ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_stp/add_sampler_stp_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Sampler</label>
                                <input type="hidden" name="id_sk" value="<?= $sk_number->id_sk ?>">
                                <select name="id_sampler" class="form-control select2 <?php if(form_error('id_sampler')) { echo "is-invalid"; } ?>">
                                <option value="<?php if( set_value('id_sampler') == NULL) { echo "";}else { echo set_value('id_sampler');}?>"><?php if( set_value('id_sampler') == NULL) { echo "-- Select Sampler --";}else { echo set_value('name_smp');}?></option>
                                    <?php foreach($sampler as $smpl) : ?>
                                        <option value="<?= $smpl->id_sampler ?>"><?= $smpl->name_smp ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('id_sampler', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Sampler STP</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <?php if($assign_sampler == NULL) { ?>
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
                                    <th>Sampler</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($assign_sampler as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= ($row->name_smp); ?></td>
                                        <td>
                                            <?php if($row->gender_smp == 1) {
                                                echo 'Male';
                                            } else {
                                                echo 'Female';
                                            }?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('D_stp/update_sampler_stp/') . $row->id_assign . '/' . $row->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?= base_url('D_stp/delete_sampler_stp/') . $row->id_assign . '/' . $row->id_sk ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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