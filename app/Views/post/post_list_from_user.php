<div class="card-body" style="height: auto;">
  <!-- <table class="table table-head-fixed text-nowrap projects"> -->
  <table style="text-align: center" class="table table-bordered table-striped table-responsive projects"> <!-- TODO : Clean "projects" later -->
    <thead>
      <tr>
        <th>No.</th>
        <th>Judul Diskusi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post) { ?>
      <tr>
        <td style="width: 50px; min-width: 50px"><?= $post->pid ?></td>
        <td style="width: 100%; min-width: 330px; text-align: justify" class="post_td_text" data-link="<?= base_url('group/umum/detail/' . $post->pid) ?>"><?= $post->pttl ?></td> <!-- NOTE Experimental : The weird "style" is so table's column can have "static" width -->
        <td class="project-actions text-right">
          <a class="btn btn-primary" href="<?= base_url('group/umum/detail/' . $post->pid) ?>"><i class="far fa-comments"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div><!-- /.card-body -->