<?php
foreach($total_sampler as $ts) {
    $total_data_sampler = $ts;
}

foreach($total_institution as $ti) {
    $total_data_institution = $ti;
}

foreach($total_quotation as $tq) {
    $total_data_quotation = $tq;
}
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="flash-data-login" data-flashdata="<?= $this->session->flashdata('msglogin'); ?>"></div>
    <div class="row">
      <div class="col-12 mb-4">
          <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('<?= base_url('assets/img/unsplash/laboratorium.jpeg') ?>');">
            <div class="hero-inner">
              <h2>Welcome, <?= $this->session->userdata('fullname') ?>!</h2>
              <p class="lead">
                This page is a place to manage data laboratory, quotation, letter, and more.
              </p>
            </div>
          </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Sampler</h4>
            </div>
            <div class="card-body">
              <?= $total_data_sampler ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="far fa-building"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Customer</h4>
            </div>
            <div class="card-body">
                <?= $total_data_institution ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-chart-line"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total COA</h4>
            </div>
            <div class="card-body">
              <?= $total_coa ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-circle"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Quotation</h4>
            </div>
            <div class="card-body">
              <?= $total_data_quotation ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Step by Step</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-4">
                  <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab4" data-toggle="tab" href="#step1" role="tab" aria-controls="Step 1" aria-selected="true">Quotation</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab4" data-toggle="tab" href="#step2" role="tab" aria-controls="Step 2" aria-selected="false">STPS & STP</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">COA</a>
                    </li>
                  </ul>
                </div>
                <div class="col-12 col-sm-12 col-md-8">
                  <div class="tab-content no-padding" id="myTab2Content">
                    <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="home-tab4">
                      Before entering the quotation you must generate the SK Number in the add quotation menu, then you enter the quotation list at the institution you choose, after that select the SK number that you have generated, then fill in the quotation data.
                    </div>
                    <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="profile-tab4">
                      After entering the quotation, enter the STPS data by clicking the add STPS menu then selecting the quotation that you previously made and then entering the data, then you must enter a sampler for the STPS.
                      <br>
                      For STP do the same steps as entering STPS data.
                    </div>
                    <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                      The last stage is filling in the COA, going to the COA menu then generate COA when you enter the generate COA page you select which SK quotation to generate the coa, after that you will be directed to the analysis list in the quotation, you input the results one by one the analysis after that you can print the COA in the print COA section.
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
            </div>
    
    
  </section>
</div>