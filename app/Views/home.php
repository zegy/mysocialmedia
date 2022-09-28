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
                  <!-- <a class="nav-link active" href="#">Forum Diskusi Publik <span class="badge badge-white"><?php //echo $newPostNo ?></span></a> -->
                  <a class="nav-link active" href="#">Forum Diskusi Publik <span class="badge badge-white"></span></a>
                </li>
                <li class="nav-item">
                  <!-- <a class="nav-link" href="#">Forum Diskusi Dosen <span class="badge badge-primary">1</span></a> -->
                  <a class="nav-link" href="#">Forum Diskusi Dosen <span class="badge badge-primary"></span></a>
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
                  <?php if ($posts) { foreach ($posts as $post) { ?>
                  <tr>
                    <td>
                      <a href="comment/show/<?= $post->pid ?>"><?= $post->pttl ?></a> <!-- NOTE using "htmlspecialchars()" will disable "font" style! -->
                    </td>
                    <td>
                      <a href="<?= base_url('user/showprofile/'. $post->uid) ?>">
                        <img alt="image" src="<?php echo base_url($post->image)?>" class="rounded-circle" width="35" data-toggle="title" title=""> <div class="d-inline-block ml-1"><?= htmlspecialchars($post->nome) ?></div> <!-- TODO problem with "alt" image -->
                      </a>
                    </td>
                    <td><?= formatDate($post->data)?></td> <!-- TODO must use "formatDate()"? -->
                    <td><div class="badge badge-primary">Terjawab</div></td>
                    <!-- <td><div class="badge badge-warning">Pending</div></td> -->
                    <!-- <td><div class="badge badge-danger">Draft</div></td> -->
                  </tr>
                  <?php } } else { ?>
                    <!-- TODO if empty -->
                  <?php } ?>
                </table>
              </div>
              <div class="float-right">
                <?php echo $pager->links('default', 'stisla') ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?= $this->endSection() ?>