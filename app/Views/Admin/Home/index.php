<?php echo $this->extend('Admin/layout/principal'); ?>
<?php echo $this->section('title') ?> <?= $titre ?> <?php echo $this->endSection() ?>

<?php echo $this->section('styles') ?>
<!-- Here we send the styles personnalized -->

<?php echo $this->endSection() ?>




<?php echo $this->section('content') ?>
<!-- Here we send the content page -->

<?php echo $titre; ?>

<?php echo $this->endSection() ?>





<?php echo $this->section('scripts') ?>
<!-- Here we send the js scripts to the page -->

<?php echo $this->endSection() ?>

