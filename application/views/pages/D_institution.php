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
                    <h6>Add Institution</h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_int') {
                    foreach ($specialInt as $si) : ?>
                        <form action="<?= base_url('D_institution/update_int_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Institution</label>
                                <input type="hidden" class="form-control" name="id_int" value="<?= $si->id_int ?>">
                                <input type="text" class="form-control" name="name_int" value="<?= $si->name_int ?>">
                            </div>
                          
                            <div class="form-group">
                                <label>Phone Institution</label>
                                <input type="number" class="form-control" name="int_phone" value="<?= $si->int_phone ?>">
                            </div>
                            <div class="form-group">
                                <label>Email Institution</label>
                                <input type="email" class="form-control" name="int_email" value="<?= $si->int_email ?>">
                            </div>
                            <div class="form-group">
                                <label>Adress Institution</label>
                                <input type="text" class="form-control" name="int_adress" value="<?= $si->int_adress ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Intitution</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_institution') ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_institution/add_int') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Institution</label>
                                <input type="text" class="form-control" name="name_int" autocomplete="off">
                                <?php echo form_error('name_int', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                           
                            <div class="form-group">
                                <label>Phone Institution</label>
                                <input type="number" class="form-control" name="int_phone" autocomplete="off">
                                <?php echo form_error('int_phone', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Email Institution</label>
                                <input type="email" class="form-control" name="int_email" autocomplete="off">
                                <?php echo form_error('int_email', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Adress Institution</label>
                                <input type="text" class="form-control" name="int_adress" autocomplete="off">
                                <?php echo form_error('int_adress', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Institution</button>
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
                                <th>Name Institution</th>
                                <th>Phone Institution</th>
                                <th>Email Institution</th>
                                <th>Adress Institution</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($institution as $int) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $int->name_int; ?></td>
                                        <td><?= $int->int_phone; ?></td>
                                        <td><?= $int->int_email; ?></td>
                                        <td><?= $int->int_adress; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_institution/update_int/') . $int->id_int ?>"class="btn btn-primary mb-3"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_institution/delete_int/') . $int->id_int ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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