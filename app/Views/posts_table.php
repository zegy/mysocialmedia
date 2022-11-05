<?php if($posts) { ?>
<div class="card-body table-responsive p-0" style="height: 300px;">
  <table class="table table-head-fixed text-nowrap projects">
    <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Date</th>
        <th>Status</th>
        <th style="width:100%">Reason</th> <!-- NOTE Experimental -->
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td>183</td>
        <td>
          <img alt="Avatar" class="table-avatar <?='circle-role-' . $post->role ?>" src="<?= base_url('assets/dist/img/avatar.png') ?>"> <!-- NOTE Original : Only had "table-avatar" (overrided in layout) -->
        </td>
        <td><?= $post->data ?></td>
        <td><span class="badge bg-warning">Pending</span></td>
        <!-- <td><span class="badge bg-success">Approved</span></td> -->
        <!-- <td><span class="badge bg-danger">Denied</span></td> -->
        <td><a href="<?= base_url('fordis/umum/'.$post->pid) ?>"><?= $post->pttl ?></a></td>
      </tr>
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
<?php } else { ?>
<div class="card-body">             
  <h3>Belum ada diskusi di forum ini</h3>
  Silahkan buat diskusi perdana dari anda!
</div><!-- /.card-body -->
<?php } ?>