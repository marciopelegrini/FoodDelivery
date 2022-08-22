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

                    <h4 class="text-center">Bonjour, Bienvenue</h4>
                    <h6 class="font-weight-light text-center mb-3">Se connecter pour continuer.</h6>

                    <?php echo form_open('login/creer'); ?>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg" id="email" value="<?= old('email') ?>"
                               placeholder="Veuillez tapez votre courriel">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-lg" name="mot_de_passe" id="mot_de_passe"
                               placeholder="Mot de passe">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn-block btn-primary btn-lg font-weight-medium auth-form-btn">CONNEXION</button>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <!--                        <div class="form-check">-->
                        <!--                            <label class="form-check-label text-muted">-->
                        <!--                                <input type="checkbox" class="form-check-input">-->
                        <!--                                Se souvenir de moi-->
                        <!--                            </label>-->
                        <!--                        </div>-->
                        <a href="#" class="auth-link text-black">Mot de passe oublié ?</a>
                    </div>
                    <!--                        <div class="mb-2">-->
                    <!--                            <button type="button" class="btn btn-block btn-facebook auth-form-btn">-->
                    <!--                                <i class="mdi mdi-facebook mr-2"></i>Connect using facebook-->
                    <!--                            </button>-->
                    <!--                        </div>-->
                    <div class="text-center mt-4 font-weight-light">
                        Vous n'avez pas de compte ? <a href="<?= site_url('register'); ?>" class="text-primary">S'inscrire</a>
                    </div>
                    <?php form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>

<?php echo $this->endSection() ?>
<?php echo $this->section('scripts') ?>
<!-- Here we send the js scripts to the page -->
<?php echo $this->endSection() ?>





