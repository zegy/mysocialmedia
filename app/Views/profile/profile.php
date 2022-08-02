
<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>

<div class="container">
	<div class="row">
		<div class="col-md-6 img">
			<img src="<?php echo base_url('public/'.$userData['user_profile_picture'])?>" alt="profile-img" class="rounded-circle" width="190" height="190">
		</div>
		<div class="col-md-6 details">
			<blockquote>
				<h5><?=  htmlspecialchars($userData['user_full_name']) ?></h5>
				<small><cite title="Source Title"> <?= htmlspecialchars($userData['user_bio']) ?> <i class="icon-map-marker"></i></cite></small>
			</blockquote>
			<p>
				<?= $userData['user_email'] ?> <br>	
			</p>
		</div>
	</div>
</div>

<a class="nav-link" href="<?= base_url('post/userPosts/' . $userData['user_pk']) ?>">Post</a>

<?= $this->endSection() ?>  