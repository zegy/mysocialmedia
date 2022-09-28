<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Forum Diskusi</h1>
      <div class="section-header-button">
        <a href="post/saveform" class="btn btn-primary">Buat Diskusi Baru</a>
      </div>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card mb-0">
            <div class="card-body">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Forum Diskusi Publik <span class="badge badge-white"><?php //echo $newPostNo ?></span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Forum Diskusi Dosen <span class="badge badge-primary"><?php //echo $newPostNo ?></span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <?php if ($posts) { ?>
              <div class="float-right">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
              <div class="clearfix mb-3"></div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th>Judul diskusi</th>
                    <th>Pembuat</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                  </tr>
                  <?php foreach ($posts as $post) { ?>
                  <tr>
                    <td>
                      <a href="comment/show/<?= $post->pid ?>"><?= $post->pttl ?></a> <!-- NOTE Using "htmlspecialchars()" will disable "font" style! -->
                    </td>
                    <td>
                      <a href="<?= base_url('user/showprofile/'. $post->uid) ?>">
                        <img alt="image" src="<?php echo base_url($post->image)?>" class="rounded-circle" width="35" data-toggle="title" title=""> <div class="d-inline-block ml-1"><?= htmlspecialchars($post->nome) ?></div> <!-- TODO problem with "alt" image -->
                      </a>
                    </td>
                    <td><?= formatDate($post->data)?></td> <!-- TODO must use "formatDate()"? -->
                    <td><div class="badge badge-primary">Terjawab</div></td> <!-- NOTE Variants : badge-warning / badge-danger -->
                  </tr>
                  <?php } ?>
                </table>
              </div>
              <?php } else { ?>
              <div class="card">
                <!-- <div class="card-header">
                  <h4>Empty Data</h4>
                </div> -->
                <div class="card-body">
                  <div class="empty-state" data-height="400">
                    <div class="empty-state-icon">
                      <i class="fas fa-question"></i>
                    </div>
                    <h2>We couldn't find any data</h2>
                    <p class="lead">
                      Sorry we can't find any data, to get rid of this message, make at least 1 entry.
                    </p>
                    <a href="#" class="btn btn-primary mt-4">Create new One</a>
                    <a href="#" class="mt-4 bb">Need Help?</a>
                  </div>
                </div>
              </div>
              <?php } ?>
              <div class="float-right"><?php echo $pager->links('default', 'stisla') ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>