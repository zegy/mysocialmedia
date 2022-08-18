<div class = "cointainer">
	<div class="row">
		<div class = "col-sm-12 ">
			<?php echo form_open('comment/save',  ['class' => 'pull_right']) ?>
			<input type="hidden" name="post_id" value="<?php echo $post->pid ?>" />
			<input type="hidden" name="save_type" value="new_com" />
			<h3>Escrever um novo comentário</h3>
			<fieldset>
			    <div class="form-group ">
					<textarea class="form-control" id="texto" name="text"  cols="30" rows="10" placeholder=" ...Digite aqui um comentário" ></textarea>
				</div>
			</fieldset>
			<div class = "col-sm-1">
			    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>Enviar</button>
		    </div>
			<?php echo form_close() ?> 
		</div>
	</div>
</div>