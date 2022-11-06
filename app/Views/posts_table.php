<?php if($posts) { ?>
<div class="card-body table-responsive p-0" style="height: 300px;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table class="table table-head-fixed text-wrap projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th style="min-width: 500px;">Reason</th> <!-- NOTE Experimental -->
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td><?= $post->pid ?></td>
        <td>
          <img alt="Avatar" class="table-avatar <?='circle-role-' . $post->role ?>" src="<?= base_url('assets/dist/img/avatar.png') ?>"> <!-- NOTE Original : Only had "table-avatar" (overrided in layout) -->
        </td>
        <!-- <td><a href="<?= base_url('fordis/umum/'.$post->pid) ?>"><?= $post->pttl ?></a></td> --> <!-- TODO : Change this, below is only temp -->
        <td><a href="<?= base_url('fordis/umum/'.$post->pid) ?>">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex laborum similique, eligendi, reiciendis ratione fugit aperiam atque mollitia soluta repudiandae voluptate voluptas excepturi minus suscipit tempore facere iusto doloribus! Enim.</a></td>
        <td><?= $post->data ?></td>
        <td><span class="badge bg-warning">Pending</span></td>
        <!-- <td><span class="badge bg-success">Approved</span></td> -->
        <!-- <td><span class="badge bg-danger">Denied</span></td> -->
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div><!-- /.card-body -->
<div class="card-footer clearfix">
  <ul class="pagination pagination-sm m-0 float-right">
    <li class="page-item"><a class="page-link btn-pagination" href="#" id="1">&laquo;</a></li>
    <?php echo $pager->links('default', 'custom') ?> <!-- NOTE The 1st parameter is group and the 2nd is view / template -->
    <li class="page-item"><a class="page-link btn-pagination" href="#" id="<?= $pager->getPageCount() ?>">&raquo;</a></li> <!-- NOTE : The getLastPageNumber and getPageCount not working properly in "template". Hence why it's here -->
  </ul>
</div>
<?php } else { ?>
<div class="card-body">             
  <h3>Belum ada diskusi di forum ini</h3>
  Silahkan buat diskusi perdana dari anda!
</div><!-- /.card-body -->
<?php } ?>