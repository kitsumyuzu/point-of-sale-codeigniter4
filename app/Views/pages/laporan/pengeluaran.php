                <div class="main-panel">
                    <div class="content-wrapper">

                        <?php if (session() -> get('message')) { ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Pengeluaran</strong> <?= session() -> getFlashdata('message') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Data Pengeluaran</h4>
                                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#insert_pengeluaran_modals"><i class="fas fa-sack-dollar mr-2"></i>Tambahkan Pengeluaran</button>
                                        <div class="table-responsive">

                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No.</th>
                                                        <th>Tanggal Pengeluaran</th>
                                                        <th>Jenis Pengeluaran</th>
                                                        <th>Nominal</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data_pengeluaran as $data) {
                                                            $created_date = new DateTime($data['PENGELUARAN_CreatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                            $updated_date = new DateTime($data['PENGELUARAN_UpdatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                            $pengeluaran_date = new DateTime($data['tanggal_pengeluaran']);
                                                    ?>
                                                        <tr style="text-align: center;">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $data['tanggal_pengeluaran'] ? $pengeluaran_date -> format('j F Y') : '-' ?></td>
                                                            <td><?php echo ucwords($data['jenis_pengeluaran']) ?></td>
                                                            <td>Rp. <?php echo number_format($data['nominal_pengeluaran'], 0, ',', ',') ?></td>
                                                            <td>
                                                                <a href="<?= base_url('/Laporan/delete_pengeluaran/'.$data['id_pengeluaran']) ?>">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-trash-can" style="color: #ff0000"></i></button>
                                                                </a>
                                                                <button type="button" class="btn btn-link btn-sm btn-update"
                                                                data-toggle="modal"
                                                                data-target="#update_pengeluaran_modals"
                                                                data-id="<?= $data['id_pengeluaran'] ?>"
                                                                data-tanggal="<?= $data['tanggal_pengeluaran'] ?>"
                                                                data-jenis="<?= $data['jenis_pengeluaran'] ?>"
                                                                data-nominal="<?= $data['nominal_pengeluaran'] ?>">
                                                                <i class="fas fa-square-pen" style="color: #f0ad4e"></i></button>

                                                                <button type="button" class="btn btn-link btn-sm btn-view"
                                                                data-toggle="modal"
                                                                data-target="#view_pengeluaran_modals"
                                                                data-createdat="<?= $data['PENGELUARAN_createdAt'] ? $created_date -> format('l, j F Y, H:i:s A') : 'This data anonymously created' ?>"
                                                                data-updatedat="<?= $data['PENGELUARAN_updatedAt'] ? $updated_date -> format('l, j F Y, H:i:s A') : 'This data hasn\'t been updated' ?>">
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

                            <div class="modal fade" id="insert_pengeluaran_modals" tabindex="-1" role="dialog" aria-labelledby="insert_pengeluaran_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambahkan Supplier</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Laporan/create_pengeluaran/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Tanggal Pengeluaran</label>
                                                    <input type="date" class="form-control" id="tanggal_pengeluaran" name="tanggal_pengeluaran">
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Jenis Pengeluaran</label>
                                                        <input type="text" class="form-control" placeholder="Jenis Pengeluaran" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Nominal</label>
                                                        <input type="number" class="form-control" placeholder="0" id="nominal" name="nominal" min="0" value="0">
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

                            <div class="modal fade" id="update_pengeluaran_modals" tabindex="-1" role="dialog" aria-labelledby="update_pengeluaran_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Perbaruhi Pengeluaran</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Laporan/update_pengeluaran/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id_pengeluaran">
                                                <div class="form-group">
                                                    <label>Tanggal Pengeluaran</label>
                                                    <input type="date" class="form-control" name="tanggal_pengeluaran" id="tanggal_pengeluaran">
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Jenis Pengeluaran</label>
                                                        <input type="text" class="form-control" placeholder="Jenis Pengeluaran" id="jenis_pengeluaran" name="jenis_pengeluaran" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Nominal</label>
                                                        <input type="number" class="form-control" placeholder="0" id="nominal" name="nominal" min="0" value="0">
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

                            <div class="modal fade" id="view_pengeluaran_modals" tabindex="-1" role="dialog" aria-labelledby="view_pengeluaran_modals" aria-hidden="true">
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