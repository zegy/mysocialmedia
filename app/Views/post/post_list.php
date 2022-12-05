<div class="card-body" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-bordered table-striped table-responsive projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>No.</th>
        <th>Pembuat</th>
        <th>Judul Diskusi</th>
        <th>Tanggal</th>
        <th>"Action"</th> <!-- TODO -->
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td style="width: 50px; min-width: 50px"><?= $post->post_pk ?></td>
        <td style="width: 150px; min-width: 150px">
          <!-- TODO (Pending) : Below is very inefficient use of "data()" -->
          <img alt="Avatar" class="table-avatar <?='circle-role-' . $post->user_role ?>" src="<?= base_url('resource/users/thumb' . $post->user_profile_picture) ?>" data-uid="<?= $post->user_pk ?>" data-user_full_name="<?= $post->user_full_name ?>" data-user_role="<?= $post->user_role ?>" data-user_bio="<?= $post->user_bio ?>" data-user_id_mix="<?= $post->user_id_mix ?>"><!-- NOTE Original : Only had "table-avatar" (overrided in layout) -->
          <br/>
          <small><?= $post->user_id_mix ?></small>
        </td>
        <td style="width: 100%; min-width: 330px; text-align: justify" class="post_td_text" data-link="<?= base_url('group/' . $post->post_group . '/' . 'detail/' . $post->post_pk) ?>"><?= $post->post_title ?></td> <!-- NOTE Experimental : The weird "style" is so table's column can have "static" width -->
        <td style="width: 50px; min-width: 50px"><?= $post->post_date_time ?></td> <!-- TODO : Fix the format later! -->
        <td class="project-actions text-center">
          <a class="btn btn-primary" href="<?= base_url('group/' . $post->post_group . '/' . 'detail/' . $post->post_pk) ?>"><i class="far fa-comments"></i></a>
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