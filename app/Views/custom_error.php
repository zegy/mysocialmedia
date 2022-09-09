<!-- ZEGY'S Temporary error page -->
<div class="alert alert-danger">
    <?php echo session()->getFlashData('message') ?>
</div>

<a class="nav-link" href="<?php echo base_url('/') ?>">Back to main page</a>