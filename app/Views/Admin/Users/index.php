<?php echo $this->extend('Admin/layout/main'); ?>
<?php echo $this->section('title') ?> <?= $title ?> <?php echo $this->endSection() ?>

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
                        <h4 class="card-title"><?= $title ?></h4>

                        <div class="ui-widget">
                            <input id="query" name="query" class="form-control bg-light mb-5">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>E-mail</th>
                                    <th>Driver's Licence</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $user->name ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->driver_licence ?></td>
                                        <td><?= ($user->active ? '<label class="badge badge-success">Active</label>' : '<label class="badge badge-danger">Pending</label>') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
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
<script src="<?= site_url('admin/vendors/auto-complete/jquery-ui.js') ?>"></script>
<script>
    $(function () {
        $("#query").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: "<?php echo site_url('admin/users/find_user'); ?>",
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

