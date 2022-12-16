<div class="card-body" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-sm table-bordered table-striped table-responsive projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>Pembuat</th>
        <th>Judul Diskusi</th>
        <th>Waktu</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td style="width: 150px; min-width: 150px; padding-top: 10px;" class="post_td_user" data-uid="<?= $post->user_pk ?>">
          <img alt="Avatar" class="table-avatar elevation-2 <?='circle-role-' . $post->user_role ?>" src="<?= base_url('resource/users/thumb' . $post->user_profile_picture) ?>"><!-- NOTE Original : Only had "table-avatar" (overrided in layout) -->
          <br/>
          <small><?= mb_strimwidth($post->user_full_name, 0, 18, "..") ?></small>
        </td>
        <td style="width: 100%; min-width: 330px; text-align: justify" class="post_td_title" data-link="<?= base_url('group/' . $post->post_group . '/' . 'detail/' . $post->post_pk) ?>"><?= $post->post_title ?></td> <!-- NOTE Experimental : The weird "style" is so table's column can have "static" width -->
        <td style="width: 50px; min-width: 135px"><?= date("d-m-Y H:i", strtotime($post->post_date_time)) ?></td> <!-- TODO : Fix the format later! -->
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