<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <img src="<?= base_url('assets/img/company_profile/logo/') . $company_pages->img_logo ?>" alt="" width="50" class="mr-2">
      <a href="<?php echo base_url(); ?>D_superadmin">Information</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url(); ?>D_superadmin">DIL</a>
    </div>
    <ul class="sidebar-menu">
    <li class="menu-header">Dashboard</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == '' ? 'active' : ''; ?>">
        <a href="<?= base_url('D_superadmin'); ?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
      </li>

    <li class="menu-header">Data Master</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_int' || $this->uri->segment(2) == 'data_analysis' || $this->uri->segment(2) == 'data_sampler' || $this->uri->segment(2) == 'data_sample' || $this->uri->segment(2) == 'data_method' || $this->uri->segment(2) == 'data_coa' || $this->uri->segment(2) == 'add_coa' || $this->uri->segment(2) == 'update_coa' || $this->uri->segment(2) == 'data_unit' || $this->uri->segment(2) == 'update_sampler' || $this->uri->segment(2) == 'update_int' || $this->uri->segment(2) == 'update_analysis' || $this->uri->segment(2) == 'update_sample' || $this->uri->segment(2) == 'update_method' || $this->uri->segment(2) == 'update_unit' || $this->uri->segment(2) == 'update_regulation' || $this->uri->segment(2) == 'data_regulation' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-upload"></i><span>Add Data</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_int' || $this->uri->segment(2) == 'update_int' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_int">Add Institution</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_analysis' || $this->uri->segment(2) == 'update_analysis' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_analysis">Add Analysis</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_sampler' || $this->uri->segment(2) == 'update_sampler' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_sampler">Add Sampler</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_sample' || $this->uri->segment(2) == 'update_sample' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_sample">Add Sample</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_method' || $this->uri->segment(2) == 'update_method' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_method">Add Method</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_regulation' || $this->uri->segment(2) == 'update_regulation' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_regulation">Add Regulation</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_unit' || $this->uri->segment(2) == 'update_unit' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_unit">Add Unit</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_coa' || $this->uri->segment(2) == 'update_coa' || $this->uri->segment(2) == 'add_coa' || $this->uri->segment(2) == 'update_coa' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_coa">Add COA</a></li>
        </ul>
      </li>

    <li class="menu-header">Logbook</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_quotation' || $this->uri->segment(2) == 'list_quotation' || $this->uri->segment(2) == 'add_quotation' || $this->uri->segment(2) == 'update_quotation' || $this->uri->segment(2) == 'data_invoice' || $this->uri->segment(2) == 'add_invoice' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-contract"></i><span>Quotation</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_quotation' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_quotation">Generate SK Number</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'list_quotation' || $this->uri->segment(2) == 'add_quotation' || $this->uri->segment(2) == 'update_quotation' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/list_quotation">List Quotation</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_invoice' || $this->uri->segment(2) == 'add_invoice' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_invoice">Add Invoice</a></li>
        </ul>
      </li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_stps_index' || $this->uri->segment(2) == 'data_stps' || $this->uri->segment(2) == 'add_stps' || $this->uri->segment(2) == 'add_sampler_stps' || $this->uri->segment(2) == 'update_sampler_stps' || $this->uri->segment(2) == 'data_test_request' || $this->uri->segment(2) == 'add_test_request' || $this->uri->segment(2) == 'data_baps' || $this->uri->segment(2) == 'add_baps' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-contract"></i><span>STPS</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_test_request' || $this->uri->segment(2) == 'add_test_request' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_test_request">Add Test Request</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_stps' || $this->uri->segment(2) == 'add_sampler_stps' || $this->uri->segment(2) == 'update_sampler_stps' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_stps">Assign Sampler STPS</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_stps_index' && $this->uri->segment(3) == '' || $this->uri->segment(2) == 'add_stps' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_stps_index">Add STPS</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_baps' || $this->uri->segment(2) == 'add_baps' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_baps">Add BAPS</a></li>
        </ul>
      </li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_stp_index' || $this->uri->segment(2) == 'data_stp' || $this->uri->segment(2) == 'add_stp' || $this->uri->segment(2) == 'add_sampler_stp' || $this->uri->segment(2) == 'update_sampler_stp' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-contract"></i><span>STP</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_stp' || $this->uri->segment(2) == 'add_sampler_stp' || $this->uri->segment(2) == 'update_sampler_stp' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_stp">Assign Sampler STP</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_stp_index' && $this->uri->segment(3) == '' || $this->uri->segment(2) == 'add_stp' || $this->uri->segment(2) == 'update_stp' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_stp_index">Add STP</a></li>
        </ul>
      </li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'data_quotation_coa' || $this->uri->segment(2) == 'data_analysis_coa' || $this->uri->segment(2) == 'data_analysis_coa_rev' || $this->uri->segment(2) == 'input_result' || $this->uri->segment(2) == 'input_result_rev' || $this->uri->segment(2) == 'data_quotation_print' || $this->uri->segment(2) == 'data_coa_revision' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-contract"></i><span>COA</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'data_quotation_coa' || $this->uri->segment(2) == 'data_analysis_coa' || $this->uri->segment(2) == 'data_analysis_coa_rev' || $this->uri->segment(2) == 'input_result' || $this->uri->segment(2) == 'input_result_rev' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_quotation_coa">Generate COA</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'data_quotation_print' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/data_quotation_print">Print COA</a></li>
        </ul>
      </li>

      <li class="menu-header">Report</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'report_quotation' ? 'active' : ''; ?>">
        <a href="<?= base_url(); ?>D_superadmin/report_quotation" class="nav-link"><i class="fas fa-file-export"></i><span>Report Quotation</span></a>
      </li>

      <li class="menu-header">Validation</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'scan_coa' ? 'active' : ''; ?>">
        <a href="<?= base_url(); ?>D_superadmin/scan_coa" class="nav-link"><i class="fas fa-qrcode"></i><span>Scan COA</span></a>
      </li>
      
      <li class="menu-header">More</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'add_user' || $this->uri->segment(2) == 'list_users' ? 'active' : ''; ?>">
        <a href="<?= base_url(); ?>D_superadmin/list_users" class="nav-link"><i class="fas fa-user"></i><span>Users</span></a>
      </li>

      <li class="dropdown <?php echo $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'settings' || $this->uri->segment(2) == 'update_company_profile' ? 'active' : ''; ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i> <span>Features</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/profile">Profile</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'settings' || $this->uri->segment(2) == 'update_company_profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>D_superadmin/settings">Settings</a></li>
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