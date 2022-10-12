<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('_layout/header');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>403</h1>
            <div class="page-description">
              You do not have access to this page.
            </div>
            <div class="page-search">
              <div class="mt-3">
                <a href="<?php echo base_url('D_auth'); ?>">Back to Login</a>
              </div>
            </div>
          </div>
        </div>
        <div class="simple-footer mt-5">
          Copyright &copy; Stisla 2018
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('_layout/js'); ?>