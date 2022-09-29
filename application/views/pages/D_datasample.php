<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Sample</h1>
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
                    <h6 class="text-primary">Add Sample</h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_sample') {
                    foreach ($specialSample as $ss) : ?>
                        <form action="<?= base_url('D_sample/update_sample_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Sample</label>
                                <input type="hidden" class="form-control" name="id_sample" value="<?= $ss->id_sample ?>">
                                <input type="text" class="form-control" name="name_sample" value="<?= $ss->name_sample ?>" autocomplete="off" placeholder="Insert name sample..." autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Sample</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_sample') ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_sample/add_sample') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Sample</label>
                                <input type="text" class="form-control <?php if(form_error('name_sample')) { echo "is-invalid"; } ?>" name="name_sample" value="<?= set_value('name_sample')?>" autocomplete="off" placeholder="Insert name sample..." autofocus>
                                <?php echo form_error('name_sample', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Sample</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                      <?php if($sample == NULL) { ?>
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
                                <th>asfasdf</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($sample as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->name_sample); ?></td>
                                        <td>sgffdg</td>
                                        <td>
                                            <a href="<?php echo base_url('D_sample/update_sample/') . $row->id_sample ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_sample/delete_sample/') . $row->id_sample ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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