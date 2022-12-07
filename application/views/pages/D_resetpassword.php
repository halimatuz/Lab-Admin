<?php
defined('BASEPATH') OR exit('No direct script access allowed');

foreach($company as $c) {
  $cmp = $c;
}
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
            <img src="<?php echo base_url('assets/img/company_profile/logo/') . $cmp->img_logo ?>" alt="logo" width="100" class="" style="object-fit:cover; object-position:center;">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Reset Password</h4></div>

              <div class="card-body">
                <form method="POST" action="<?= base_url('D_auth/reset_password_action') ?>">
                  <p class="text-muted">Please change the password account below.</p>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
                    <input type="hidden" name="id_user" value="<?= $data_user->id_user ?>">
                    <input type="hidden" name="id_user_encrypt" value="<?= $this->uri->segment(3) ?>">
                    <?php echo form_error('password', '<span class="text-small text-danger">', '</span>') ?>
                  </div>

                  <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="confirm_password" tabindex="2" required>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Reset Password
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>