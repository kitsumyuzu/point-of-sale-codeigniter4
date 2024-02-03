                <div class="main-panel">
                    <div class="content-wrapper">

                        <?php if (session() -> get('message')) { ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Produk</strong> <?= session() -> getFlashdata('message') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Daftar Produk</h4>
                                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#insert_produk_modals"><i class="fas fa-dolly mr-2"></i>Tambahkan Produk</button>
                                        <div class="table-responsive">

                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No.</th>
                                                        <th>Kode Produk</th>
                                                        <th>Nama Produk</th>
                                                        <th>Merk Produk</th>
                                                        <th>Kategori Produk</th>
                                                        <th>Harga Pembelian</th>
                                                        <th>Harga Penjualan</th>
                                                        <th>Diskon Produk</th>
                                                        <th>Stok Produk</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data_produk as $data) {
                                                            $created_date = new DateTime($data['PRODUK_createdAt'], new DateTimeZone('Asia/Jakarta'));
                                                            $updated_date = new DateTime($data['PRODUK_updatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                    ?>

                                                        <tr style="text-align: center;">
                                                            <td><?php echo $no++ ?>.</td>
                                                            <td><?php echo $data['kode_produk'] ? $data['kode_produk'] : 'Kode produk tidak ditemukan' ?></td>
                                                            <td><?php echo $data['nama_produk'] ? ucwords($data['nama_produk']) : 'Produk tidak ditemukan' ?></td>
                                                            <td><?php echo $data['merk_produk'] ? ucwords($data['merk_produk']) : '-' ?></td>
                                                            <td><?php echo $data['kategori_produk'] ? ucwords($data['kategori']) : 'Kategori tidak ditemukan' ?></td>
                                                            <td>Rp. <?php echo $data['harga_pembelian'] ? $data['harga_pembelian'] : '-' ?></td>
                                                            <td>Rp. <?php echo $data['harga_penjualan'] ? $data['harga_penjualan'] : '-' ?></td>
                                                            <td><?php echo $data['diskon_produk'] ? ucwords($data['diskon_produk']) : '0' ?>%</td>
                                                            <td><?php echo $data['stok_produk'] ? ucwords($data['stok_produk']) : 'Habis' ?></td>
                                                            <td>
                                                                <a href="<?= base_url('/Produk/delete_produk/'.$data['id_produk']) ?>">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-trash-can" style="color: #ff0000"></i></button>
                                                                </a>

                                                                <button type="button" class="btn btn-link btn-sm btn-update"
                                                                data-toggle="modal"
                                                                data-target="#update_produk_modals"
                                                                data-id="<?= $data['id_produk']; ?>"
                                                                data-kode="<?= $data['kode_produk']; ?>"
                                                                data-nama="<?= $data['nama_produk']; ?>"
                                                                data-merek="<?= $data['merk_produk']; ?>"
                                                                data-kategori="<?= $data['kategori_produk']; ?>"
                                                                data-beli="<?= $data['harga_pembelian']; ?>"
                                                                data-jual="<?= $data['harga_penjualan']; ?>"
                                                                data-diskon="<?= $data['diskon_produk']; ?>"
                                                                data-stock="<?= $data['stok_produk']; ?>">
                                                                <i class="fas fa-square-pen" style="color: #f0ad4e"></i></button>

                                                                <button type="button" class="btn btn-link btn-sm btn-view"
                                                                data-toggle="modal"
                                                                data-target="#view_barang_modals"
                                                                data-createdat="<?= $data['PRODUK_createdAt'] ? $created_date -> format('l, j F Y, H:i:s A') : 'This data anonymously created' ?>"
                                                                data-updatedat="<?= $data['PRODUK_updatedAt'] ? $updated_date -> format('l, j F Y, H:i:s A') : 'This data hasn\'t been updated' ?>">
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

                            <div class="modal fade" id="insert_produk_modals" tabindex="-1" role="dialog" aria-labelledby="insert_produk_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambahkan Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Produk/create_produk/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label><i class="fas fa-tag mr-2"></i>Kode Produk</label>
                                                    <input type="text" class="form-control" placeholder="Kode Produk" name="kode_produk" value="<?php echo $uniquecode; ?>" readonly>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Nama Produk</label>
                                                        <input type="text" class="form-control" placeholder="Nama Produk" name="nama_produk" id="nama_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Merk Produk</label>
                                                        <input type="text" class="form-control" placeholder="Merk Produk" name="merk_produk" id="merk_produk">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Kategori Produk</label>
                                                        <select class="form-control" name="kategori_produk" id="kategori_produk">

                                                            <option disabled selected>Pilih kategori produk</option>
                                                            <option disabled>--------------------</option>

                                                            <?php

                                                                foreach ($data_kategori as $data) {

                                                            ?>

                                                                <option value="<?php echo $data['id_kategori'] ?>"><?php echo ucwords($data['kategori']) ?></option>

                                                            <?php

                                                                }

                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Harga beli produk</label>
                                                        <input type="number" class="form-control" placeholder="Rp. 0" name="harga_pembelian_produk" min="0" id="harga_pembelian_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Harga jual produk</label>
                                                        <input type="number" class="form-control" placeholder="Rp. 0" name="harga_penjualan_produk" min="0" id="harga_penjualan_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Diskon Produk</label>
                                                        <input type="number" class="form-control" placeholder="0%" name="diskon_produk" min="0" max="100" id="diskon_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Stok Produk</label>
                                                        <input type="number" class="form-control" placeholder="0" name="stok_produk" min="0" id="stok_produk">
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

                            <div class="modal fade" id="update_produk_modals" tabindex="-1" role="dialog" aria-labelledby="update_produk_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Perbaruhi Produk</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Produk/update_produk/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <input type="hidden" class="form-control" name="id" id="id_produk">
                                                <div class="form-group">
                                                    <label><i class="fas fa-tag mr-2"></i>Kode Produk</label>
                                                    <input type="text" class="form-control" id="kode_produk" placeholder="Kode Produk" readonly>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Nama Produk</label>
                                                        <input type="text" class="form-control" id="nama_produk" placeholder="Nama Produk" name="nama_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Merk Produk</label>
                                                        <input type="text" class="form-control" id="merk_produk" placeholder="Merk Produk" name="merk_produk">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Kategori Produk</label>
                                                        <select class="form-control" name="kategori_produk" id="kategori_produk">

                                                            <option disabled selected>Pilih kategori produk</option>
                                                            <option disabled>--------------------</option>

                                                            <?php

                                                                foreach ($data_kategori as $data) {

                                                            ?>

                                                                <option value="<?php echo $data['id_kategori'] ?>"><?php echo ucwords($data['kategori']) ?></option>

                                                            <?php

                                                                }

                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Harga beli produk</label>
                                                        <input type="number" class="form-control" placeholder="Rp. 0" name="harga_pembelian_produk" min="0" id="harga_pembelian_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Harga jual produk</label>
                                                        <input type="number" class="form-control" placeholder="Rp. 0" name="harga_penjualan_produk" min="0" id="harga_penjualan_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Diskon Produk</label>
                                                        <input type="number" class="form-control" placeholder="0%" name="diskon_produk" min="0" max="100" id="diskon_produk">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Stok Produk</label>
                                                        <input type="number" class="form-control" placeholder="0" name="stok_produk" min="0" id="stok_produk">
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

                            <div class="modal fade" id="view_barang_modals" tabindex="-1" role="dialog" aria-labelledby="view_barang_modals" aria-hidden="true">
                                <div class="modal-dialog" role="document">

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
                                        $('#update_produk_modals #id_produk').val($(this).data('id'));
                                        $('#update_produk_modals #kode_produk').val($(this).data('kode'));
                                        $('#update_produk_modals #nama_produk').val($(this).data('nama'));
                                        $('#update_produk_modals #merk_produk').val($(this).data('merek'));
                                        $('#update_produk_modals #kategori_produk').val($(this).data('kategori'));
                                        $('#update_produk_modals #harga_penjualan_produk').val($(this).data('jual'));
                                        $('#update_produk_modals #harga_pembelian_produk').val($(this).data('beli'));
                                        $('#update_produk_modals #diskon_produk').val($(this).data('diskon'));
                                        $('#update_produk_modals #stok_produk').val($(this).data('stock'));
                                    });
                                    $(document).on('click', '.btn-view', function() {
                                        $('#view_barang_modals #date_created').val($(this).data('createdat'));
                                        $('#view_barang_modals #date_updated').val($(this).data('updatedat'));
                                    });
                                    $(document).on('click', '#btn-close', function() {
                                        $('#insert_produk_modals #nama_produk').val('');
                                        $('#insert_produk_modals #merk_produk').val('');
                                        $('#insert_produk_modals #kategori_produk').val('Pilih kategori produk');
                                        $('#insert_produk_modals #harga_penjualan_produk').val('');
                                        $('#insert_produk_modals #harga_pembelian_produk').val('');
                                        $('#insert_produk_modals #diskon_produk').val('');
                                        $('#insert_produk_modals #stok_produk').val('');
                                    })
                                });

                            </script>

                        <!-- End - Custom Script -->