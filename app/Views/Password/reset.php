<?php echo $this->extend('Admin/layout/principal_auth'); ?>
<?php echo $this->section('title') ?> <?= $titre ?> <?php echo $this->endSection() ?>

<?php echo $this->section('styles') ?>
<!-- Here we send the styles personnalized -->
<?php echo $this->endSection() ?>
<?php echo $this->section('content') ?>
<!-- Here we send the content page -->

<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-5 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                    <!--  Contenu de flash Data (Alerts)  -->
                    <?php if (session()->has('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Succès</strong> <?= session('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('info')): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Information</strong> <?= session('info') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('warning')): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Attention</strong> <?= session('warning') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Erreur</strong> <?= session('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <div class="brand-logo text-center">
                        <img src="<?= site_url('admin/') ?>images/logo.png" alt="logo">
                    </div>

                    <h4 class="text-center"><?= $titre ?></h4>

                    <?php if (session()->has('errors_model')): ?>
                        <ul>
                            <?php foreach (session('errors_model') as $error): ?>
                                <li class="text-danger">
                                    <?= $error ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php echo form_open("password/processreset/$token"); ?>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="mot_de_passe">Nouveau mot de passe</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="confirm_mot_de_passe">Confirmer le nouveau mot de passe</label>
                            <input type="password" class="form-control" id="confirm_mot_de_passe" name="confirm_mot_de_passe">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-block btn-success mr-2">
                        <i class="mdi mdi-content-save-outline btn-icon-prepend"></i>
                        Rédefinir le mot de passe
                    </button>

                    <?php form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>

<?php echo $this->endSection() ?>
<?php echo $this->section('scripts') ?>
<?php echo $this->endSection() ?>
