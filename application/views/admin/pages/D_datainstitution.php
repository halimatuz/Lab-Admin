<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Institution</h1>
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
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('int'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <h6 class="text-primary">Add Institution</h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_int') {
                    foreach ($specialInt as $si) : ?>
                        <form action="<?= base_url('D_admin/update_int_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Institution</label>
                                <input type="hidden" class="form-control" name="id_int" value="<?= $si->id_int ?>">
                                <input type="text" class="form-control" name="name_int" value="<?= $si->name_int ?>" autocomplete="off" aria-placeholder="Insert name institution...">
                                <?php echo form_error('name_int', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Phone Institution</label>
                                <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    +62
                                    </div>
                                </div>
                                <input type="number" class="form-control <?php if(form_error('int_phone')) { echo "is-invalid"; } ?>" name="int_phone" value="<?= $si->int_phone ?>" autocomplete="off" placeholder="81345637463">
                                </div>
                                <?php echo form_error('int_phone', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Email Institution</label>
                                <input type="email" class="form-control" name="int_email" value="<?= $si->int_email ?>" autocomplete="off" placeholder="Insert email institution...">
                                <?php echo form_error('int_email', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Address Institution</label>
                                <textarea type="text" class="form-control" name="int_address" autocomplete="off" placeholder="Insert address institution..."><?= $si->int_address ?></textarea>
                                <?php echo form_error('int_address', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <p>Contact Person</p>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name_cp" value="<?= $si->name_cp ?>" autocomplete="off" aria-placeholder="Insert name contact person">
                                <?php echo form_error('name_cp', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title_cp" value="<?= $si->title_cp ?>" autocomplete="off" aria-placeholder="Insert name contact person">
                                <?php echo form_error('title_cp', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Intitution</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_admin/data_int') ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_admin/add_int') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Institution</label>
                                <input type="text" class="form-control <?php if(form_error('name_int')) { echo "is-invalid"; } ?>" name="name_int" value="<?= set_value('name_int')?>" autocomplete="off" placeholder="Insert name institution...">
                                <?php echo form_error('name_int', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                           
                            <div class="form-group">
                                <label>Phone Institution</label>
                                <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        +62
                                    </div>
                                </div>
                                <input type="number" class="form-control <?php if(form_error('int_phone')) { echo "is-invalid"; } ?>" name="int_phone" value="<?= set_value('int_phone')?>" autocomplete="off" placeholder="81345637463">
                                </div>
                                <?php echo form_error('int_phone', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Email Institution</label>
                                <input type="email" class="form-control <?php if(form_error('int_email')) { echo "is-invalid"; } ?>" name="int_email" value="<?= set_value('int_email')?>" autocomplete="off" placeholder="Insert email institution...">
                                <?php echo form_error('int_email', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Address Institution</label>
                                <textarea class="form-control <?php if(form_error('int_address')) { echo "is-invalid"; } ?>" name="int_address" autocomplete="off" placeholder="Insert address institution..."><?= set_value('int_address')?></textarea>
                                <?php echo form_error('int_address', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <p>Contact Person</p>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control <?php if(form_error('name_cp')) { echo "is-invalid"; } ?>" name="name_cp" value="<?= set_value('name_cp')?>" autocomplete="off" placeholder="Insert name contact person">
                                <?php echo form_error('name_cp', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control <?php if(form_error('title_cp')) { echo "is-invalid"; } ?>" name="title_cp" value="<?= set_value('title_cp')?>" autocomplete="off" placeholder="Insert position contact person">
                                <?php echo form_error('title_cp', '<div class="text-small text-danger">', '</div>') ?>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Institution</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <?php if($institution == NULL) { ?>
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
                                <th>Name Institution</th>
                                <th>Phone Institution</th>
                                <th>Email Institution</th>
                                <th>Address Institution</th>
                                <th>Name CP</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($institution as $int) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($int->name_int); ?></td>
                                        <td><?= htmlspecialchars($int->int_phone); ?></td>
                                        <td><?= htmlspecialchars($int->int_email); ?></td>
                                        <td><?= htmlspecialchars($int->int_address); ?></td>
                                        <td><?= htmlspecialchars($int->name_cp); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_admin/update_int/') . $int->id_int ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_admin/delete_int/') . $int->id_int ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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