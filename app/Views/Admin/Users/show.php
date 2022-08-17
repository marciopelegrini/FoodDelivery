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

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header bg-primary pb-0 pt-4 ">
                        <h4 class="card-title text-white"><?= esc($titre) ?></h4>
                    </div>
                    <div class="card-body">

                        <p class="card-text">
                            <span class="font-weight-bold">Nom : </span>
                            <?= esc($usager->nom) ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Courriel : </span>
                            <?= esc($usager->courriel) ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Actif : </span>
                            <?= ($usager->actif ? 'Oui' : 'Non') ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Profil : </span>
                            <?= ($usager->is_admin ? 'Admin' : 'Clientèle') ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Créé : </span>
                            <?= $usager->created_at->humanize() ?>
                        </p>
                        <p class="card-text">
                            <span class="font-weight-bold">Modifié : </span>
                            <?= $usager->updated_at->humanize() ?>
                        </p>
                        <div class="mt-4">
                            <a href="<?= site_url("admin/users/editer/$usager->id"); ?>" class="btn btn-primary btn-sm mr-2">
                                <i class="mdi mdi-pencil btn-icon-prepend"></i>Éditer
                            </a>
                            <a href="<?= site_url("admin/users/supprimer/$usager->id"); ?>" class="btn btn-danger btn-sm mr-2">
                                <i class="mdi mdi-trash-can btn-icon-prepend"></i>Supprimer
                            </a>
                            <a href="<?= site_url("admin/users"); ?>" class="btn btn-info btn-sm">
                                <i class="mdi mdi-arrow-left btn-icon-prepend"></i> Retourner
                            </a>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:../../partials/_footer.html -->
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap dashboard template</a> from Bootstrapdash.com</span>
        </div>
    </footer>
    <!-- partial -->
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('scripts') ?>
<!-- Here we send the js scripts to the page -->
<?php echo $this->endSection() ?>

