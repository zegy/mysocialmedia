
<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 img">
			<img src="<?php echo base_url($userData->user_profile_picture)?>" alt="profile-img" class="rounded-circle" width="190" height="190">
		</div>
		<div class="col-md-6 details">
			<blockquote>
				<h5><?=  htmlspecialchars($userData->user_full_name) ?></h5>
				<small><cite title="Source Title"> <?= htmlspecialchars($userData->user_bio) ?> <i class="icon-map-marker"></i></cite></small>
			</blockquote>
			<p>
				<?= $userData->user_email ?> <br>	
			</p>
		</div>
	</div>
</div>

<!-- Show posts [ -->
<?php if($posts) { foreach ($posts as $post) { ?>
<div class="media border p-3 mt-3 box-component">
    <a href="<?= base_url('user/showprofile/'. $post->uid) ?>" ><img src="<?php echo base_url($post->image)?>" alt="<?= $post->nome ?>" class="mr-3 mt-3 rounded-circle" style="width:60px;"> </a>
    <div class="text-message media-body">
        <h4><?= htmlspecialchars($post->nome) ?> <small><i>Postado em <?= formatDate($post->data)?></i></small></h4>
        <p><?= htmlspecialchars($post->texto) ?></p>
        <div class="form-group">
            <a href="<?= base_url('comment/show/'.$post->pid) ?>" class="btn btn-success"><i class="fa fa-comment" aria-hidden="true"></i> <?= $post->qtdcom ?> </a>
            <?php if (session()->get('id') == $post->uid) { ?>
            <a href="<?= base_url('post/update/' . $post->pid) ?>" class="btn btn-warning"> <i class="fa fa-address-book" aria-hidden="true"></i> editar</a>
            <a href="<?= base_url('post/delete/' . $post->pid) ?> " class="btn btn-danger" > <i class="fa fa-trash" aria-hidden="true"></i> excluir</a>
            <?php } ?>
        </div>
    </div> 
</div>
<?php } } else { ?>
<div class="alert alert-info">
    <strong>Ups!</strong> Belum ada postingan
</div>
<?php } ?>
<hr>
<?php echo $pager->links() ?>
<hr>
<!-- Show posts ] -->

<?= $this->endSection() ?>  