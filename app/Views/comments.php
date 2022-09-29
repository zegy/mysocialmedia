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
      <!-- "Post" with custom template based on stisla's "features-tickets" [ -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="tickets">
                <div class="ticket-content">
                  <div class="ticket-header">
                    <div class="ticket-sender-picture img-shadow">
                      <img src="../assets/img/avatar/avatar-5.png" alt="image">
                    </div>
                    <div class="ticket-detail">
                      <div class="ticket-title">
                        <h4>Technical Problem</h4> <!-- TODO As judul diskusi -->
                      </div>
                      <div class="ticket-info">
                        <div class="font-weight-600">Farhan A. Mujib</div>
                        <div class="bullet"></div>
                        <div class="text-primary font-weight-600">2 min ago</div>
                      </div>
                      <div class="media-links"> <!-- TODO Template from comment below. Sync later -->
                        <!-- <a href="#">View</a> -->
                        <div class="bullet"></div>
                        <a href="#">Edit</a>
                        <div class="bullet"></div>
                        <a href="#" class="text-danger">Hapus</a>
                      </div>
                    </div>
                  </div>
                  <div class="ticket-description"> <!-- TODO only use one "p" -->
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  
                    <div class="gallery">
                      <div class="gallery-item" data-image="../assets/img/news/img01.jpg" data-title="Image 1"></div>
                      <div class="gallery-item" data-image="../assets/img/news/img02.jpg" data-title="Image 2"></div>
                      <div class="gallery-item" data-image="../assets/img/news/img03.jpg" data-title="Image 3"></div>
                      <div class="gallery-item gallery-more" data-image="../assets/img/news/img04.jpg" data-title="Image 4">
                        <div>+2</div>
                      </div>
                    </div>
  
                    <div class="ticket-divider"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- "Post" with custom template based on stisla's "features-tickets" ] -->
      <!-- "Comments" [ -->
      <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Comments</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                <li class="media">
                  <img alt="image" class="mr-3 rounded-circle" width="70" src="../assets/img/avatar/avatar-3.png">
                  <div class="media-body">
                    <!-- <div class="media-right"><div class="text-warning">Pending</div></div> -->
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
      <!-- "Comments" ] -->
    </div>
  </section>
</div>

<?= $this->endSection() ?>