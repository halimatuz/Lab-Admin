<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data Analysis</h1>
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
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('anl'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                    <h6>Add Analysis</h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_analysis') {
                    foreach ($specialAnalysis as $sa) : ?>
                        <form action="<?= base_url('D_analysis/update_analysis_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Analysis</label>
                                <input type="hidden" class="form-control" name="id_analysis" value="<?= $sa->id_analysis ?>">
                                <input type="text" class="form-control" name="name_analysis" value="<?= $sa->name_analysis ?>" autocomplete="off">
                            </div>
                          
                            <div class="form-group">
                                <label>Standart Price</label>
                                <input type="number" class="form-control" name="standart_price" value="<?= $sa->standart_price ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label>Email Institution</label>
                                <select name="coa" id="" class="form-control">
                                    <option value="1"><?php if($sa->coa == 1) {echo 'Yes';}else {echo 'No';} ?></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Analysis</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_analysis') ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_analysis/add_analysis') ?>" method="POST">
                            <div class="form-group">
                                <label>Name Analysis</label>
                                <input type="text" class="form-control <?php if(form_error('name_analysis')) { echo "is-invalid"; } ?>" name="name_analysis" value="<?= set_value('name_analysis')?>" autocomplete="off">
                                <?php echo form_error('name_analysis', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                           
                            <div class="form-group">
                                <label>Standart Price</label>
                                <input type="number" class="form-control <?php if(form_error('standart_price')) { echo "is-invalid"; } ?>" name="standart_price" value="<?= set_value('standart_price')?>" autocomplete="off">
                                <?php echo form_error('standart_price', '<div class="text-small text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label>Email Institution</label>
                                <select name="coa" id="" class="form-control <?php if(form_error('coa')) { echo "is-invalid"; } ?>">
                                    <option value=""><?php if( set_value('coa') == NULL) { echo "-- Select COA --";}else {if(set_value('coa') == 1){echo 'Yes';}else{echo 'No';}}?></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <?php echo form_error('coa', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Analysis</button>
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
                                <th>Name Analysis</th>
                                <th>Standart Price</th>
                                <th>COA</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($analysis as $anl) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($anl->name_analysis); ?></td>
                                        <td><?= htmlspecialchars($anl->standart_price); ?></td>
                                        <td>
                                        <?php if($anl->coa == 1) {
                                                echo 'Yes';
                                            } else {
                                                echo 'No';
                                            }?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('D_analysis/update_analysis/') . $anl->id_analysis ?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_analysis/delete_analysis/') . $anl->id_analysis ?>"class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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