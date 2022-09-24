<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Sampler</h1>
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
                    <h6 class="text-primary">Add Sampler</h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_sampler') {
                    foreach ($specialSampler as $ss) : ?>
                        <form action="<?= base_url('D_sampler/update_sampler_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Sampler</label>
                                <input type="hidden" class="form-control" name="id_sampler" value="<?= $ss->id_sampler ?>">
                                <input type="text" class="form-control" name="name_smp" value="<?= $ss->name_smp ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Gender Sampler</label>
                                <select name="gender_smp" id="" class="form-control">
                                    <option value="1"><?php if($ss->gender_smp == 1) {echo 'Male';}else {echo 'Female';} ?></option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phone Sampler</label>
                                <input type="number" class="form-control" name="phone_smp" value="<?= $ss->phone_smp ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Email Sampler</label>
                                <input type="email" class="form-control" name="email_smp" value="<?= $ss->email_smp ?>" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Sampler</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_sampler') ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_sampler/add_sampler') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Sampler</label>
                                <input type="text" class="form-control <?php if(form_error('name_smp')) { echo "is-invalid"; } ?>" name="name_smp" value="<?= set_value('name_smp')?>" autocomplete="off">
                                <?php echo form_error('name_smp', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Gender Sampler</label>
                                <select name="gender_smp" id="" class="form-control <?php if(form_error('gender_smp')) { echo "is-invalid"; } ?>">
                                    <option value=""><?php if( set_value('gender_smp') == NULL) { echo "-- Select Gender --";}else {if(set_value('gender_smp') == 1){echo 'Male';}else{echo 'Female';}}?></option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                                <?php echo form_error('gender_smp', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Phone Sampler</label>
                                <input type="number" class="form-control <?php if(form_error('phone_smp')) { echo "is-invalid"; } ?>" name="phone_smp" value="<?= set_value('phone_smp')?>" autocomplete="off">
                                <?php echo form_error('phone_smp', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Email Sampler</label>
                                <input type="email" class="form-control <?php if(form_error('email_smp')) { echo "is-invalid"; } ?>" name="email_smp" value="<?= set_value('email_smp')?>" autocomplete="off">
                                <?php echo form_error('email_smp', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Sampler</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($sampler as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->name_smp); ?></td>
                                        <td>
                                            <?php if($row->gender_smp == 1) {
                                                echo 'Male';
                                            } else {
                                                echo 'Female';
                                            }?>
                                        </td>
                                        <td><?= htmlspecialchars($row->phone_smp); ?></td>
                                        <td><?= htmlspecialchars($row->email_smp); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_sampler/update_sampler/') . $row->id_sampler ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_sampler/delete_sampler/') . $row->id_sampler ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>