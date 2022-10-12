<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Method</h1>
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
                    <h6 class="text-primary">Add Method</h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_method') {
                    foreach ($specialmethod as $ss) : ?>
                        <form action="<?= base_url('D_admin/update_method_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Name method</label>
                                <input type="hidden" class="form-control" name="id_method" value="<?= $ss->id_method ?>">
                                <input type="text" class="form-control" name="name_method" value="<?= $ss->name_method ?>" autocomplete="off" placeholder="Insert name method..." autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary">Update method</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_admin/data_method') ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_admin/add_method') ?>" method="POST">
                            <div class="form-group">
                                <label>Name method</label>
                                <input type="text" class="form-control <?php if(form_error('name_method')) { echo "is-invalid"; } ?>" name="name_method" value="<?= set_value('name_method')?>" autocomplete="off" placeholder="Insert name method..." autofocus>
                                <?php echo form_error('name_method', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add method</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                      <?php if($method == NULL) { ?>
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
                                <th>Name</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($method as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->name_method); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_admin/update_method/') . $row->id_method ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_admin/delete_method/') . $row->id_method ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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