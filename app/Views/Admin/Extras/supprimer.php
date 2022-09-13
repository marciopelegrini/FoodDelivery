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

            <div class="col-lg-8 grid-margin stretch-card">
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
                        <?= form_open("admin/extras/supprimer/$extra->id"); ?>

                        <div class="alert alert-warning" role="alert">
                            <strong>Attention</strong>Voulez-vous vraiment supprimer cette extra ?
                            <strong><?= esc($extra->nom); ?> ?</strong>
                        </div>

                        <button type="submit" class="btn btn-danger mr-2 btn-sm">
                            <i class="mdi mdi-trash-can-outline btn-icon-prepend"></i>
                            Supprimer
                        </button>

                        <a href="<?= site_url("admin/extras/show/$extra->id"); ?>" class="btn btn-info btn-sm">
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

<?php echo $this->endSection() ?>

