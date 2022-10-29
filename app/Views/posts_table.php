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
            <!-- TODO Check later if there is problem -->
            <img alt="Avatar" class="table-avatar profile-user-img img-fluid img-circle" src="<?= base_url('assets/dist/img/avatar.png') ?>"> <!-- NOTE Original : Only had "table-avatar", the additions is from profile page's "Profile Image" (overrided in layout) -->
            <a href="<?php echo base_url('user/showprofile/' . $post->uid) ?>"><?= $post->nome ?></a>
          </td>
          <td><?= $post->data ?></td>
          <td><span class="badge bg-warning">Pending</span></td>
          <!-- <td><span class="badge bg-success">Approved</span></td> -->
          <!-- <td><span class="badge bg-danger">Denied</span></td> -->
          <td><a href="<?= base_url('fordis/umum/'.$post->pid) ?>"><?= $post->pttl ?></a></td>
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