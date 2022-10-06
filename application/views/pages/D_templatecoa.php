<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Templating COA</h1>
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
                    <div class="col-md-12">
                    <h6 class="text-primary">List Analysis</h6>
                    <hr>
                        <?php if($analysis == NULL) { ?>
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
                                <th>Name Analysis</th>
                                <th>Template</th>
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
                                        <td>
                                            <?php if($anl->template == NULL) { ?>
                                                <span class="badge badge-danger">No Templates Yet</span>
                                            <?php } else { ?>
                                                <span class="badge badge-success">Have a Template</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url('D_templatingcoa/add_template/') . $anl->id_analysis ?>"class="btn btn-success"><i class="fas fa-plus"></i> Add Template</a>
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