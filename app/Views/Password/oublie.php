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
                    <h6 class="font-weight-light text-center mb-3"><?= $titre ?></h6>

                    <?php echo form_open('password/processoublie'); ?>

                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-lg" id="email" value="<?= old('email') ?>"
                               placeholder="Veuillez tapez votre courriel">
                    </div>

                    <div class="mt-3">
                        <input type="submit" id="btn-reset-pwd" class="btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                               value="ENVOYER">
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
<script>
    $("form").submit(function () {
        $(this).find(":submit").attr('disabled', 'disabled');
        $("#btn-reset-pwd").val("Envoyant le courriel de récupération");
    });
</script>
<?php echo $this->endSection() ?>
