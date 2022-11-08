<?php if($posts) { ?>
<div class="card-body table-responsive p-0" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-head-fixed text-wrap projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Reason</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td><?= $post->pid ?></td>
        <td><img alt="Avatar" class="table-avatar <?='circle-role-' . $post->role ?>" src="<?= base_url('assets/dist/img/avatar.png') ?>" id="<?= $post->uid ?>"></td> <!-- NOTE Original : Only had "table-avatar" (overrided in layout) -->
        <td style="min-width: 330px; max-width: 330px; text-align: justify"><a href="<?= base_url('fordis/umum/'.$post->pid) ?>"><?= $post->pttl ?></a></td> <!-- NOTE Experimental : The weird "style" is so table's column can have "static" width -->
        <td style="min-width: 100px"><?= $post->data ?></td>
        <td><span class="badge bg-warning">Pending</span></td>
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