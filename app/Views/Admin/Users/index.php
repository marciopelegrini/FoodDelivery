<?php echo $this->extend('Admin/layout/principal'); ?>
<?php echo $this->section('title') ?> <?= $titre ?> <?php echo $this->endSection() ?>

<?php echo $this->section('styles') ?>
<!-- Here we send the styles personnalized -->
<link rel="stylesheet" href="<?= site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>"/>


<?php echo $this->endSection() ?>
<?php echo $this->section('content') ?>
<!-- Here we send the MAIN content page -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?= $titre ?></h4>
                        <div class="ui-widget">
                            <input id="query" name="query" placeholder="Recherche des usagers" class="form-control bg-light mb-5">
                        </div>

                        <a href="<?= site_url("admin/users/creer"); ?>" class="btn btn-success mb-5">
                            <i class="mdi mdi-plus btn-icon-prepend"></i>Nouveau usager
                        </a>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nom d'usager</th>
                                    <th>Courriel</th>
                                    <th>Permis de conduire</th>
                                    <th>Status</th>
                                    <th>Situation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td>
                                            <a href="<?= site_url("admin/users/show/$user->id") ?>"><?= $user->nom ?></a>
                                        </td>
                                        <td><?= $user->courriel ?></td>
                                        <td><?= $user->assurance_maladie ?></td>
                                        <td><?= ($user->actif && $user->deleted_at == null ? '<label class="badge badge-success">Actif</label>' : '<label class="badge badge-info">Attente</label>') ?></td>
                                        <td>
                                            <?= ($user->deleted_at == null ? '<label class="badge badge-success">Actif</label>' : '<label class="badge badge-danger">Supprimé</label>') ?>
                                            <?php if ($user->deleted_at != null): ?>
                                                <a href="<?= site_url("admin/users/retablirusager/$user->id"); ?>"
                                                   class="badge badge-outline-info ml-2"><i class="mdi mdi-undo btn-icon-prepend"></i> Rétablir usager
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="mt-3">
                                <?= $pager->links() ?>
                            </div>
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
<script src="<?= site_url('admin/vendors/auto-complete/jquery-ui.js') ?>"></script>
<script>
    $(function () {
        $("#query").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo site_url('admin/users/recherche_usager'); ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        if (data.length < 1) {
                            var data = [
                                {
                                    label: 'User not found',
                                    value: -1
                                }
                            ];
                        }
                        response(data); //Value in data
                    }, //end data
                }); // end ajax
            },
            minLength: 1,
            select: function (event, ui) {
                if (ui.item.value == -1) {
                    $(this).val("");
                    return false;
                } else {
                    window.location.href = '<?php echo site_url('admin/users/show/') ?>' + ui.item.id;
                }
            }
        }); //end autocomplete
    });
</script>

<?php echo $this->endSection() ?>

