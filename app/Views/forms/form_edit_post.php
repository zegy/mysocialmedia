<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>

<h3>Edit Post</h3>
 
	<?php echo form_open('post/update/'. $post->post_pk,  ['class' => 'pull_right']) ?>
	<div class="form-group">
    	<textarea class="form-control" id="text" name="text" rows="5" cols="100" style="width: 100%; height: 300px;" required><?= $post->post_text ?> </textarea>
  	</div>
	<div class="form-group">      
     	<button type="submit" class="btn btn-success">Salvar</button>
    	<a class="btn btn-danger" onclick="history.back()">Voltar</a>
    </div>
 	<?php echo form_close() ?>

<?= $this->endSection() ?>