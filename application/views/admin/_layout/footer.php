<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer class="main-footer">
  <div class="footer-left">
    Copyright &copy; 2020
  </div>
  <div class="footer-right">

  </div>
</footer>
</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Change Log Version 1.0.0 (12/10/2022)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>This application is still in beta test so there may still be many bugs and errors that occur but we are trying to improve</p>
                <h6 class="font-weight-bold">Dashboard Super Admin :</h6>
                <hr>
                <ul>
                  <li>Add Data Master</li>
                  <li>Add Quotation</li>
                  <li>Add STPS</li>
                  <li>Add STP</li>
                  <li>Add COA</li>
                  <li>Scan COA</li>
                  <li>Add User</li>
                </ul>
                <h6 class="font-weight-bold">Issues Fixed</h6>
                <hr>
                <ul>
                  <li>The date in the quotation and STPS data is not correct.</li>
                  <li>Data sequence on master data, quotation, STPS, STP, and COA.</li>
                </ul>
              </div>
              <div class="modal-footer bg-whitesmoke br">
              </div>
            </div>
          </div>
</div>

<?php $this->load->view('admin/_layout/js'); ?>