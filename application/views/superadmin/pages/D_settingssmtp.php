<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Settings</h1>
    </div>

  <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
          <div class="card-header">
            <h4>Settings SMTP Config</h4>
          </div>
          <div class="card-body">
                <form method="POST" action="<?= base_url('D_superadmin/update_smtp_action') ?>">
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="host">Host</label>
                      <input type="hidden" name="id_smtp" value="<?= $smtp->id_smtp ?>">
                      <input id="host" type="text" class="form-control <?php if(form_error('host')) { echo "is-invalid"; } ?>" name="host" value="<?= $smtp->host ?>">
                      <?php echo form_error('name', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label for="smtp_secure">SMTP Secure</label>
                      <input id="smtp_secure" type="text" class="form-control <?php if(form_error('smtp_secure')) { echo "is-invalid"; } ?>" name="smtp_secure" value="<?= $smtp->smtp_secure ?>">
                      <?php echo form_error('smtp_secure', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="account_name">Account Name</label>
                      <input id="account_name" type="text" class="form-control <?php if(form_error('account_name')) { echo "is-invalid"; } ?>" name="account_name" value="<?= $smtp->account_name ?>">
                      <?php echo form_error('account_name', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label for="port">Port</label>
                      <input id="port" type="text" class="form-control <?php if(form_error('port')) { echo "is-invalid"; } ?>" name="port" value="<?= $smtp->port ?>">
                      <?php echo form_error('port', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <h6 class="text-primary mt-2">SMTP Auth</h6>
                  <hr>

                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="username" class="d-block">Username</label>
                      <input id="username" type="text" class="form-control" name="username" value="<?= $smtp->username ?>">
                      <?php echo form_error('username', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="text" class="form-control" name="password" value="<?= $smtp->password ?>">
                      <?php echo form_error('password', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>
                  
                  <h6 class="text-primary mt-2">Subject</h6>
                  <hr>

                  <div class="row">
                    <div class="form-group col-12">
                      <label for="subject">Subject</label>
                      <input id="subject" type="text" class="form-control <?php if(form_error('subject')) { echo "is-invalid"; } ?>" name="subject" value="<?= $smtp->subject ?>">
                      <?php echo form_error('name', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                      Save Changes
                    </button>
                    <a href="<?= base_url('D_superadmin/settings') ?>" class="btn btn-danger">Cancel</a>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </div>
      
    </div>
  </section>
</div>