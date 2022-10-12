<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Scan COA</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">
          <a href="#">Dashboard</a>
        </div>
        <div class="breadcrumb-item">
          <a href="#">Modules</a>
        </div>
        <div class="breadcrumb-item">
          DataTables
        </div>
      </div>
    </div>

    <div class="section-body">
    <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $attributes = array('id' => 'button');
                        echo form_open('D_admin/cek_id',$attributes);?>
                        <div id="sourceSelectPanel" style="display:none">
                            <label for="sourceSelect">Change video source:</label>
                            <select id="sourceSelect"></select>
                        </div>
                        <div>
                            <video id="video" style="border: 1px solid gray" width="50%"></video>
                        </div>
                        <textarea hidden="" name="id_sk" id="result" readonly></textarea>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>