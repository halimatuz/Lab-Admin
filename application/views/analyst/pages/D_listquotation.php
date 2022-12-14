<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?php if($this->uri->segment(2) == 'list_quotation'){echo'List Quotation';}elseif($this->uri->segment(2) == 'data_stp_index'){echo'Add STP';}elseif($this->uri->segment(2) == 'data_stps_index'){echo 'Add STPS';}elseif($this->uri->segment(2) == 'data_quotation_coa'){echo 'Generate COA';}elseif($this->uri->segment(2) == "data_quotation"){echo 'Input Result COA';}else{echo "Print COA";} ?></h1>
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
                                <th>Date</th>
                                <?php if($this->uri->segment(2) == 'list_quotation') { ?>
                                <th>Purchase Order</th>
                                <?php } ?>
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
                                        <td><?= htmlspecialchars($qtn->date_quotation); ?></td>
                                        <?php if($this->uri->segment(2) == 'list_quotation') { ?>
                                        <td align="center">
                                          <?php if ($qtn->status_po == 1) { ?>
                                            <label class="badge badge-success">PO</label>
                                          <?php } else { ?>
                                            <label class="badge badge-danger">Not yet</label>
                                          <?php } ?>
                                        </td>
                                        <?php } ?>
                                        <td>
                                          <?php if($this->uri->segment(2) == 'list_quotation') { ?>
                                              <a href="<?= base_url('D_analyst/add_quotation/') . $qtn->id_sk ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Quotation</a>
                                              <?php if ($qtn->status_po == 0) { ?>
                                                <a href="<?= base_url('D_analyst/verifikasi/cek/') . $qtn->id_sk ?>" class="btn btn-success btn-xs" title="PO"><i class="fas fa-check"></i></a>
                                              <?php } else { ?>
                                                <a href="<?= base_url('D_analyst/verifikasi/cek/') . $qtn->id_sk ?>" class="btn btn-danger btn-xs" title="Cancel PO"><i class="fas fa-times"></i></a>
                                              <?php } ?>
                                          <?php } elseif($this->uri->segment(2) == 'data_stps_index') { ?>
                                            <?php if($qtn->sk_sample == 0) { ?>
                                              <a href="<?php echo base_url('D_analyst/add_stps/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add STPS</a>
                                            <?php } else { ?>
                                              <a href="<?php echo base_url('D_analyst/add_stps/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i> Edit STPS</a>
                                            <?php } ?>
                                          <?php } elseif($this->uri->segment(2) == 'data_stp_index') { ?>
                                            <?php if($qtn->sk_analysis == 0) { ?>
                                              <a href="<?php echo base_url('D_analyst/add_stp/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add STP</a>
                                            <?php } else { ?>
                                              <a href="<?php echo base_url('D_analyst/add_stp/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i> Edit STP</a>
                                            <?php } ?>
                                          <?php } elseif($this->uri->segment(2) == 'data_quotation_coa') { ?>
                                              <a href="<?php echo base_url('D_analyst/data_analysis_coa/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Generate COA</a>
                                          <?php } else {?>
                                              <a href="<?php echo base_url('D_analyst/pdf_coa/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-print"></i> PDF</a>
                                              <a href="<?php echo base_url('D_analyst/draft_coa/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-print"></i> Draft</a>
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