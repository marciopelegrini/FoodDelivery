<?php echo $this->extend('Admin/layout/principal'); ?>
<?php echo $this->section('title') ?> <?= $titre ?> <?php echo $this->endSection() ?>

<?php echo $this->section('styles') ?>
<!-- Here we send the styles personnalized -->
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<!-- Here we send the MAIN content page -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-primary pb-0 pt-4 ">
                        <h4 class="card-title text-white"><?= esc($titre) ?></h4>
                    </div>
                    <div class="card-body">
                        <?php if (session()->has('errors_model')): ?>
                            <ul>
                                <?php foreach (session('errors_model') as $error): ?>
                                    <li class="text-danger">
                                        <?= $error ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?= form_open("admin/extras/enregistrer/$extra->id"); ?>
                        <?= $this->include('Admin/Extras/form'); ?>
                        <a href="<?= site_url("admin/Extras/show/$extra->id"); ?>" class="btn btn-info btn-sm">
                            <i class="mdi mdi-arrow-left btn-icon-prepend"></i> Retourner
                        </a>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
<!-- Here we send the js scripts to the page -->
<script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>
<?php echo $this->endSection() ?>

