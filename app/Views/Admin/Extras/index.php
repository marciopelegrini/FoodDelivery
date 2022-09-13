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
                            <input id="query" name="query" placeholder="Recherche pour extras de produits" class="form-control bg-light mb-5">
                        </div>

                        <a href="<?= site_url("admin/extras/creer"); ?>" class="btn btn-success mb-5">
                            <i class="mdi mdi-plus btn-icon-prepend"></i>Nouveau extra de produit
                        </a>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prix</th>
                                    <th>Date de création</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Situation</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($extras as $extra): ?>
                                    <tr>
                                        <td>
                                            <a href="<?= site_url("admin/extras/show/$extra->id") ?>"><?= $extra->nom ?></a>
                                        </td>
                                        <td>$&nbsp;<?= esc(number_format($extra->prix, 2)) ?></td>
                                        <td><?= $extra->created_at->humanize() ?></td>
                                        <td><?= $extra->slug ?></td>
                                        <td><?= ($extra->actif && $extra->deleted_at == null ? '<label class="badge badge-success">Actif</label>' : '<label class="badge badge-warning">Inactif</label>') ?></td>
                                        <td>
                                            <?= ($extra->deleted_at == null ? '<label class="badge badge-info">Disponible</label>' : '<label class="badge badge-danger">Supprimé</label>') ?>
                                            <?php if ($extra->deleted_at != null): ?>
                                                <a href="<?= site_url("admin/extras/retablirExtra/$extra->id"); ?>"
                                                   class="badge badge-outline-info ml-2"><i class="mdi mdi-undo btn-icon-prepend"></i> Rétablir
                                                    categorie
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
                    url: "<?php echo site_url('admin/extras/rechercher'); ?>",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        if (data.length < 1) {
                            var data = [
                                {
                                    label: 'Categorie not found',
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
                    window.location.href = '<?php echo site_url('admin/extras/show/') ?>' + ui.item.id;
                }
            }
        }); //end autocomplete
    });
</script>

<?php echo $this->endSection() ?>

