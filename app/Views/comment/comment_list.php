<?php foreach ($comments as $comment) { ?>
<div id="<?= 'comment_' . $comment->comment_pk ?>">
  <div class="card-comment">
    <div class="row">
      <div class="col-12">
        <img class="img-circle img-sm" src="<?= base_url('resource/users/thumb' . $comment->user_profile_picture) ?>" alt="User Image"><!-- User image -->
        <div class="comment-text">
        <span class="username">
          <a href="<?= base_url('user/detail/' . $comment->user_pk) ?>">
            <?= mb_strimwidth($comment->user_full_name, 0, 43, "..") ?>
          </a>
          <span class="text-muted float-right"><?= date("d-m-Y H:i", strtotime($comment->comment_date_time)) ?></span>
        </span><!-- /.username -->
        <div id="comment_text"><?= $comment->comment_text ?></div>
        </div><!-- /.comment-text -->
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-12">
        <div style="margin-top: 5px" class="float-right">
          <button style="width: 50px" type="button" class="btn <?php if ($comment->like_status == "0"){echo('btn-success');} else {echo('btn-outline-success');} ?> btn-xs btn-like-comment" data-cid="<?= $comment->comment_pk ?>">
            <i class="fas fa-thumbs-up"></i> <?= $comment->nolike ?>
          </button>
          <button style="width: 50px" type="button" class="btn <?php if ($comment->like_status == "1"){echo('btn-danger');} else {echo('btn-outline-danger');} ?> btn-xs btn-dislike-comment" data-cid="<?= $comment->comment_pk ?>">
            <i class="fas fa-thumbs-down"></i> <?= $comment->nodislike ?>
          </button>
        </div>
        <?php if ($comment->user_pk == session('id') || session('role') == 'admin') { ?>
        <div style="margin-top: 5px; margin-left: 40px" class="float-left">
          <button type="button" class="btn btn-danger btn-xs btn-delete-comment" data-cid="<?= $comment->comment_pk ?>"><i class="far fa-trash-alt"></i></button>
          <button type="button" class="btn btn-secondary btn-xs btn-update-comment" data-cid="<?= $comment->comment_pk ?>"><i class="far fa-edit"></i></button>
        </div>
        <?php } ?>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.card-comment -->
</div>
<?php } ?>