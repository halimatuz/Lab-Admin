<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>List Users</h1>
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
                    <a href="<?= base_url('D_auth/add_user') ?>" class="btn btn-primary">Add User</a>
                    <hr>
                      <?php if($user == NULL) { ?>
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
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $row) :?>
                                
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row->fullname); ?></td>
                                        <td><?= htmlspecialchars($row->email); ?></td>
                                        <td><?= htmlspecialchars($row->role_id); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('D_auth/delete_user/') . $row->id_user ?>"class="btn btn-danger"><i class="fas fa-trash"></i> Delete User</a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
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