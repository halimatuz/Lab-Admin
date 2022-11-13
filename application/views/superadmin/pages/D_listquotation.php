<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?php if($this->uri->segment(2) == 'list_quotation'){echo'List Quotation';}elseif($this->uri->segment(2) == 'data_stp_index'){echo'Add STP';}elseif($this->uri->segment(2) == 'data_stps_index'){echo 'Add STPS';}elseif($this->uri->segment(2) == 'data_quotation_coa'){echo 'Generate COA';}elseif($this->uri->segment(2) == "data_quotation"){echo 'Input Result COA';}elseif($this->uri->segment(2) == "data_test_request"){echo 'Add Test Request';}elseif($this->uri->segment(2) == "data_baps"){echo 'Add BAPS';}elseif($this->uri->segment(2) == "data_invoice"){echo 'Add Invoice';}else{echo "Print COA";} ?></h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>List Quotation</h4>
              <?php if($this->uri->segment(2) == 'data_quotation_print' || $this->uri->segment(2) == 'data_quotation_coa') : ?>
              <div class="card-header-action">
                <a href="#summary-doksli" data-tab="summary-tab" class="btn active">Authentic Document</a>
                <a href="#summary-rev" data-tab="summary-tab" class="btn">Revision</a>
              </div>
              <?php endif; ?>
            </div>
            <div class="card-body">
              <div class="summary-doksli active" data-tab-group="summary-tab" id="summary-doksli">
                <div class="row">
                    <div class="col-12">
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
                                <?php if($this->uri->segment(2) == 'data_quotation_coa' ||$this->uri->segment(2) == 'data_quotation_print' ) { ?>
                                <th>No Certificate</th>
                                <?php } ?>
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
                                        <?php if($this->uri->segment(2) == 'data_quotation_coa' || $this->uri->segment(2) == 'data_quotation_print') { ?>
                                        <td><?= htmlspecialchars($qtn->no_certificate); ?></td>
                                        <?php } ?>
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
                                              <a href="<?= base_url('D_superadmin/add_quotation/') . $qtn->id_sk ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Quotation</a>
                                              <?php if ($qtn->status_po == 0) { ?>
                                                <a href="<?= base_url('D_superadmin/verifikasi/cek/') . $qtn->id_sk ?>" class="btn btn-success btn-xs" title="PO"><i class="fas fa-check"></i></a>
                                              <?php } else { ?>
                                                <a href="<?= base_url('D_superadmin/verifikasi/cek/') . $qtn->id_sk ?>" class="btn btn-danger btn-xs" title="Cancel PO"><i class="fas fa-times"></i></a>
                                              <?php } ?>
                                          <?php } elseif($this->uri->segment(2) == 'data_stps_index') { ?>
                                            <?php if($qtn->sk_sample == 0) { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_stps/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add STPS</a>
                                            <?php } else { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_stps/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i> Edit STPS</a>
                                            <?php } ?>
                                          <?php } elseif($this->uri->segment(2) == 'data_test_request') { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_test_request/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add Test Request</a>
                                          <?php } elseif($this->uri->segment(2) == 'data_baps') { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_baps/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add BAPS</a>
                                          <?php } elseif($this->uri->segment(2) == 'data_invoice') { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_invoice/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add Invoice</a>
                                          <?php } elseif($this->uri->segment(2) == 'data_stp_index') { ?>
                                            <?php if($qtn->sk_analysis == 0) { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_stp/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add STP</a>
                                            <?php } else { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_stp/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i> Edit STP</a>
                                            <?php } ?>
                                          <?php } elseif($this->uri->segment(2) == 'data_quotation_coa') { ?>
                                              <a href="<?php echo base_url('D_superadmin/data_analysis_coa/') . $qtn->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Generate COA</a>
                                              <a href="<?php echo base_url('D_superadmin/generate_revision/') . $qtn->id_sk ?>"class="btn btn-success tombol-generate-rev"><i class="fas fa-plus"></i> Generate Revision</a>
                                          <?php } else {?>
                                            <?php if($qtn->status_approve == 1) { ?>
                                              <a href="<?php echo base_url('D_superadmin/pdf_coa/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-print"></i> PDF</a>
                                            <?php } ?>
                                              <a href="<?php echo base_url('D_superadmin/draft_coa/') . $qtn->id_sk ?>"class="btn btn-primary"><i class="fas fa-print"></i> Draft</a>
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
              <?php if($this->uri->segment(2) == 'data_quotation_print' || $this->uri->segment(2) == 'data_quotation_coa') : ?>
              <div class="summary-rev" data-tab-group="summary-tab" id="summary-rev">
                <div class="row">
                    <div class="col-12">
                      <?php if($quotation_rev == NULL) { ?>
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
                            <table class="table table-striped" id="table-3">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Name Institution</th>
                                <th>SK Quotation</th>
                                <?php if($this->uri->segment(2) == 'data_quotation_coa' ||$this->uri->segment(2) == 'data_quotation_print' ) { ?>
                                <th>No Certificate</th>
                                <?php } ?>
                                <th>Date</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($quotation_rev as $qtn_rev) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($qtn_rev->name_int); ?></td>
                                        <td><?= htmlspecialchars($qtn_rev->sk_quotation); ?></td>
                                        <td><?= htmlspecialchars($qtn_rev->no_certificate_rev); ?></td>
                                        <td><?= htmlspecialchars($qtn_rev->date_quotation); ?></td>
                                        <td>
                                            <?php if($this->uri->segment(2) == 'data_quotation_print') : if($qtn_rev->status_approve == 1) { ?>
                                              <a href="<?php echo base_url('D_superadmin/pdf_coa_rev/') . $qtn_rev->id_sk . '/' . $qtn_rev->revision ?>"class="btn btn-primary"><i class="fas fa-print"></i> PDF</a>
                                            <?php } ?>
                                              <a href="<?php echo base_url('D_superadmin/draft_coa_rev/') . $qtn_rev->id_sk . '/' . $qtn_rev->revision ?>"class="btn btn-primary"><i class="fas fa-print"></i> Draft</a>
                                            <?php endif; if($this->uri->segment(2) == 'data_quotation_coa') :?>
                                            <a href="<?php echo base_url('D_superadmin/data_analysis_coa_rev/') . $qtn_rev->id_sk . '/' . $qtn_rev->revision ?>"class="btn btn-success"><i class="fas fa-plus"></i> Generate COA</a>
                                            <?php endif; ?>
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
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>