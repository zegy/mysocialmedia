<?php if($posts) { foreach ($posts as $post) { ?>

<div class="media border p-3 mt-3 box-component">
    <a href="<?= base_url('user/showprofile/'. $post->uid) ?>" ><img src="<?php echo base_url($post->image)?>" alt="<?= $post->nome ?>" class="mr-3 mt-3 rounded-circle" style="width:60px;"> </a>
    <div class="text-message media-body">
        <h4><?= htmlspecialchars($post->nome) ?> <small><i>Postado em <?= formatDate($post->data)?></i></small></h4>
        <p><?= htmlspecialchars($post->texto) ?></p>
        <div class="form-group">
            <a href="<?= base_url('comment/show/'.$post->pid) ?>" class="btn btn-success"><i class="fa fa-comment" aria-hidden="true"></i> <?= $post->qtdcom ?> </a>
            <?php if (session()->get('id') == $post->uid) { ?>
            <a href="<?= base_url('post/update_form/' . $post->pid) ?>" class="btn btn-warning"> <i class="fa fa-address-book" aria-hidden="true"></i> editar</a>
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
<?php session()->set('homeCurrentPage', $pager->getCurrentPage()) ?> <!-- ZEGY OTC -->
<?php echo session('homeCurrentPage') ?> <!-- ZEGY OTC -->
<hr>