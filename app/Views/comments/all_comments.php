<?php if($comments) { foreach ($comments as $comment) { ?>

<div class="media p-3">
	<a href="<?= base_url('user/showprofile/'. $post->uid) ?>" ><img src="<?php echo base_url('public/'.$comment->image)?>" alt="user" class="mr-3 mt-3 rounded-circle" style="width:45px;"></a>
	<div class="text-message media-body">
		<h4><?= $comment->nome ?> <small><i>Postado em <?= formatDate($comment->data)?></i></small></h4>
		<p><?= htmlspecialchars($comment->texto) ?></p>
		<div class="form-group">
			<?php if (session()->get('id') == $comment->uid) { ?>
			<a href="<?= base_url('comment/edit/' . $comment->cid) ?>" class="btn btn-warning"><i class="fa fa-address-book" aria-hidden="true"></i> editar</a>
			<a href="<?= base_url('comment/delete/'.$comment->cid . '/' . $post->pid) ?>" class="btn btn-danger" > <i class="fa fa-trash" aria-hidden="true"></i> excluir</a>
			<?php } ?>
		</div>
	</div>
</div>

<?php } } else { ?>

<div class="alert alert-info">
    <strong>Ups!</strong> Belum ada komentar
</div>

<?php } ?>