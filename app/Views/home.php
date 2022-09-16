
<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
    
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
    <!-- Show posts ] -->

    <!-- Form add post [ -->
    <div class = "cointainer">
        <div class="row">
            <div class = "col-sm-12 ">
                <?php echo form_open('post/save',  ['class' => 'pull_right']) ?>

                <!-- Decide post type [ -->
                <?php if ($homeType == "public") { ?>
                    <input type="hidden" name="type" value="public" />
                <?php } ?>
                <?php if ($homeType == "private") { ?>
                    <input type="hidden" name="type" value="private" />
                <?php } ?>
                <!-- Decide post type ] -->
                
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
    <!-- Form add post ] -->

<?= $this->endSection() ?>