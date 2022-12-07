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
          Settings
        </div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Overview</h2>
      <p class="section-lead">
        Organize and adjust all settings about this site.
      </p>

      <div class="row">
        <div class="col-lg-6">
          <div class="card card-large-icons">
            <div class="card-icon bg-primary text-white">
              <i class="fas fa-user"></i>
            </div>
            <div class="card-body">
              <h4>Profile</h4>
              <p>
                Profile settings such as, image profile, name, username, password.
              </p>
              <a href="<?= base_url('D_superadmin/update_profile') ?>" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card card-large-icons">
            <div class="card-icon bg-primary text-white">
              <i class="fas fa-cog"></i>
            </div>
            <div class="card-body">
              <h4>Company Profile</h4>
              <p>
                Company profile settings such as, company name, address, director name and so on.
              </p>
              <a href="<?= base_url('D_superadmin/update_company_profile') ?>" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card card-large-icons">
            <div class="card-icon bg-primary text-white">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="card-body">
              <h4>Email</h4>
              <p>Email SMTP settings, notifications and others related to email.</p>
              <a href="<?= base_url('D_superadmin/update_smtp') ?>" class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>