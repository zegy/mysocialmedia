<div class="card-body" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-bordered table-striped table-responsive projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>No.</th>
        <th>Pembuat</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) { ?>
      <tr>
        <td style="width: 50px; min-width: 50px"><?= $user->user_pk ?></td>
        <td style="width: 150px; min-width: 150px">
          <img alt="Avatar" class="table-avatar <?='circle-role-' . $user->user_role ?>" src="<?= base_url('assets/dist/img/avatar.png') ?>" data-uid="<?= $user->user_pk ?>" data-user_full_name="<?= $user->user_full_name ?>" data-user_role="<?= $user->user_role ?>"><!-- NOTE Original : Only had "table-avatar" (overrided in layout) -->
        </td>
        <td class="project-actions text-right">
          <a class="btn btn-primary" href="<?= base_url('group/umum/detail/' . $user->user_pk) ?>"><i class="far fa-comments"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div><!-- /.card-body -->
<?php if (!empty($pager)) { ?>
<div class="card-footer clearfix">
  <ul class="pagination pagination-sm m-0 float-right">
    <li class="page-item"><a class="page-link btn-pagination" href="#" id="1">&laquo;</a></li>
    <?php echo $pager->links('default', 'custom') ?> <!-- NOTE The 1st parameter is group and the 2nd is view / template -->
    <li class="page-item"><a class="page-link btn-pagination" href="#" id="<?= $pager->getPageCount() ?>">&raquo;</a></li> <!-- NOTE : The getLastPageNumber and getPageCount not working properly in "template". Hence why it's here -->
  </ul>
</div>
<?php } ?>