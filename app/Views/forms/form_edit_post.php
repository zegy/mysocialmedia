<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>

<h3>Edit Post</h3>
 
	<?php echo form_open('post/update',  ['class' => 'pull_right']) ?>
    <input type="hidden" name="post_id" value="<?php echo $post->post_pk ?>" />
    <input type="hidden" name="user_id" value="<?php echo $post->post_fk_user  ?>" />
	<div class="form-group">
    	<textarea class="form-control" id="text" name="text" rows="5" cols="100" style="width: 100%; height: 300px;"><?= $post->post_text ?> </textarea>
  	</div>
	<div class="form-group">      
     	<button type="submit" class="btn btn-success">Salvar</button>
    	<a class="btn btn-danger" onclick="history.back()">Voltar</a>
    </div>
 	<?php echo form_close() ?>

<?= $this->endSection() ?>