                <div class="main-panel">
                    <div class="content-wrapper">

                        <?php if (session() -> get('message')) { ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Supplier</strong> <?= session() -> getFlashdata('message') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Daftar Supplier</h4>
                                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#insert_supplier_modals"><i class="fas fa-id-card-clip mr-2"></i>Tambahkan Supplier</button>
                                        <div class="table-responsive">

                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No.</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Alamat</th>
                                                        <th>Nomor Handphone</th>
                                                        <th>Produk</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data_supplier as $data) {
                                                            $created_date = new DateTime($data['SUPPLIER_createdAt'], new DateTimeZone('Asia/Jakarta'));
                                                            $updated_date = new DateTime($data['SUPPLIER_updatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                    ?>
                                                        <tr style="text-align: center;">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo ucwords($data['nama_supplier']) ?></td>
                                                            <td><?php echo ucwords($data['alamat_supplier']) ?></td>
                                                            <td><?php echo ucwords($data['nomor_handphone_supplier']) ?></td>
                                                            <td><?php echo ucwords($data['merk_produk']) . ' - ' . ucwords($data['nama_produk']) ?></td>
                                                            <td>
                                                                <a href="<?= base_url('/Home/delete_supplier/'.$data['id_supplier']) ?>">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-trash-can" style="color: #ff0000"></i></button>
                                                                </a>
                                                                <button type="button" class="btn btn-link btn-sm btn-update"
                                                                data-toggle="modal"
                                                                data-target="#update_supplier_modals"
                                                                data-id="<?= $data['id_supplier'] ?>"
                                                                data-produk="<?= $data['produk_supplier'] ?>"
                                                                data-nama="<?= $data['nama_supplier'] ?>"
                                                                data-alamat="<?= $data['alamat_supplier'] ?>"
                                                                data-nohp="<?= substr($data['nomor_handphone_supplier'], 4) ?>">
                                                                <i class="fas fa-square-pen" style="color: #f0ad4e"></i></button>

                                                                <button type="button" class="btn btn-link btn-sm btn-view"
                                                                data-toggle="modal"
                                                                data-target="#view_member_modals"
                                                                data-createdat="<?= $data['SUPPLIER_createdAt'] ? $created_date -> format('l, j F Y, H:i:s A') : 'This data anonymously created' ?>"
                                                                data-updatedat="<?= $data['SUPPLIER_updatedAt'] ? $updated_date -> format('l, j F Y, H:i:s A') : 'This data hasn\'t been updated' ?>">
                                                                <i class="fas fa-eye" style="color: #5bc0de"></i></button>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Start - Modal Create data -->

                            <div class="modal fade" id="insert_supplier_modals" tabindex="-1" role="dialog" aria-labelledby="insert_supplier_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambahkan Supplier</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Home/create_supplier/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Nama Supplier</label>
                                                        <input type="text" class="form-control" placeholder="Nama Supplier" id="nama_supplier" name="nama_supplier" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control" placeholder="Alamat" id="alamat_supplier" name="alamat_supplier">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nomor Handphone</label>
                                                        <input type="text" class="form-control" placeholder="+62 8XX-XXXX-XXXX" id="nomor_handphone_supplier" name="nomor_handphone_supplier" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Produk</label>
                                                        <select class="form-control" name="produk" id="produk" required>

                                                            <option disabled selected>Pilih produk</option>
                                                            <option disabled>--------------------</option>

                                                            <?php

                                                                foreach ($data_produk as $data) {

                                                            ?>

                                                                <option value="<?php echo $data['id_produk'] ?>"><?php echo $data['kode_produk'] . ' - ' . ucwords($data['nama_produk']) ?></option>

                                                            <?php

                                                                }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"><i class="fas fa-check mr-2"></i>Save</button>
                                                <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" data-dismiss="modal" id="btn-close"><i class="fas fa-xmark mr-2"></i>Cancel</button>
                                            </div>

                                        </form>

                                    </div>

                                </div>
                            </div>

                        <!-- End - Modal Create data -->

                        <!-- Start - Modal Update data -->

                            <div class="modal fade" id="update_supplier_modals" tabindex="-1" role="dialog" aria-labelledby="update_supplier_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Perbaruhi Supplier</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Home/update_supplier/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id_supplier">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Nama Supplier</label>
                                                        <input type="text" class="form-control" placeholder="Nama Supplier" id="nama_supplier" name="nama_supplier" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control" placeholder="Alamat" id="alamat_supplier" name="alamat_supplier">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nomor Handphone</label>
                                                        <input type="text" class="form-control" placeholder="+62 8XX-XXXX-XXXX" id="nomor_handphone_supplier" name="nomor_handphone_supplier" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Produk</label>
                                                        <select class="form-control" name="produk" id="produk" required>

                                                            <option disabled selected>Pilih produk</option>
                                                            <option disabled>--------------------</option>

                                                            <?php

                                                                foreach ($data_produk as $data) {

                                                            ?>

                                                                <option value="<?php echo $data['id_produk'] ?>"><?php echo $data['kode_produk'] . ' - ' . ucwords($data['nama_produk']) ?></option>

                                                            <?php

                                                                }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center"><i class="fas fa-check mr-2"></i>Save</button>
                                                <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" data-dismiss="modal"><i class="fas fa-xmark mr-2"></i>Cancel</button>
                                            </div>

                                        </form>

                                    </div>

                                </div>
                            </div>

                        <!-- End - Modal Update data -->

                        <!-- Start - Modal View data -->

                            <div class="modal fade" id="view_member_modals" tabindex="-1" role="dialog" aria-labelledby="view_member_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="date-created"><i class="far fa-calendar mr-2"></i>Created Date</label>
                                                <input type="text" class="form-control" id="date_created" placeholder="Date Created" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="date-updated"><i class="far fa-calendar mr-2"></i>Updated Date</label>
                                                <input type="text" class="form-control" id="date_updated" placeholder="Date Updated" readonly>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger btn-sm d-flex align-items-center" data-dismiss="modal"><i class="fas fa-xmark mr-2"></i>Cancel</button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        <!-- End - Modal View data -->

                        <!-- Start - Custom Script -->
                        
                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

                            <script>

                                $(document).ready(function () {
                                    $(document).on('click', '.btn-update', function() {
                                        $('#update_supplier_modals #produk').val($(this).data('produk'));
                                        $('#update_supplier_modals #id_supplier').val($(this).data('id'));
                                        $('#update_supplier_modals #nama_supplier').val($(this).data('nama'));
                                        $('#update_supplier_modals #alamat_supplier').val($(this).data('alamat'));
                                        $('#update_supplier_modals #nomor_handphone_supplier').val($(this).data('nohp'));
                                    });
                                    $(document).on('click', '.btn-view', function() {
                                        $('#view_member_modals #date_created').val($(this).data('createdat'));
                                        $('#view_member_modals #date_updated').val($(this).data('updatedat'));
                                    });
                                    $(document).on('click', '#btn-close', function() {
                                        $('#insert_supplier_modals #produk').val('Pilih produk');
                                        $('#insert_supplier_modals #nama_supplier').val('');
                                        $('#insert_supplier_modals #alamat_supplier').val('');
                                        $('#insert_supplier_modals #nomor_handphone_supplier').val('');
                                    });
                                });

                            </script>

                        <!-- End - Custom Script -->