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
                          <form action="<?= base_url('D_admin/save_result') ?>" method="post">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Parameters</th>
                                    <th>Unit</th>
                                    <th>Testing Result</th>
                                    <th>Method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($coa as $row) :?>
                                    
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row->params); ?></td>
                                            <td><?= htmlspecialchars($row->unit); ?></td>
                                            <input type="hidden" name="id_sk" value="<?= $row->id_sk ?>">
                                            <input type="hidden" name="id_analysis" value="<?= $row->id_analysis ?>">
                                            <input type="hidden" name="id_int" value="<?= $row->id_int ?>">
                                            <input type="hidden" name="id_result[]" value="<?= $row->id_result ?>">
                                            <td><input type="text" name="result[]" value="<?= $row->result ?>" class="form-control"></td>
                                            <td><?= htmlspecialchars($row->name_method); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary float-right"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                            <a href="<?= base_url('D_admin/data_analysis_coa/') . $row->id_sk ?>" class="btn btn-danger float-left mr-2"><i class="fas fa-arrow-left"></i> Back to List Analysis</a>
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