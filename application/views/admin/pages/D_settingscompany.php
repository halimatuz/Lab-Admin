<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Settings</h1>
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
          <div class="card-header">
            <h4>Settings Company Profile</h4>
          </div>
          <div class="card-body">
                <?php foreach($company as $cmp) : ?>
                <form method="POST" action="<?= base_url('D_admin/update_company_profile_action') ?>">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name">Company Name</label>
                      <input type="hidden" name="id" value="<?= $cmp->id ?>">
                      <input id="name" type="text" class="form-control <?php if(form_error('name')) { echo "is-invalid"; } ?>" name="name" value="<?= $cmp->name ?>" autofocus>
                      <?php echo form_error('name', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="address">Address</label>
                      <textarea name="address" id="address" cols="30" rows="10" class="form-control <?php if(form_error('address')) { echo "is-invalid"; } ?>"><?= $cmp->address ?></textarea>
                      <?php echo form_error('address', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="phone">Phone</label>
                      <input id="phone" type="text" class="form-control <?php if(form_error('phone')) { echo "is-invalid"; } ?>" name="phone" value="<?= $cmp->phone ?>">
                      <?php echo form_error('phone', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="website">Website</label>
                      <input id="website" type="text" class="form-control <?php if(form_error('website')) { echo "is-invalid"; } ?>" name="website" value="<?= $cmp->website ?>">
                      <?php echo form_error('website', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="director" class="d-block">Director</label>
                      <input id="director" type="text" class="form-control" name="director" value="<?= $cmp->director ?>">
                      <?php echo form_error('director', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="email" class="d-block">Email</label>
                      <input id="email" type="email" class="form-control" name="email" value="<?= $cmp->email ?>">
                      <?php echo form_error('email', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="director_email" class="d-block">Director Email</label>
                      <input id="director_email" type="text" class="form-control" name="director_email" value="<?= $cmp->director_email ?>">
                      <?php echo form_error('director_email', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <h6 class="text-primary mt-2">Company Rekening</h6>
                  <hr>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="norek">No. Rekening</label>
                      <input id="norek" type="text" class="form-control <?php if(form_error('norek')) { echo "is-invalid"; } ?>" name="norek" value="<?= $cmp->norek ?>">
                      <?php echo form_error('norek', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-6">
                      <label for="behalf_account">On behalf of the account</label>
                      <input type="text" name="behalf_account" id="behalf_account" class="form-control <?php if(form_error('behalf_account')) { echo "is-invalid"; } ?>" value="<?= $cmp->behalf_account ?>">
                      <?php echo form_error('behalf_account', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="bank">Bank</label>
                      <input id="bank" type="text" class="form-control <?php if(form_error('bank')) { echo "is-invalid"; } ?>" name="bank" value="<?= $cmp->bank ?>">
                      <?php echo form_error('bank', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                      Save Changes
                    </button>
                    <a href="<?= base_url('D_admin/settings') ?>" class="btn btn-danger">Cancel</a>
                  </div>
                  <?php endforeach; ?>
                </form>
              </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
</div>