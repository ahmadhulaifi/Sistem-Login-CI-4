<?= $this->extend('layout/template_user'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">

                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('pesanError')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('pesanError'); ?>
                    </div>
                <?php endif; ?>


                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Sub Menu</a>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Sub Menu</th>
                                <th scope="col">Menu</th>
                                <th scope="col">URl</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Aktif</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php foreach ($submenu as $sm) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $sm['sub_menu']; ?></td>
                                    <td><?= $sm['menu']; ?></td>
                                    <td><?= $sm['url']; ?></td>
                                    <td><?= $sm['icon']; ?></td>
                                    <td>
                                        <?php
                                        if ($sm['is_active'] = 1) {
                                            echo "yes";
                                        } else {
                                            echo "no";
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <a href="" class="badge badge-success" data-toggle="modal" data-target="#editSubMenuModal<?= $sm['id']; ?>">Edit</a>
                                        <a href="<?= base_url(); ?>/menu/deletesubmenu/<?= $sm['id']; ?>" class="badge badge-danger">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++ ?>

                                <!-- Modal Edit submenu-->
                                <div class="modal fade" id="editSubMenuModal<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSubMenuModalLabel">Edit Submenu</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="<?= base_url('/menu/editsub'); ?>/<?= $sm['id']; ?>" method="POST">
                                                <?= csrf_field(); ?>

                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="submenu" class="col-sm-2 col-form-label">Sub Menu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="submenu" name="submenu" value="<?= $sm['sub_menu']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="validationCustom04" class="col-sm-2 col-form-label">Menu</label>
                                                        <div class="col-sm-10">
                                                            <select class="custom-select" id="validationCustom04" name="menu_id">
                                                                <option disabled value="">Pilih Menu</option>
                                                                <?php foreach ($menu as $me) : ?>
                                                                    <option <?php echo ($me['id'] == $sm['menu_id']) ? 'selected' : ''; ?> value="<?= $me['id']; ?>"><?= $me['menu']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="url" class="col-sm-2 col-form-label">Url</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="url" name="url" value="<?= $sm['url']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm['icon']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                                        <label class="form-check-label" for="is_active">
                                                            Aktif?
                                                        </label>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<!-- Modal Tambah submenu-->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/menu/saveSubmenu'); ?>" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="submenu" class="col-sm-2 col-form-label">Sub Menu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="submenu" name="submenu">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="validationCustom04" class="col-sm-2 col-form-label">Menu</label>
                        <div class="col-sm-10">
                            <select class="custom-select" id="validationCustom04" name="menu_id">
                                <option selected disabled value="">Pilih Menu</option>

                                <?php foreach ($menu as $me) : ?>
                                    <option value="<?= $me['id']; ?>"><?= $me['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-sm-2 col-form-label">Url</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="url" name="url">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="icon" class="col-sm-2 col-form-label">Icon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="icon" name="icon">
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Aktif?
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>