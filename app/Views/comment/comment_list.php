<?php foreach ($comments as $comment) { ?>
<div class="card-comment">
  <div class="row">
    <div class="col-12">
      <img class="img-circle img-sm" src="<?= base_url('assets/dist/img/user3-128x128.jpg') ?>" alt="User Image"><!-- User image -->
      <div class="comment-text">
      <span class="username">
        Maria Gonzales
        <span class="text-muted float-right">8:03 PM Today</span>
      </span><!-- /.username -->
      <?= $comment->texto ?>
      </div><!-- /.comment-text -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  <div class="row">
    <div class="col-12">
      <div style="margin-top: 5px" class="float-right">
        <button style="width: 50px" type="button" class="btn btn-outline-success btn-xs">
          <i class="fas fa-thumbs-up"></i> 123
        </button>
        <button style="width: 50px" type="button" class="btn btn-outline-danger btn-xs">
          <i class="fas fa-thumbs-down"></i> 123
        </button>
      </div>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.card-comment -->
<?php } ?>