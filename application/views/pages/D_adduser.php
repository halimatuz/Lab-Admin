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
          <div class="card-header">
                <h4>Add User</h4>
          </div>
          <div class="card-body">
                <form method="POST" action="<?= base_url('D_auth/add_user_action') ?>">
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="fullname">Full Name</label>
                      <input id="fullname" type="text" class="form-control <?php if(form_error('fullname')) { echo "is-invalid"; } ?>" name="fullname" value="<?= set_value('fullname') ?>" autofocus>
                      <?php echo form_error('fullname', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control <?php if(form_error('email')) { echo "is-invalid"; } ?>" name="email" value="<?= set_value('email') ?>">
                    <?php echo form_error('email', '<span class="text-small text-danger">', '</span>') ?>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control" name="password">
                      <?php echo form_error('password', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Password Confirmation</label>
                      <input id="password2" type="password" class="form-control" name="password2">
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Submit
                    </button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>