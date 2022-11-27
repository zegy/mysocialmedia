<div class="card-body" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-bordered table-striped table-responsive projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>user_profile_picture</th>
        <th>user_name</th>
        <th>user_full_name</th>
        <th>user_role</th>
        <th>"Action"</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) { ?>
      <tr> <!-- TODO : Styles -->
        <td style="width: 150px; min-width: 150px">
          <img alt="Avatar" class="table-avatar" src="<?= base_url('assets/dist/img/avatar.png') ?>">
        </td>
        <td style="width: 50px; min-width: 50px"><?= $user->user_name ?></td>
        <td style="width: 50px; min-width: 50px"><?= $user->user_full_name ?></td>
        <td style="width: 50px; min-width: 50px"><?= $user->user_role ?></td>
        <td class="project-actions text-right">
          <a class="btn btn-primary btn-sm" href="<?= base_url('user/detail/' . $user->user_pk) ?>"><i class="fas fa-info-circle"></i> Detail</a>
          <a class="btn btn-danger btn-sm" href="#"><i class="far fa-trash-alt"></i> Hapus</a>
        </td>
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