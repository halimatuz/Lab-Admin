<?php

foreach($specialAnalysis as $sa) {
    $analysis = $sa;
}

?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data COA</h1>
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
                    <h6 class="text-primary">Add COA For <?= $analysis->name_analysis; ?></h6>
                    <hr>
                    <?php 
                    if($this->uri->segment(2) == 'update_coa') {
                    foreach ($specialcoa as $ss) : ?>
                        <form action="<?= base_url('D_superadmin/update_coa_action') ?>" method="POST">
                        <?php foreach($specialcoa as $sc) : ?>
                        <div class="form-group">
                                <label>Parameters</label>
                                <input type="hidden" name="id_coa" value="<?= $sc->id_coa ?>">
                                <input type="hidden" name="id_analysis" value="<?= $analysis->id_analysis ?>">
                                <input type="text" class="form-control <?php if(form_error('params')) { echo "is-invalid"; } ?>" name="params" value="<?= $sc->params ?>" autocomplete="off" placeholder="Insert parameters" autofocus>
                                <?php echo form_error('params', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Category Parameters</label>
                                <select name="category_params" id="" class="form-control <?php if(form_error('category_params')) { echo "is-invalid"; } ?>" value="<?= set_value('category_params')?>">
                                <option value="<?= $sc->category_params ?>"><?= $sc->category_params ?></option>
                                    <option value="Physical">Physical</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Microbiology">Microbiology</option>
                                </select>
                                <?php echo form_error('category_params', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Unit</label>
                                <select name="unit" id="" class="form-control <?php if(form_error('unit')) { echo "is-invalid"; } ?>" value="<?= set_value('unit')?>">
                                <option value="<?= $sc->unit ?>"><?= $sc->unit ?></option>
                                    <option value="°C">°C</option>
                                    <option value="%">%</option>
                                    <option value="mg/L">mg/L</option>
                                    <option value="mg/Nm³">mg/Nm³</option>
                                    <option value="NTU">NTU</option>
                                    <option value="Pt-Co">Pt-Co</option>
                                    <option value="CFU/100ml">CFU/100ml</option>
                                </select>
                                <?php echo form_error('unit', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_1')) { echo "is-invalid"; } ?>" name="reg_standart_1" value="<?= $sc->reg_standart_1 ?>" autocomplete="off" placeholder="Insert regulatory standard 1">
                                <?php echo form_error('reg_standart_1', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard 2</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_2')) { echo "is-invalid"; } ?>" name="reg_standart_2" value="<?= $sc->reg_standart_2 ?>" autocomplete="off" placeholder="Insert regulatory standard 2">
                                <span class="text-small text-primary">Leave blank if none.</span>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard 3</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_3')) { echo "is-invalid"; } ?>" name="reg_standart_3" value="<?= $sc->reg_standart_3 ?>" autocomplete="off" placeholder="Insert regulatory standard 3">
                                <span class="text-small text-primary">Leave blank if none.</span>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard 4</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_4')) { echo "is-invalid"; } ?>" name="reg_standart_4" value="<?= $sc->reg_standart_4 ?>" autocomplete="off" placeholder="Insert regulatory standard 4">
                                <span class="text-small text-primary">Leave blank if none.</span>
                            </div>
                            <div class="form-group">
                                <label>Method</label>
                                <select name="method" class="form-control select2 <?php if(form_error('method')) { echo "is-invalid"; } ?>">
                                <option value="<?= $sc->method ?>"><?= $sc->name_method ?></option>
                                    <?php foreach($methods as $method) : ?>
                                        <option value="<?= $method->id_method ?>"><?= $method->name_method ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('method', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary">Update coa</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_superadmin/add_coa/' . $analysis->id_analysis) ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_superadmin/add_coa_action') ?>" method="POST">
                            <div class="form-group">
                                <label>Parameters</label>
                                <input type="hidden" name="id_analysis" value="<?= $analysis->id_analysis ?>">
                                <input type="text" class="form-control <?php if(form_error('params')) { echo "is-invalid"; } ?>" name="params" value="<?= set_value('params')?>" autocomplete="off" placeholder="Insert parameters" autofocus>
                                <?php echo form_error('params', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Category Parameters</label>
                                <select name="category_params" id="" class="form-control <?php if(form_error('category_params')) { echo "is-invalid"; } ?>" value="<?= set_value('category_params')?>">
                                <option value="<?php if( set_value('category_params') == NULL) { echo "";}else { echo set_value('category_params');}?>"><?php if( set_value('category_params') == NULL) { echo "-- Select Category Parameters --";}else { echo set_value('category_params');}?></option>
                                    <option value="Physical">Physical</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Microbiology">Microbiology</option>
                                </select>
                                <?php echo form_error('category_params', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Unit</label>
                                <select name="unit" id="" class="form-control <?php if(form_error('unit')) { echo "is-invalid"; } ?>" value="<?= set_value('unit')?>">
                                <option value="<?php if( set_value('unit') == NULL) { echo "";}else { echo set_value('unit');}?>"><?php if( set_value('unit') == NULL) { echo "-- Select Unit --";}else { echo set_value('unit');}?></option>
                                    <option value="°C">°C</option>
                                    <option value="%">%</option>
                                    <option value="mg/L">mg/L</option>
                                    <option value="mg/L">mg/m³</option>
                                    <option value="mg/Nm³">mg/Nm³</option>
                                    <option value="NTU">NTU</option>
                                    <option value="Pt-Co">Pt-Co</option>
                                    <option value="CFU/100ml">CFU/100ml</option>
                                </select>
                                <?php echo form_error('unit', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_1')) { echo "is-invalid"; } ?>" name="reg_standart_1" value="<?= set_value('reg_standart_1')?>" autocomplete="off" placeholder="Insert regulatory standard 1">
                                <?php echo form_error('reg_standart_1', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard 2</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_2')) { echo "is-invalid"; } ?>" name="reg_standart_2" value="<?= set_value('reg_standart_2')?>" autocomplete="off" placeholder="Insert regulatory standard 2">
                                <span class="text-small text-primary">Leave blank if none.</span>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard 3</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_3')) { echo "is-invalid"; } ?>" name="reg_standart_3" value="<?= set_value('reg_standart_3')?>" autocomplete="off" placeholder="Insert regulatory standard 3">
                                <span class="text-small text-primary">Leave blank if none.</span>
                            </div>
                            <div class="form-group">
                                <label>Regulatory Standard 4</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_4')) { echo "is-invalid"; } ?>" name="reg_standart_4" value="<?= set_value('reg_standart_4')?>" autocomplete="off" placeholder="Insert regulatory standard 4">
                                <span class="text-small text-primary">Leave blank if none.</span>
                            </div>
                            <div class="form-group">
                                <label>Method</label>
                                <select name="method" class="form-control select2 <?php if(form_error('method')) { echo "is-invalid"; } ?>">
                                <option value="<?php if( set_value('method') == NULL) { echo "";}else { echo set_value('method');}?>"><?php if( set_value('method') == NULL) { echo "-- Select Method --";}else { echo set_value('method');}?></option>
                                    <?php foreach($methods as $method) : ?>
                                        <option value="<?= $method->id_method ?>"><?= $method->name_method ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('method', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Add COA</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <?php if($coa == NULL) { ?>
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
                                    <th>Parameters</th>
                                    <th>Unit</th>
                                    <th>Regulatory Standard</th>
                                    <th>Regulatory Standard 2</th>
                                    <th>Regulatory Standard 3</th>
                                    <th>Regulatory Standard 4</th>
                                    <th>Methods</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($coa as $row) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->params); ?></td>
                                        <td><?= htmlspecialchars($row->unit); ?></td>
                                        <td><?= htmlspecialchars($row->reg_standart_1); ?></td>
                                        <td><?= htmlspecialchars($row->reg_standart_2); ?></td>
                                        <td><?= htmlspecialchars($row->reg_standart_3); ?></td>
                                        <td><?= htmlspecialchars($row->reg_standart_4); ?></td>
                                        <td><?= htmlspecialchars($row->name_method); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_superadmin/update_coa/') . $row->id_coa  . '/' . $row->id_analysis?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_superadmin/delete_coa/') . $row->id_coa . '/' . $row->id_analysis?>"class="btn btn-danger tombol-hapus" type="submit"><i class="fas fa-trash"></i></a>
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