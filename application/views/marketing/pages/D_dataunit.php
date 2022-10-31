<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Unit</h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <h6 class="text-primary">Add Unit</h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_unit') {
                    foreach ($specialunit as $ss) : ?>
                        <form action="<?= base_url('D_marketing/update_unit_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Name unit</label>
                                <input type="hidden" class="form-control" name="id_unit" value="<?= $ss->id_unit ?>">
                                <input type="text" class="form-control" name="name_unit" value="<?= $ss->name_unit ?>" autocomplete="off" placeholder="Insert name unit..." autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Unit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_marketing/data_unit') ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_marketing/add_unit') ?>" method="POST">
                            <div class="form-group">
                                <label>Name unit</label>
                                <input type="text" class="form-control <?php if(form_error('name_unit')) { echo "is-invalid"; } ?>" name="name_unit" value="<?= set_value('name_unit')?>" autocomplete="off" placeholder="Insert name unit..." autofocus>
                                <?php echo form_error('name_unit', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Unit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                      <?php if($unit == NULL) { ?>
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
                                foreach ($unit as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->name_unit); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_marketing/update_unit/') . $row->id_unit ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_marketing/delete_unit/') . $row->id_unit ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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