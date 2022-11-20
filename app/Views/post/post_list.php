<div class="card-body" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-bordered table-striped table-responsive projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Reason</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td style="width: 50px; min-width: 50px"><?= $post->pid ?></td>
        <td style="width: 150px; min-width: 150px">
          <img alt="Avatar" class="table-avatar <?='circle-role-' . $post->role ?>" src="<?= base_url('assets/dist/img/avatar.png') ?>" data-uid="<?= $post->uid ?>" data-user_full_name="<?= $post->nome ?>" data-user_role="<?= $post->role ?>"><!-- NOTE Original : Only had "table-avatar" (overrided in layout) -->
          <br/>
          <small>Pada : 
            <?= $post->data ?>
          </small>
        </td>
        <td style="width: 100%; min-width: 330px; text-align: justify"><a href="<?= base_url('group/umum/detail/' . $post->pid) ?>"><?= $post->pttl ?></a></td> <!-- NOTE Experimental : The weird "style" is so table's column can have "static" width -->
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