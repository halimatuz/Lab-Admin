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
              <div class="card-header">
                <h4>Login</h4>
              </div>

              <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                <form method="POST" action="<?= base_url('D_auth') ?>">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="text" class="form-control" name="email" tabindex="1" required autofocus value="<?= set_value('email') ?>">
                    <?php echo form_error('email', '<span class="text-small text-danger">', '</span>') ?>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="<?php echo base_url(); ?>D_auth/forgot_password" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <?php echo form_error('password', '<span class="text-small text-danger">', '</span>') ?>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  <a href="<?= base_url('D_scancoa') ?>" class="btn btn-success btn-lg btn-block" tabindex="4">
                    <i class="fas fa-qrcode"></i> Scan COA
                  </a>
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

  <?php $this->load->view('_layout/js'); ?>