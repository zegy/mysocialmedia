<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(3);
?>

<!-- NOTE : "Go to first page" is manualy set in view -->
<?php foreach ($pager->links() as $link) : ?>
<li <?= $link['active'] ? 'class="page-item active"' : 'page-item' ?>>
    <a class="page-link btn-pagination" href="#" id="<?= $link['title'] ?>">
        <?= $link['title'] ?>
    </a>
</li>
<!-- NOTE : "Go to last page" is manualy set in view -->
<?php endforeach ?>