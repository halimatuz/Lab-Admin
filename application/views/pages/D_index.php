<?php
foreach($total_sampler as $ts) {
    $total_data_sampler = $ts;
}

foreach($total_institution as $ti) {
    $total_data_institution = $ti;
}

foreach($total_analysis as $ta) {
    $total_data_analysis = $ta;
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
    <div class="row">
      <div class="col-12 mb-4">
          <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('<?= base_url('assets/img/unsplash/laboratorium.jpeg') ?>');">
            <div class="hero-inner">
              <h2>Welcome, <?= $user['fullname'] ?>!</h2>
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
              <h4>Total Institution</h4>
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
              <h4>Total Analysis</h4>
            </div>
            <div class="card-body">
              <?= $total_data_analysis ?>
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
    
    
  </section>
</div>