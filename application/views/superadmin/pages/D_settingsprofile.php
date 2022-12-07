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
                <form id="imageForm1" method="POST" action="<?= base_url('D_superadmin/update_profile_action') ?>" enctype="multipart/form-data">
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
                      <?php if($pro->image != NULL) { ?>
                      <img src="<?= base_url('assets/img/avatar/') . $pro->image ?>" alt="" class="img-thumbnail mb-2" id="image_crop_data" width="100px" height="50px">
                      <?php } ?>
                      <div id="image_crop_data2"></div>
                      <div class="custom-file">
                        <input id="input" type="file" class="custom-file-input <?php if(form_error('image')) { echo "is-invalid"; } ?>" name="image">
                        <label class="custom-file-label">Choose File</label>
                      </div>
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

<!-- MODEL POPUP -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Crop the image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
          <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="crop">Crop</button>
      </div>
    </div>
  </div>
</div>
<!-- MODEL POPUP -->