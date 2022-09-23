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
                            <?= esc($categorie->nom) ?>
                        </p>

                        <p class="card-text">
                            <span class="font-weight-bold">Actif : </span>
                            <?= ($categorie->actif ? 'Oui' : 'Non') ?>
                        </p>

                        <p class="card-text">
                            <span class="font-weight-bold">Créé : </span>
                            <?= $categorie->created_at->humanize() ?>
                        </p>

                        <?php if ($categorie->deleted_at == null): ?>
                            <p class="card-text">
                                <span class="font-weight-bold">Modifié : </span>
                                <?= $categorie->updated_at->humanize() ?>
                            </p>
                        <?php else: ?>
                            <p class="card-text">
                                <span class="font-weight-bold text-danger">Supprimé : </span>
                                <?= $categorie->deleted_at->humanize() ?>
                            </p>
                        <?php endif; ?>

                        <div class="mt-4">

                            <?php if ($categorie->deleted_at == null): ?>
                                <a href="<?= site_url("admin/categories/editer/$categorie->id"); ?>" class="btn btn-primary btn-sm mr-2">
                                    <i class="mdi mdi-pencil btn-icon-prepend"></i>Éditer
                                </a>
                                <a href="<?= site_url("admin/categories/supprimer/$categorie->id"); ?>" class="btn btn-danger btn-sm mr-2">
                                    <i class="mdi mdi-trash-can btn-icon-prepend"></i>Supprimer
                                </a>
                            <?php else: ?>
                                <a href="<?= site_url("admin/categories/retablircategorie/$categorie->id"); ?>" class="btn btn-inverse-dark btn-sm mr-2">
                                    <i class="mdi mdi-undo btn-icon-prepend"></i> Rétablir categorie
                                </a>
                            <?php endif; ?>

                            <a href="<?= site_url("admin/categories"); ?>" class="btn btn-info btn-sm">
                                <i class="mdi mdi-arrow-left btn-icon-prepend"></i> Retourner
                            </a>
                        </div>
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

