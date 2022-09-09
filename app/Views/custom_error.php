<!-- ZEGY'S Temporary error page -->
<?php $msg = session()->getFlashData('msg') ?>
<div class="alert alert-danger">
    <?php echo $msg ?>
</div>

<a class="nav-link" href="<?php echo base_url('/') ?>">Back to main page</a>