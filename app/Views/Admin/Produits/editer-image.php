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
                        <?php if (session()->has('errors_model')): ?>
                            <ul>
                                <?php foreach (session('errors_model') as $error): ?>
                                    <li class="text-danger">
                                        <?= $error ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?= form_open_multipart("admin/produits/upload/$produit->id"); ?>

                        <div class="form-group">
                            <label>Veuillez choisir une photo pour le produit</label>
                            <input type="file" name="photoproduit" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" placeholder="Téléverser l'image du produit">
                                <span class="input-group-append">
                          <button class="file-upload-browse btn btn-dark" type="button">Téléverser</button>
                        </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mr-2 btn-sm">
                            <i class="mdi mdi-content-save-outline btn-icon-prepend"></i>
                            Enregistrer
                        </button>
                        <a href="<?= site_url("admin/produits/show/$produit->id"); ?>" class="btn btn-info btn-sm">
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
<!-- Custom js for this page-->
<script src="<?= site_url('admin/js/file-upload.js') ?>"></script>
<?php echo $this->endSection() ?>

