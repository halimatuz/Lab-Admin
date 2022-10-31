<?php

foreach($coa as $c) {
    $coa_spec = $c;
}



?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Input Result COA</h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    <h6 class="text-primary">Input Result in <?= @$coa_spec->name_analysis ?> For <?= @$coa_spec->name_int ?></h6>
                    <hr>
                      <?php if($coa == NULL) { ?>
                            <div class="empty-state" data-height="400">
                                <div class="empty-state-icon">
                                <i class="fas fa-question"></i>
                                </div>
                                <h2>This analysis does not have a COA.</h2>
                                <p class="lead">
                                Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                                </p>
                            </div>
                        <?php } else { ?>
                          <form action="<?= base_url('D_analyst/save_result') ?>" method="post">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <thead>
                                    <tr class="<?php if($coa_spec->name_analysis == 'Non-Stationary Source Emission') { echo 'text-center'; } ?>">
                                    <th rowspan="<?php if($coa_spec->name_analysis == 'Heat Stress') {echo '2';} ?>">No</th>
                                    <?php if($coa_spec->name_analysis == '24 HOURS NOISE') { ?>
                                    <th>Sampling Location</th>
                                    <th>Noise</th>
                                    <th>Time</th>
                                    <th>Leq</th>
                                    <th>Ls</th>
                                    <th>Lm</th>
                                    <th>Lsm</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis != 'Vibration' && $coa_spec->name_analysis != 'Noise' && $coa_spec->name_analysis != 'Heat Stress' && $coa_spec->name_analysis != 'Illumination' && $coa_spec->name_analysis != 'Non-Stationary Source Emission' && $coa_spec->name_analysis != '24 HOURS NOISE') { ?>
                                    <th>Parameters</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis == 'Heat Stress' || $coa_spec->name_analysis == 'Illumination' || $coa_spec->name_analysis == 'Noise') { ?>
                                    <th rowspan="<?php if($coa_spec->name_analysis == 'Heat Stress') {echo '2';} ?>">Sampling Location</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis == 'Vibration' || $coa_spec->name_analysis == 'Non-Stationary Source Emission') { ?>
                                    <th>Vehicle Brand</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis == 'Non-Stationary Source Emission') { ?>
                                    <th>Year</th>
                                    <th>Capacity</th>
                                    <th>Code</th>
                                    <th>Opacity (%)</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis == 'Vibration' || $coa_spec->name_analysis == 'Noise' || $coa_spec->name_analysis == 'Heat Stress' || $coa_spec->name_analysis == 'Illumination') { ?>
                                    <th rowspan="<?php if($coa_spec->name_analysis == 'Heat Stress') {echo '2';} ?>">Time</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis != 'Heat Stress' && $coa_spec->name_analysis != 'Non-Stationary Source Emission' && $coa_spec->name_analysis != '24 HOURS NOISE') { ?>
                                    <th>Unit</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis == 'Heat Stress') { ?>
                                    <th rowspan="<?php if($coa_spec->name_analysis == 'Heat Stress') {echo '2';} ?>">Humidity (%)</th>
                                    <th colspan="3">Temperature(°C)</th>
                                    <th rowspan="<?php if($coa_spec->name_analysis == 'Heat Stress') {echo '2';} ?>">WBGT INDEX</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis == 'Ambient Air') { ?>
                                    <th>Sampling Time</th>
                                    <?php } ?>
                                    <?php if($coa_spec->name_analysis != 'Heat Stress' && $coa_spec->name_analysis != 'Non-Stationary Source Emission' && $coa_spec->name_analysis != '24 HOURS NOISE') { ?>
                                    <th>Testing Result</th>
                                    <?php } ?>
                                    <th rowspan="<?php if($coa_spec->name_analysis == 'Heat Stress') {echo '2';} ?>">Method</th>
                                    </tr>
                                    <?php if($coa_spec->name_analysis == 'Heat Stress') { ?>
                                    <tr class="text-center">
                                      <th>Wet</th>
                                      <th>Dew</th>
                                      <th>Globe</th>
                                    </tr>
                                    <?php } ?>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($coa as $row) :?>
                                    
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <?php if($coa_spec->name_analysis == '24 HOURS NOISE') { ?>
                                              <td><?= $row->sampling_location ?></td>
                                            <td><?= htmlspecialchars($row->noise); ?></td>
                                            <td><?= htmlspecialchars($row->time); ?></td>
                                            <td><input type="text" name="leq[]" value="<?= $row->leq ?>" class="form-control"></td>
                                            <td><input type="text" name="ls[]" value="<?= $row->ls ?>" class="form-control"></td>
                                            <td><input type="text" name="lm[]" value="<?= $row->lm ?>" class="form-control"></td>
                                            <td><input type="text" name="lsm[]" value="<?= $row->lsm ?>" class="form-control"></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis != 'Vibration' && $coa_spec->name_analysis != 'Noise' && $coa_spec->name_analysis != 'Heat Stress' && $coa_spec->name_analysis != 'Illumination' && $coa_spec->name_analysis != 'Non-Stationary Source Emission' && $coa_spec->name_analysis != '24 HOURS NOISE') { ?>
                                            <td><?= htmlspecialchars($row->params); ?></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis == 'Heat Stress' || $coa_spec->name_analysis == 'Illumination' || $coa_spec->name_analysis == 'Noise') { ?>
                                            <td><input type="text" name="sampling_location[]" value="<?= $row->sampling_location_coa ?>" class="form-control"></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis == 'Vibration' || $coa_spec->name_analysis == 'Non-Stationary Source Emission') { ?>
                                            <td><input type="text" name="vehicle_brand[]" value="<?= $row->vehicle_brand ?>" class="form-control"></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis == 'Non-Stationary Source Emission') { ?>
                                            <td><?= $row->year ?></td>
                                            <td><?= $row->capacity ?></td>
                                            <td><input type="text" name="code[]" value="<?= $row->code ?>" class="form-control"></td>
                                            <td><input type="text" name="opacity[]" value="<?= $row->opacity ?>" class="form-control"></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis == 'Vibration' || $coa_spec->name_analysis == 'Noise' || $coa_spec->name_analysis == 'Heat Stress' || $coa_spec->name_analysis == 'Illumination') { ?>
                                            <td><input type="text" name="time[]" value="<?= $row->time_coa ?>" class="form-control"></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis == 'Heat Stress') { ?>
                                            <td><input type="text" name="humidity[]" value="<?= $row->humidity ?>" class="form-control"></td>
                                            <td><input type="text" name="wet[]" value="<?= $row->wet ?>" class="form-control"></td>
                                            <td><input type="text" name="dew[]" value="<?= $row->dew ?>" class="form-control"></td>
                                            <td><input type="text" name="globe[]" value="<?= $row->globe ?>" class="form-control"></td>
                                            <td><input type="text" name="wbgt_index[]" value="<?= $row->wbgt_index ?>" class="form-control"></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis != 'Heat Stress' && $coa_spec->name_analysis != 'Non-Stationary Source Emission' && $coa_spec->name_analysis != "24 HOURS NOISE") { ?>
                                            <td><?= htmlspecialchars($row->unit); ?></td>
                                            <?php } ?>
                                            <?php if($coa_spec->name_analysis == 'Ambient Air') { ?>
                                            <td><?= htmlspecialchars($row->sampling_time); ?></td> 
                                            <?php } ?>
                                            <input type="hidden" name="id_sk" value="<?= $row->id_sk ?>">
                                            <input type="hidden" name="id_analysis" value="<?= $row->id_analysis ?>">
                                            <input type="hidden" name="id_int" value="<?= $row->id_int ?>">
                                            <input type="hidden" name="id_result[]" value="<?= $row->id_result ?>">
                                            <?php if($coa_spec->name_analysis != "Heat Stress" && $coa_spec->name_analysis != "Non-Stationary Source Emission" && $coa_spec->name_analysis != "24 HOURS NOISE") { ?>
                                            <td><input type="text" name="result[]" value="<?= $row->result ?>" class="form-control"></td>
                                            <?php } ?>
                                            <td><?= htmlspecialchars($row->name_method); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="name_int" value="<?= @$coa_spec->name_int ?>">
                            <?php foreach($sk_number as $sk) : ?>
                            <input type="hidden" name="no_certificate" value="<?= @$sk->no_certificate ?>">
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary float-right"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                            <a href="<?= base_url('D_analyst/data_analysis_coa/') . $row->id_sk ?>" class="btn btn-danger float-left mr-2"><i class="fas fa-arrow-left"></i> Back to List Analysis</a>
                          </form>
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