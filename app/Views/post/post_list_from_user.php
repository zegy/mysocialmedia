<div class="card-body" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-sm table-bordered table-striped table-responsive projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>Judul Diskusi</th>
        <th>Jenis</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td style="width: 100%; min-width: 330px; text-align: justify" class="post_td_text" data-link="<?= base_url('group/' . $post->post_group . '/' . 'detail/' . $post->post_pk) ?>"><?= $post->post_title ?></td> <!-- NOTE Experimental : The weird "style" is so table's column can have "static" width -->
        <td style="width: 50px; min-width: 50px" class="text-capitalize"><?= $post->post_group ?></td>
        <td class="project-actions text-right">
          <a class="btn btn-info" href="<?= base_url('group/' . $post->post_group . '/' . 'detail/' . $post->post_pk) ?>"><i class="far fa-comments"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div><!-- /.card-body -->