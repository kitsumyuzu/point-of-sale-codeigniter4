                <div class="main-panel">
                    <div class="content-wrapper">

                        <?php if (session() -> get('message')) { ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Pembelian</strong> <?= session() -> getFlashdata('message') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Data Pembelian</h4>
                                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#insert_pengeluaran_modals"><i class="fas fa-truck-fast mr-2"></i>Pembelian Produk</button>
                                        <div class="table-responsive">

                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Supplier</th>
                                                        <th>Stock Pembelian</th>
                                                        <th>Total</th>
                                                        <th>Diskon</th>
                                                        <th>Pembayaran</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data_pembelian as $data) {
                                                            $created_date = new DateTime($data['PMB_CreatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                            $updated_date = new DateTime($data['PMB_UpdatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                    ?>
                                                        <tr style="text-align: center;">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $data['PMB_CreatedAt'] ? $created_date -> format('j F Y') : '-' ?></td>
                                                            <td><?php echo ucwords($data['nama_supplier']) ?></td>
                                                            <td><?php echo $data['total_item'] ?></td>
                                                            <td>Rp. <?php echo number_format($data['total_harga'], 0, ',', ',') ?></td>
                                                            <td><?php echo $data['diskon_produk'] ?></td>
                                                            <td>Rp. <?php echo number_format($data['pembayaran_produk'], 0, ',', ',') ?></td>
                                                            <td>
                                                                <a href="<?= base_url('/Laporan/delete_pengeluaran/'.$data['id_pengeluaran']) ?>">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-trash-can" style="color: #ff0000"></i></button>
                                                                </a>

                                                                <button type="button" class="btn btn-link btn-sm btn-view"
                                                                data-toggle="modal"
                                                                data-target="#view_pengeluaran_modals"
                                                                data-createdat="<?= $data['PEN_CreatedAt'] ? $created_date -> format('l, j F Y, H:i:s A') : 'This data anonymously created' ?>"
                                                                data-updatedat="<?= $data['PEN_UpdatedAt'] ? $updated_date -> format('l, j F Y, H:i:s A') : 'This data hasn\'t been updated' ?>">
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

                            <div class="modal fade" id="insert_pengeluaran_modals" tabindex="-1" role="dialog" aria-labelledby="insert_pengeluaran_modals" aria-modal="true" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fas fa-cart-shopping mr-2"></i>Tambahkan Pembelian</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Laporan/create_pembelian/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <div class="table-responsive">

                                                    <table class="table table-striped">

                                                        <thead>
                                                            <tr style="text-align: center;">
                                                                <th>Nama Supplier</th>
                                                                <th>Nomor Handphone</th>
                                                                <th>Produk</th>
                                                                <th>Harga Pembelian</th>
                                                                <th>Jumlah Produk</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php foreach ($data_restock as $data) { ?>
                                                                <tr style="text-align: center;">
                                                                    <td><?php echo ucwords($data['nama_supplier']) ?></td>
                                                                    <td><?php echo $data['nomor_handphone_supplier'] ?></td>
                                                                    <td><?php echo ucwords($data['nama_produk']) ?></td>
                                                                    <td>Rp. <?php echo number_format($data['harga_pembelian'], 0, ',', ',') ?> / pcs</td>
                                                                    <td class="d-flex justify-content-center">
                                                                        <input class="form-control form-control-sm col-md-8" type="number" name="restock_amount" id="restock_amount" min="0">
                                                                    </td>
                                                                    <td>
                                                                        <a href="<?= base_url('/Laporan/delete_pengeluaran/'.$data['id_pengeluaran']) ?>">
                                                                            <button type="button" class="btn btn-link btn-sm"><i class="fas fa-circle-plus" style="color: #5cb85c"></i></button>
                                                                        </a>
                                                                     </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>

                                                    </table>

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

                        <!-- Start - Modal View data -->

                            <div class="modal fade" id="view_pengeluaran_modals" tabindex="-1" role="dialog" aria-labelledby="view_pengeluaran_modals" aria-hidden="true">
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
                                        $('#update_pengeluaran_modals #id_pengeluaran').val($(this).data('id'));
                                        $('#update_pengeluaran_modals #tanggal_pengeluaran').val($(this).data('tanggal'));
                                        $('#update_pengeluaran_modals #jenis_pengeluaran').val($(this).data('jenis'));
                                        $('#update_pengeluaran_modals #nominal').val($(this).data('nominal'));
                                    });
                                    $(document).on('click', '.btn-view', function() {
                                        $('#view_pengeluaran_modals #date_created').val($(this).data('createdat'));
                                        $('#view_pengeluaran_modals #date_updated').val($(this).data('updatedat'));
                                    });
                                    $(document).on('click', '#btn-close', function() {
                                        $('#insert_pengeluaran_modals #tanggal_pengeluaran').val('');
                                        $('#insert_pengeluaran_modals #jenis_pengeluaran').val('');
                                        $('#insert_pengeluaran_modals #nominal').val('0');
                                    });
                                });

                            </script>

                        <!-- End - Custom Script -->