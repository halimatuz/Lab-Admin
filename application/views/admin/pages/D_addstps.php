<?php

foreach($specialSK as $sk) {
    $sk_number = $sk;
}

?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data STPS</h1>
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
                    <h6 class="text-primary">Add STPS For <?= $sk_number->name_int; ?></h6>
                    <p class="font-weight-bold">No. <?= $sk_number->sk_sample; ?></p>
                    <hr>
                        <form action="<?= base_url('D_admin/add_stps_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Sample</label>
                                <input type="hidden" name="id_sk" value="<?= $sk_number->id_sk ?>">
                                <select name="sample_desc[]" class="form-control selectric <?php if(form_error('sample_desc')) { echo "is-invalid"; } ?>" multiple="">
                                  <option value="">-- Select Sample --</option>
                                    <?php foreach($sample as $smpl) : ?>
                                        <option value="<?= $smpl->name_sample ?>"><?= $smpl->name_sample ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('sample_desc[]', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Location</label>
                                <textarea class="summernote-simple" name="location"><?= set_value('location') ?></textarea>
                                <?php echo form_error('location', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add STPS</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <a href="<?= base_url('D_admin/print_stps/') . $sk_number->id_sk ?>" class="btn btn-primary" target="_blank">Print</a>
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
                                    <th>Sample Description</th>
                                    <th>Location</th>
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
                                        <td><?= ($row->location); ?></td>
                                        <td>
                                            <a href="<?= base_url('D_admin/delete_stps/') . $row->id_sampling . '/' . $row->id_sk ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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