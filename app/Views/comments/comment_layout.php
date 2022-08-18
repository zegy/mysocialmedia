<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>

<div class="media border p-3 box-component">
	<a href="<?= base_url('user/showprofile/'. $post->uid) ?>" ><img src="<?php echo base_url('public/'.$post->image)?>" alt="<?= $post->nome ?>" class="mr-3 mt-3 rounded-circle" style="width:60px;"></a>
	<div class="text-message media-body">
		<h4><?= $post->nome ?> <small><i>Postado em <?= formatDate($post->data)?></i></small></h4>
		<p><?= htmlspecialchars($post->texto) ?></p>
		<div class="form-group">
			<?php if (session()->get('id') == $post->uid) { ?>
			<a href="<?= base_url('post/edit/' . $post->pid) ?>" class="btn btn-warning"><i class="fa fa-address-book" aria-hidden="true"></i> editar</a>
			<a href="<?= base_url('post/delete/' . $post->pid) ?>" class="btn btn-danger" > <i class="fa fa-trash" aria-hidden="true"></i> excluir</a>
			<?php } ?>
		</div>
        <?= $this->include('comments/all_comments') ?>
		<hr>
        <?= $this->include('comments/form_add_comment') ?>
	</div>
</div>

<?= $this->endSection() ?>