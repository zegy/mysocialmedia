
<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
    
<?= $this->include('posts/all_post') ?>

<?= $this->include('posts/form_add_post') ?>

<?= $this->endSection() ?>