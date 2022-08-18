<div class = "cointainer">
    <div class="row">
        <div class = "col-sm-12 ">
            <?php echo form_open('post/save',  ['class' => 'pull_right']) ?>
            <input type="hidden" name="user_id" value="<?php echo session()->get('id') ?>" />

            <!-- Decide post type -->
            <?php if ($homeType == "public") { ?>
                <input type="hidden" name="type" value="public" />
            <?php } ?>
            <?php if ($homeType == "private") { ?>
                <input type="hidden" name="type" value="private" />
            <?php } ?>
            
            <h3 class="">Escrever um novo Post</h3>
            <fieldset>
                <div class="form-group ">
                    <textarea class="form-control" id="texto" name="text" placeholder=" ... Digite aqui seu post" required style="width: 100%; height: 200px;"></textarea>
                </div>
            </fieldset>
            <div class = "col-sm-1">
                <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i>Enviar</button>
            </div>
            <?php echo form_close() ?> 
        </div>
    </div>
</div>