<?= $this->extend('/layouts/main_layout') ?>

<?= $this->section('content') ?>

<h3>Edit Komentar</h3>
 
	<?php echo form_open('comment/save',  ['class' => 'pull_right']) ?>
    <input type="hidden" name="com_id" value="<?php echo $comment['comment_pk'] ?>" />
    <input type="hidden" name="com_user_id" value="<?php echo $comment['comment_fk_user']  ?>" />
    <input type="hidden" name="save_type" value="edit_com" />
	<div class="form-group">
    	<textarea class="form-control" id="text" name="text" rows="5" cols="100" style="width: 100%; height: 300px;"><?= $comment['comment_text'] ?> </textarea>
  	</div>
	<div class="form-group">      
     	<button type="submit" class="btn btn-success">Salvar</button>
    	<a class="btn btn-danger" onclick="history.back()">Voltar</a>
    </div>
 	<?php echo form_close() ?>

<?= $this->endSection() ?>