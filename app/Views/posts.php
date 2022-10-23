<?= $this->extend('layout') ?>
<?= $this->section('content') ?> 

<div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
  <section class="content-header"><!-- Content Header (Page header) -->
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Simple Tables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Simple Tables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content"><!-- Main content -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Fixed Header Table</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div><!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap projects">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($posts) { foreach ($posts as $post) { ?>
                  <tr>
                    <td>183</td>
                    <td>
                      <img alt="Avatar" class="table-avatar" src="<?= base_url('assets/dist/img/avatar.png') ?>">
                      <a href="<?php echo base_url('user/showprofile/' . $post->uid) ?>"><?= $post->nome ?></a>
                    </td>
                    <td><?= $post->data ?></td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <!-- <td><span class="badge bg-success">Approved</span></td> -->
                    <!-- <td><span class="badge bg-danger">Denied</span></td> -->
                    <td>
                      <?php if ($type == 'publik') { ?>
                      <a href="<?= base_url('fordis/publik/'.$post->pid) ?>"><?= $post->pttl ?></a>
                      <?php } else { ?>
                      <a href="<?= base_url('fordis/dosen/'.$post->pid) ?>"><?= $post->pttl ?></a>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php } } else { ?>
                  <?php } ?>
                </tbody>
              </table>
            </div><!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div><!-- /.card -->
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?= $this->endSection() ?>