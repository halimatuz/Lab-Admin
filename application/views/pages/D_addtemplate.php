<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Templating COA</h1>
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
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="text-primary">Choose Template</h6>
                        <hr>
                        <div class="form-group">
                            <div class="row gutters-sm">
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-4">
                                <input name="imagecheck" type="radio" value="1" class="imagecheck-input" />
                                <figure class="imagecheck-figure">
                                    <img src="<?= base_url() ?>assets/img/template/clean_water/cleanwater.jpg" alt="}" class="imagecheck-image">
                                </figure>
                                </label>
                            </div>
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-4">
                                <input name="imagecheck" type="radio" value="2" class="imagecheck-input" />
                                <figure class="imagecheck-figure">
                                    <img src="<?= base_url() ?>assets/img/template/heat_stress/heatstress.jpg" alt="}" class="imagecheck-image">
                                </figure>
                                </label>
                            </div>
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-4">
                                <input name="imagecheck" type="radio" value="3" class="imagecheck-input" />
                                <figure class="imagecheck-figure">
                                    <img src="<?= base_url() ?>assets/img/template/illumination/illumination.jpg" alt="}" class="imagecheck-image">
                                </figure>
                                </label>
                            </div>
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-4">
                                <input name="imagecheck" type="radio" value="4" class="imagecheck-input" />
                                <figure class="imagecheck-figure">
                                    <img src="<?= base_url() ?>assets/img/template/surface_water/surface_water.jpg" alt="}" class="imagecheck-image">
                                </figure>
                                </label>
                            </div>
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-4">
                                <input name="imagecheck" type="radio" value="5" class="imagecheck-input" />
                                <figure class="imagecheck-figure">
                                    <img src="<?= base_url() ?>assets/img/template/odor/odor.jpg" alt="}" class="imagecheck-image">
                                </figure>
                                </label>
                            </div>
                            <div class="col-6 col-sm-4">
                                <label class="imagecheck mb-4">
                                <input name="imagecheck" type="radio" value="6" class="imagecheck-input" />
                                <figure class="imagecheck-figure">
                                    <img src="<?= base_url() ?>assets/img/template/emission_stack/emission_stack.jpg" alt="}" class="imagecheck-image">
                                </figure>
                                </label>
                            </div>
                            </div>
                        </div>
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