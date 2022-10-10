<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?php if($this->uri->segment(1) == 'D_stp'){echo'Add STP';}elseif($this->uri->segment(1) == 'D_stps'){echo 'Add STPS';}elseif($this->uri->segment(1) == 'D_gencoa' && $this->uri->segment(2) == ''){echo 'Generate COA';}elseif($this->uri->segment(2) == "data_quotation"){echo 'Input Result COA';}else{echo "Print COA";} ?></h1>
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
                    <h6 class="text-primary">List Quotation</h6>
                    <hr>
                      <?php if($quotation == NULL) { ?>
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
                                <th>SK Quotation</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($quotation as $qtn) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($qtn->name_int); ?></td>
                                        <td><?= htmlspecialchars($qtn->sk_quotation); ?></td>
                                        <td>
                                          <?php if($this->uri->segment(1) == 'D_stps') { ?>
                                            <?php if($qtn->sk_sample == 0) { ?>
                                              <a href="<?php echo base_url('D_stps/add_stps/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add STPS</a>
                                            <?php } else { ?>
                                              <a href="<?php echo base_url('D_stps/add_stps/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i> Edit STPS</a>
                                            <?php } ?>
                                          <?php } elseif($this->uri->segment(1) == 'D_stp') { ?>
                                            <?php if($qtn->sk_analysis == 0) { ?>
                                              <a href="<?php echo base_url('D_stp/add_stp/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add STP</a>
                                            <?php } else { ?>
                                              <a href="<?php echo base_url('D_stp/add_stp/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i> Edit STP</a>
                                            <?php } ?>
                                          <?php } elseif($this->uri->segment(2) == 'data_quotation') { ?>
                                              <a href="<?php echo base_url('D_gencoa/data_analysis/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Generate COA</a>
                                          <?php } else {?>
                                              <a href="<?php echo base_url('D_gencoa/pdf_coa/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-print"></i> PDF</a>
                                          <?php } ?>
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