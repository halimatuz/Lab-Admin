<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Settings</h1>
    </div>

    <div class="section-body">
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
      <div class="row">
        <div class="col-12">
          <div class="card">
          <div class="card-header">
            <h4>Settings Profile</h4>
          </div>
          <div class="card-body">
                <?php foreach($profile as $pro) : ?>
                <form method="POST" action="<?= base_url('D_superadmin/update_profile_action') ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="fullname">Fullname</label>
                      <input type="hidden" name="id_user" value="<?= $pro->id_user ?>">
                      <input id="fullname" type="text" class="form-control <?php if(form_error('fullname')) { echo "is-invalid"; } ?>" name="fullname" value="<?= $pro->fullname ?>" autofocus>
                      <?php echo form_error('fullname', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group col-12 col-md-6">
                      <label for="email">Email</label>
                      <textarea name="email" id="email" cols="30" rows="10" class="form-control <?php if(form_error('email')) { echo "is-invalid"; } ?>"><?= $pro->email ?></textarea>
                      <?php echo form_error('email', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <label for="image" class="d-block">Image Profile</label>
                      <?php if($pro->image != NULL) : ?>
                      <img src="<?= base_url('assets/img/avatar/') . $pro->image ?>" alt="" class="img-thumbnail mb-2" width="100px" height="50px">
                      <?php endif; ?>
                      <input id="image" type="file" class="form-control <?php if(form_error('image')) { echo "is-invalid"; } ?>" name="image" value="<?= $pro->image ?>">
                      <?php echo form_error('image', '<span class="text-small text-danger">', '</span>') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                      Save Changes
                    </button>
                    <a href="<?= base_url('D_superadmin/settings') ?>" class="btn btn-danger">Cancel</a>
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