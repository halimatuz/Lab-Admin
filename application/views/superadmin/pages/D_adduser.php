<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Templating COA</h1>
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
                <form method="POST" action="<?= base_url('D_superadmin/add_user_action') ?>">
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="fullname">Full Name</label>
                      <input id="fullname" type="text" class="form-control <?php if(form_error('fullname')) { echo "is-invalid"; } ?>" name="fullname" value="<?= set_value('fullname') ?>" autofocus>
                      <?php echo form_error('fullname', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="email">Email</label>
                      <input id="email" type="text" class="form-control <?php if(form_error('email')) { echo "is-invalid"; } ?>" name="email" value="<?= set_value('email') ?>">
                      <?php echo form_error('email', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="role">Role</label>
                      <select name="role" id="role" class="form-control <?php if(form_error('role')) { echo "is-invalid"; } ?>">
                        <option value="">--- Select Role ---</option>
                        <option value="superadmin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="marketing">Marketing</option>
                        <option value="analyst">Analyst</option>
                      </select>
                      <?php echo form_error('role', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
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