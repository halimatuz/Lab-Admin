<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="<?= base_url() ?>assets/img/logo.png" alt="" width="50" class="mr-2">
      <a href="<?php echo base_url(); ?>example/index">Information</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url(); ?>example/index">DIL</a>
    </div>
    <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == '' ? 'active' : ''; ?>">
        <a href="<?= base_url('D_laborant'); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>

    <li class="menu-header">Logbook</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_quotation_coa' || $this->uri->segment(2) == 'data_analysis_coa' || $this->uri->segment(2) == 'input_result' || $this->uri->segment(2) == 'data_quotation_print' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-contract"></i><span>COA</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_quotation_coa' || $this->uri->segment(2) == 'data_analysis_coa' || $this->uri->segment(2) == 'input_result' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_laborant/data_quotation_coa">Generate COA</a></li>
        </ul>
      </li>

    <li class="menu-header">More</li>

      <li class="dropdown <?php echo $this->uri->segment(2) == 'profile' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_laborant/profile">Profile</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'setings' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_laborant/settings">Settings</a></li>
        </ul>
      </li>

    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <button class="btn btn-primary btn-lg btn-block btn-icon-split" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-rocket"></i> Change Log
      </button>
    </div>
  </aside>
</div>