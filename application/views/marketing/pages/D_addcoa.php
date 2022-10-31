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
                        <form action="<?= base_url('D_marketing/update_coa_action') ?>" method="POST">
                        <?php foreach($specialcoa as $sc) : ?>
                            <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Noise' && $analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Illumination' && $analysis->name_analysis != 'Non-Stationary Source Emission' && $analysis->name_analysis != '24 HOURS NOISE') { ?>
                            <div class="form-group">
                                <label>Parameters</label>
                                <input type="text" class="form-control <?php if(form_error('params')) { echo "is-invalid"; } ?>" name="params" value="<?= $sc->params ?>" autocomplete="off" placeholder="Insert parameters" autofocus>
                                <?php echo form_error('params', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == '24 HOURS NOISE') { ?>
                            <div class="form-group">
                                <label>Sampling Location</label>
                                <input type="text" class="form-control <?php if(form_error('sampling_location')) { echo "is-invalid"; } ?>" name="sampling_location" value="<?= $sc->sampling_location ?>" autocomplete="off" placeholder="Insert sampling location" autofocus>
                                <?php echo form_error('sampling_location', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Noise</label>
                                <input type="text" class="form-control <?php if(form_error('noise')) { echo "is-invalid"; } ?>" name="noise" value="<?= $sc->noise ?>" autocomplete="off" placeholder="Insert noise" autofocus>
                                <?php echo form_error('noise', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Time</label>
                                <input type="text" class="form-control <?php if(form_error('time')) { echo "is-invalid"; } ?>" name="time" value="<?= $sc->time ?>" autocomplete="off" placeholder="Insert time" autofocus>
                                <?php echo form_error('time', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Surface Water' || $analysis->name_analysis == 'Wastewater' || $analysis->name_analysis == 'Clean Water' ) { ?>
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
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Ambient Air') { ?>
                            <div class="form-group">
                                <label>Sampling Time</label>
                                <select name="sampling_time" id="" class="form-control <?php if(form_error('sampling_time')) { echo "is-invalid"; } ?>" value="<?= set_value('sampling_time')?>">
                                <option value="<?= $sc->sampling_time ?>"><?= $sc->sampling_time ?></option>
                                    <option value="1 Hours">1 Hours</option>
                                    <option value="3 Hours">3 Hours</option>
                                    <option value="24 Hours">24 Hours</option>
                                    <option value="1 Year">1 Year</option>
                                </select>
                                <?php echo form_error('sampling_time', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Non-Stationary Source Emission') { ?>
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" class="form-control <?php if(form_error('year')) { echo "is-invalid"; } ?>" name="year" value="<?= $sc->year ?>" autocomplete="off" placeholder="Insert year">
                                <?php echo form_error('year', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="text" class="form-control <?php if(form_error('capacity')) { echo "is-invalid"; } ?>" name="capacity" value="<?= $sc->capacity ?>" autocomplete="off" placeholder="Insert capacity">
                                <?php echo form_error('capacity', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Non-Stationary Source Emission')  {?>
                            <div class="form-group">
                                <label>Unit</label>
                                <select name="unit" id="" class="form-control <?php if(form_error('unit')) { echo "is-invalid"; } ?>" value="<?= set_value('unit')?>">
                                <option value="<?= $sc->unit ?>"><?= $sc->unit ?></option>
                                    <?php foreach($unit as $unt) : ?>
                                        <option value="<?= $unt->name_unit ?>"><?= $unt->name_unit ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('unit', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Heat Stress') { ?>
                            <div class="form-group">
                                <label>Regulatory Standard</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_1')) { echo "is-invalid"; } ?>" name="reg_standart_1" value="<?= $sc->reg_standart_1 ?>" autocomplete="off" placeholder="Insert regulatory standard 1">
                                <?php echo form_error('reg_standart_1', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Surface Water') { ?>
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
                            <?php } ?>
                            <div class="form-group">
                                <label>Method</label>
                                <select name="method" class="form-control select2 <?php if(form_error('method')) { echo "is-invalid"; } ?>">
                                <option value="<?= $sc->method ?>"><?= $sc->name_method ?></option>
                                    <?php foreach($methods as $method) : ?>
                                        <option value="<?= $method->id_method ?>"><?= $method->name_method ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="id_coa" value="<?= $sc->id_coa ?>">
                                <input type="hidden" name="id_analysis" value="<?= $analysis->id_analysis ?>">
                                <?php echo form_error('method', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary">Update COA</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="<?php echo base_url('D_marketing/add_coa/' . $analysis->id_analysis) ?>" class="btn btn-danger">Cancel</a>
                        </form>
                    <?php endforeach; } else {?>
                        <form action="<?= base_url('D_marketing/add_coa_action') ?>" method="POST">
                            <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Noise' && $analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Illumination' && $analysis->name_analysis != 'Non-Stationary Source Emission' && $analysis->name_analysis != '24 HOURS NOISE') { ?>
                            <div class="form-group">
                                <label>Parameters</label>
                                <input type="text" class="form-control <?php if(form_error('params')) { echo "is-invalid"; } ?>" name="params" value="<?= set_value('params')?>" autocomplete="off" placeholder="Insert parameters" autofocus>
                                <?php echo form_error('params', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == '24 HOURS NOISE') { ?>
                            <div class="form-group">
                                <label>Sampling Location</label>
                                <input type="text" class="form-control <?php if(form_error('sampling_location')) { echo "is-invalid"; } ?>" name="sampling_location" value="<?= set_value('sampling_location')?>" autocomplete="off" placeholder="Insert sampling location" autofocus>
                                <?php echo form_error('sampling_location', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Noise</label>
                                <input type="text" class="form-control <?php if(form_error('noise')) { echo "is-invalid"; } ?>" name="noise" value="<?= set_value('noise')?>" autocomplete="off" placeholder="Insert noise" autofocus>
                                <?php echo form_error('noise', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Time</label>
                                <input type="text" class="form-control <?php if(form_error('time')) { echo "is-invalid"; } ?>" name="time" value="<?= set_value('time')?>" autocomplete="off" placeholder="Insert time" autofocus>
                                <?php echo form_error('time', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Non-Stationary Source Emission') { ?>
                            <div class="form-group">
                                <label>Year</label>
                                <input type="text" class="form-control <?php if(form_error('year')) { echo "is-invalid"; } ?>" name="year" value="<?= set_value('year')?>" autocomplete="off" placeholder="Insert year">
                                <?php echo form_error('year', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group">
                                <label>Capacity</label>
                                <input type="text" class="form-control <?php if(form_error('capacity')) { echo "is-invalid"; } ?>" name="capacity" value="<?= set_value('capacity')?>" autocomplete="off" placeholder="Insert capacity">
                                <?php echo form_error('capacity', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Surface Water' || $analysis->name_analysis == 'Wastewater' || $analysis->name_analysis == 'Clean Water' ) { ?>
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
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Ambient Air') { ?>
                            <div class="form-group">
                                <label>Sampling Time</label>
                                <select name="sampling_time" id="" class="form-control <?php if(form_error('sampling_time')) { echo "is-invalid"; } ?>" value="<?= set_value('sampling_time')?>">
                                <option value="<?php if( set_value('sampling_time') == NULL) { echo "";}else { echo set_value('sampling_time');}?>"><?php if( set_value('sampling_time') == NULL) { echo "-- Select Sampling Time --";}else { echo set_value('sampling_time');}?></option>
                                    <option value="1 Hours">1 Hours</option>
                                    <option value="3 Hours">3 Hours</option>
                                    <option value="24 Hours">24 Hours</option>
                                    <option value="1 Year">1 Year</option>
                                </select>
                                <?php echo form_error('sampling_time', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Non-Stationary Source Emission') { ?>
                            <div class="form-group">
                                <label>Unit</label>
                                <select name="unit" id="" class="form-control <?php if(form_error('unit')) { echo "is-invalid"; } ?>" value="<?= set_value('unit')?>">
                                <option value="<?php if( set_value('unit') == NULL) { echo "";}else { echo set_value('unit');}?>"><?php if( set_value('unit') == NULL) { echo "-- Select Unit --";}else { echo set_value('unit');}?></option>
                                    <?php foreach($unit as $unt) : ?>
                                        <option value="<?= $unt->name_unit ?>"><?= $unt->name_unit ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('unit', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Heat Stress') { ?>
                            <div class="form-group">
                                <label>Regulatory Standard</label>
                                <input type="text" class="form-control <?php if(form_error('reg_standart_1')) { echo "is-invalid"; } ?>" name="reg_standart_1" value="<?= set_value('reg_standart_1')?>" autocomplete="off" placeholder="Insert regulatory standard">
                                <?php echo form_error('reg_standart_1', '<span class="text-small text-danger">', '</span>') ?>
                            </div>
                            <?php } ?>
                            <?php if($analysis->name_analysis == 'Surface Water') { ?>
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
                            <?php } ?>
                            <div class="form-group">
                                <label>Method</label>
                                <select name="method" class="form-control select2 <?php if(form_error('method')) { echo "is-invalid"; } ?>">
                                <option value="<?php if( set_value('method') == NULL) { echo "";}else { echo set_value('method');}?>"><?php if( set_value('method') == NULL) { echo "-- Select Method --";}else { echo set_value('method');}?></option>
                                    <?php foreach($methods as $method) : ?>
                                        <option value="<?= $method->id_method ?>"><?= $method->name_method ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="id_analysis" value="<?= $analysis->id_analysis ?>">
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
                                    <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Noise' && $analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Illumination' && $analysis->name_analysis != 'Non-Stationary Source Emission' && $analysis->name_analysis != '24 HOURS NOISE') { ?>
                                    <th>Parameters</th>
                                    <?php } ?>
                                    <?php if($analysis->name_analysis == '24 HOURS NOISE') { ?>
                                    <th>Sampling Location</th>
                                    <th>Noise</th>
                                    <th>Time</th>
                                    <?php } ?>
                                    <?php if($analysis->name_analysis == 'Ambient Air') { ?>
                                    <th>Sampling Time</th>
                                    <?php } ?>
                                    <?php if($analysis->name_analysis == 'Non-Stationary Source Emission') { ?>
                                    <th>Year</th>
                                    <th>Capacity</th>
                                    <?php } ?>
                                    <?php if($analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Non-Stationary Source Emission') { ?>
                                    <th>Unit</th>
                                    <?php } ?>
                                    <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Heat Stress') { ?>
                                    <th>Regulatory Standard</th>
                                    <?php } ?>
                                    <?php if($analysis->name_analysis == 'Surface Water') { ?>
                                    <th>Regulatory Standard 2</th>
                                    <th>Regulatory Standard 3</th>
                                    <th>Regulatory Standard 4</th>
                                    <?php } ?>
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
                                        <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Noise' && $analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Illumination' && $analysis->name_analysis != 'Non-Stationary Source Emission' && $analysis->name_analysis != '24 HOURS NOISE') { ?>
                                        <td><?= htmlspecialchars($row->params); ?></td>
                                        <?php } ?>
                                        <?php if($analysis->name_analysis == '24 HOURS NOISE') { ?>
                                        <td><?= htmlspecialchars($row->sampling_location); ?></td>
                                        <td><?= htmlspecialchars($row->noise); ?></td>
                                        <td><?= htmlspecialchars($row->time); ?></td>
                                        <?php } ?>
                                        <?php if($analysis->name_analysis == 'Ambient Air') { ?>
                                        <td><?= htmlspecialchars($row->sampling_time); ?></td>
                                        <?php } ?>
                                        <?php if($analysis->name_analysis == 'Non-Stationary Source Emission') { ?>
                                        <td><?= htmlspecialchars($row->year); ?></td>
                                        <td><?= htmlspecialchars($row->capacity); ?></td>
                                        <?php } ?>
                                        <?php if($analysis->name_analysis != 'Heat Stress' && $analysis->name_analysis != 'Non-Stationary Source Emission') { ?>
                                        <td><?= htmlspecialchars($row->unit); ?></td>
                                        <?php } ?>
                                        <?php if($analysis->name_analysis != 'Vibration' && $analysis->name_analysis != 'Heat Stress') { ?>
                                        <td><?= htmlspecialchars($row->reg_standart_1); ?></td>
                                        <?php } ?>
                                        <?php if($analysis->name_analysis == 'Surface Water') { ?>
                                        <td><?= htmlspecialchars($row->reg_standart_2); ?></td>
                                        <td><?= htmlspecialchars($row->reg_standart_3); ?></td>
                                        <td><?= htmlspecialchars($row->reg_standart_4); ?></td>
                                        <?php } ?>
                                        <td><?= htmlspecialchars($row->name_method); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_marketing/update_coa/') . $row->id_coa  . '/' . $row->id_analysis?>"class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo base_url('D_marketing/delete_coa/') . $row->id_coa . '/' . $row->id_analysis?>"class="btn btn-danger tombol-hapus" type="submit"><i class="fas fa-trash"></i></a>
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