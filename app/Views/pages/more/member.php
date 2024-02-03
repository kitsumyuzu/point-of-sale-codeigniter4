                <div class="main-panel">
                    <div class="content-wrapper">

                        <?php if (session() -> get('message')) { ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Member</strong> <?= session() -> getFlashdata('message') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        <?php } ?>

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Daftar Member</h4>
                                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#insert_member_modals"><i class="fas fa-id-card-clip mr-2"></i>Tambahkan Member</button>
                                        <div class="table-responsive">

                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No.</th>
                                                        <th>Kode Member</th>
                                                        <th>Nama Member</th>
                                                        <th>Alamat</th>
                                                        <th>Nomor Handphone</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data_member as $data) {
                                                            $created_date = new DateTime($data['MEMBER_createdAt'], new DateTimeZone('Asia/Jakarta'));
                                                            $updated_date = new DateTime($data['MEMBER_updatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                    ?>
                                                        <tr style="text-align: center;">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $data['kode_member'] ?></td>
                                                            <td><?php echo ucwords($data['nama_member']) ?></td>
                                                            <td><?php echo ucwords($data['alamat_member']) ?></td>
                                                            <td><?php echo ucwords($data['nomor_handphone_member']) ?></td>
                                                            <td>
                                                                <a href="<?= base_url('/Home/delete_member/'.$data['id_member']) ?>">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-trash-can" style="color: #ff0000"></i></button>
                                                                </a>
                                                                <button type="button" class="btn btn-link btn-sm btn-update"
                                                                data-toggle="modal"
                                                                data-target="#update_member_modals"
                                                                data-id="<?= $data['id_member'] ?>"
                                                                data-kode="<?= $data['kode_member'] ?>"
                                                                data-nama="<?= $data['nama_member'] ?>"
                                                                data-alamat="<?= $data['alamat_member'] ?>"
                                                                data-nohp="<?= substr($data['nomor_handphone_member'], 4) ?>">
                                                                <i class="fas fa-square-pen" style="color: #f0ad4e"></i></button>

                                                                <button type="button" class="btn btn-link btn-sm btn-view"
                                                                data-toggle="modal"
                                                                data-target="#view_member_modals"
                                                                data-createdat="<?= $data['MEMBER_createdAt'] ? $created_date -> format('l, j F Y, H:i:s A') : 'This data anonymously created' ?>"
                                                                data-updatedat="<?= $data['MEMBER_updatedAt'] ? $updated_date -> format('l, j F Y, H:i:s A') : 'This data hasn\'t been updated' ?>">
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

                            <div class="modal fade" id="insert_member_modals" tabindex="-1" role="dialog" aria-labelledby="insert_member_modals" aria-hidden="true">
                                <div class="modal-dialog" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambahkan Member</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Home/create_member/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label><i class="fas fa-tag mr-2"></i>Kode Member</label>
                                                    <input type="text" class="form-control" placeholder="Kode Member" name="kode_member" value="<?php echo $uniquecode; ?>" readonly>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Nama Member</label>
                                                        <input type="text" class="form-control" placeholder="Nama Member" name="nama_member" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control" placeholder="Alamat" name="alamat_member">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nomor Handphone</label>
                                                        <input type="text" class="form-control" placeholder="+62 8XX-XXXX-XXXX" name="nomor_handphone_member" required>
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

                            <div class="modal fade" id="update_member_modals" tabindex="-1" role="dialog" aria-labelledby="update_member_modals" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Perbaruhi Member</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/Home/update_member/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                <input type="hidden" id="id_member" name="id">
                                                <div class="form-group">
                                                    <label><i class="fas fa-tag mr-2"></i>Kode Member</label>
                                                    <input type="text" class="form-control" placeholder="Kode Member" id="kode_member" name="kode_member" readonly>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label>Nama Member</label>
                                                        <input type="text" class="form-control" placeholder="Nama Member" id="nama_member" name="nama_member" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Alamat</label>
                                                        <input type="text" class="form-control" placeholder="Alamat" id="alamat_member" name="alamat_member">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Nomor Handphone</label>
                                                        <input type="text" class="form-control" placeholder="+62 8XX-XXXX-XXXX" id="nomor_handphone_member" name="nomor_handphone_member" required>
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
                                        $('#update_member_modals #id_member').val($(this).data('id'));
                                        $('#update_member_modals #kode_member').val($(this).data('kode'));
                                        $('#update_member_modals #nama_member').val($(this).data('nama'));
                                        $('#update_member_modals #alamat_member').val($(this).data('alamat'));
                                        $('#update_member_modals #nomor_handphone_member').val($(this).data('nohp'));
                                    });
                                    $(document).on('click', '.btn-view', function() {
                                        $('#view_member_modals #date_created').val($(this).data('createdat'));
                                        $('#view_member_modals #date_updated').val($(this).data('updatedat'));
                                    });
                                    $(document).on('click', '#btn-close', function() {
                                        $('#insert_member_modals #kode_member').val('');
                                        $('#insert_member_modals #nama_member').val('');
                                        $('#insert_member_modals #alamat_member').val('');
                                        $('#insert_member_modals #nomor_handphone_member').val('');
                                    });
                                });

                            </script>

                        <!-- End - Custom Script -->