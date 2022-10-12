<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Data STP</h1>
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
                    <h6 class="text-primary">List STP</h6>
                    <hr>
                      <?php if($stp == NULL) { ?>
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
                                foreach ($ceksampler as $row) : if ($row->sk_sample != NULL) {?>
                                
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->name_int); ?></td>
                                        <td><?= htmlspecialchars($row->sk_quotation); ?></td>
                                        <td>
                                            <?php if($row->st_account == 0) { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_sampler_stp/') . $row->id_sk ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add Sampler STP</a>
                                            <?php } else { ?>
                                              <a href="<?php echo base_url('D_superadmin/add_sampler_stp/') . $row->id_sk ?>"class="btn btn-primary"><i class="fas fa-edit"></i> Edit Sampler STP</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } endforeach;?>
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