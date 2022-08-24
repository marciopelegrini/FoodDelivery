<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Food Delivery | <?= $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="<?= site_url('admin/') ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= site_url('admin/') ?>vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= site_url('admin/') ?>css/style.css">
    <link rel="shortcut icon" href="<?= site_url('/') ?>favicon_food.ico"/>

    <!-- This section render the styles specifics that extends this layout -->
    <?= $this->renderSection('styles') ?>

</head>
<body>
<div class="container-scroller">

    <?= $this->renderSection('content') ?>

    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?= site_url('admin/') ?>vendors/base/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?= site_url('admin/') ?>js/off-canvas.js"></script>
<script src="<?= site_url('admin/') ?>js/hoverable-collapse.js"></script>
<script src="<?= site_url('admin/') ?>js/template.js"></script>
<!-- endinject -->
<?= $this->renderSection('scripts') ?>

</body>

</html>
