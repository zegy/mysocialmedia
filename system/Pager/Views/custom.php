<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(3);
?>

<ul class="pagination pagination-sm m-0 float-right">
    <?php foreach ($pager->links() as $link) : ?>
        <li <?= $link['active'] ? 'class="page-item active"' : 'page-item' ?>>
            <a class="page-link btn-pagination" href="#" id="<?= $link['title'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>
</ul>