<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>User</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Components</a></div>
        <div class="breadcrumb-item">User</div>
      </div>
    </div>

    <div class="section-body">
      <!-- <h2 class="section-title">Users</h2>
      <p class="section-lead">Components relating to users, lists of users and so on.</p> -->

      <div class="row">
        <div class="col-12 col-sm-12 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Comments</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="70" src="../assets/img/avatar/avatar-1.png">
                  <div class="media-body">
                    <div class="media-right"><div class="text-primary">Approved</div></div>
                    <div class="media-title mb-1">Rizal Fakhri</div>
                    <div class="text-time">Yesterday</div>
                    <div class="media-description text-muted">Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                    <div class="media-links">
                      <a href="#">View</a>
                      <div class="bullet"></div>
                      <a href="#">Edit</a>
                      <div class="bullet"></div>
                      <a href="#" class="text-danger">Trash</a>
                    </div>
                  </div>
                </li>
                <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="70" src="../assets/img/avatar/avatar-2.png">
                  <div class="media-body">
                    <div class="media-right"><div class="text-warning">Pending</div></div>
                    <div class="media-title mb-1">Bambang Uciha</div>
                    <div class="text-time">Yesterday</div>
                    <div class="media-description text-muted">Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                    <div class="media-links">
                      <a href="#">View</a>
                      <div class="bullet"></div>
                      <a href="#">Edit</a>
                      <div class="bullet"></div>
                      <a href="#" class="text-danger">Trash</a>
                    </div>
                  </div>
                </li>
                <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="70" src="../assets/img/avatar/avatar-3.png">
                  <div class="media-body">
                    <div class="media-right"><div class="text-primary">Approved</div></div>
                    <div class="media-title mb-1">Ujang Maman</div>
                    <div class="text-time">Yesterday</div>
                    <div class="media-description text-muted">Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident</div>
                    <div class="media-links">
                      <a href="#">View</a>
                      <div class="bullet"></div>
                      <a href="#">Edit</a>
                      <div class="bullet"></div>
                      <a href="#" class="text-danger">Trash</a>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>