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
                    <form action="<?= base_url('D_superadmin/report_quotation') ?>" method="GET">
                      <div class="row align-items-center">
                        <div class="form-group col-md-3">
                          <label for="from">From Date</label>
                          <input type="date" name="from" class="form-control <?php if(form_error('from')) { echo "is-invalid"; } ?>" value="<?= @$from ?>">
                          <?php echo form_error('from', '<span class="text-small text-danger">', '</span>') ?>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="to">To Date</label>
                          <input type="date" name="to" class="form-control <?php if(form_error('to')) { echo "is-invalid"; } ?>" value="<?= @$to ?>">
                          <?php echo form_error('to', '<span class="text-small text-danger">', '</span>') ?>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                      </div>
                    </form>
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
                                <th>Purchase Order</th>
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
                                        <td align="center">
                                          <?php if ($qtn->status_po == 1) { ?>
                                            <label class="badge badge-success">PO</label>
                                          <?php } else { ?>
                                            <label class="badge badge-danger">Not yet</label>
                                          <?php } ?>
                                        </td>
                                        <td><a href="<?= base_url('D_superadmin/print_quotation/') . $qtn->id_sk ?>" class="btn btn-primary"><i class="fas fa-print"></i> Print</a></td>
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