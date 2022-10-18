<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="<?= base_url() ?>assets/img/logo.png" alt="" width="50" class="mr-2">
      <a href="<?php echo base_url(); ?>D_marketing">Information</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url(); ?>D_marketing">DIL</a>
    </div>
    <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == '' ? 'active' : ''; ?>">
        <a href="<?= base_url('D_marketing'); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>

    <li class="menu-header">Data Master</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_int' || $this->uri->segment(2) == 'data_analysis' || $this->uri->segment(2) == 'data_sampler' || $this->uri->segment(2) == 'data_sample' || $this->uri->segment(2) == 'data_method' || $this->uri->segment(2) == 'data_coa' || $this->uri->segment(2) == 'add_coa' || $this->uri->segment(2) == 'update_coa' || $this->uri->segment(2) == 'data_unit' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-upload"></i><span>Add Data</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_int' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_int">Add Institution</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_analysis' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_analysis">Add Analysis</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_sampler' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_sampler">Add Sampler</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_sample' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_sample">Add Sample</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_method' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_method">Add Method</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_unit' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_unit">Add Unit</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_coa' || $this->uri->segment(2) == 'add_coa' || $this->uri->segment(2) == 'update_coa' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_coa">Add COA</a></li>
        </ul>
      </li>

    <li class="menu-header">Logbook</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_quotation' || $this->uri->segment(2) == 'list_quotation' || $this->uri->segment(2) == 'add_quotation' || $this->uri->segment(2) == 'update_quotation' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-contract"></i><span>Quotation</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_quotation' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/data_quotation">Generate SK Number</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'list_quotation' || $this->uri->segment(2) == 'add_quotation' || $this->uri->segment(2) == 'update_quotation' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/list_quotation">List Quotation</a></li>
        </ul>
      </li>

      <li class="menu-header">Validation</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'scan_coa' ? 'active' : ''; ?>">
        <a href="<?= base_url(); ?>D_marketing/scan_coa" class="nav-link"><i class="fas fa-qrcode"></i><span>Scan COA</span></a>
      </li>
      
      <li class="menu-header">More</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'settings' || $this->uri->segment(2) == 'update_company_profile' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/profile">Profile</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'settings' || $this->uri->segment(2) == 'update_company_profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_marketing/settings">Settings</a></li>
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