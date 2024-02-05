                <div class="main-panel">
                    <div class="content-wrapper">

                        <?php if (session() -> get('message')) { ?>

                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>User</strong> <?= session() -> getFlashdata('message') ?>
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
                                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#insert_user_modals"><i class="fas fa-user-plus mr-2"></i>Tambahkan User</button>
                                        <div class="table-responsive">

                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No.</th>
                                                        <th>Profile</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Level</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;
                                                        foreach ($data_user as $data) {
                                                            $created_date = new DateTime($data['USER_createdAt'], new DateTimeZone('Asia/Jakarta'));
                                                            $updated_date = new DateTime($data['USER_updatedAt'], new DateTimeZone('Asia/Jakarta'));
                                                    ?>
                                                        <tr style="text-align: center;">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><img src="<?php echo base_url('assets/images/'.($data['_profile'] ? $data['_profile'] : 'default-profile.png')) ?>" alt="profile"></td>
                                                            <td><?php echo $data['username'] ?></td>
                                                            <td><?php echo $data['email'] ?></td>
                                                            <td><?php echo ucwords($data['level']) ?></td>
                                                            <td>
                                                                <a href="<?= base_url('/User/delete_user/'.$data['id_user']) ?>">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-trash-can" style="color: #ff0000"></i></button>
                                                                </a>
                                                                <button type="button" class="btn btn-link btn-sm btn-update"
                                                                data-toggle="modal"
                                                                data-target="#update_user_modals"
                                                                data-id="<?= $data['id_user'] ?>"
                                                                data-userprofile="<?= $data['_profile'] ?>"
                                                                data-profile="<?= $data['_profile'] ?>"
                                                                data-username="<?= $data['username'] ?>"
                                                                data-email="<?= $data['email'] ?>">
                                                                <i class="fas fa-square-pen" style="color: #f0ad4e"></i></button>

                                                                <button type="button" class="btn btn-link btn-sm btn-view"
                                                                data-toggle="modal"
                                                                data-target="#view_user_modals"
                                                                data-createdat="<?= $data['USER_createdAt'] ? $created_date -> format('l, j F Y, H:i:s A') : 'This data anonymously created' ?>"
                                                                data-updatedat="<?= $data['USER_updatedAt'] ? $updated_date -> format('l, j F Y, H:i:s A') : 'This data hasn\'t been updated' ?>">
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

                            <div class="modal fade" id="insert_user_modals" tabindex="-1" role="dialog" aria-labelledby="insert_user_modals" aria-hidden="true">
                                <div class="modal-dialog" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambahkan User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/User/create_user/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                
                                                <div class="row">
                                                    <div class="form-group col-md-8">
                                                        <label>Profile Picture</label>
                                                        <input type="file" class="form-control" name="profile" id="profile_upload">
                                                    </div>
                                                    <div class="form-group col-md-4 d-flex align-items-center justify-content-center">
                                                        <img alt="profile" style="width: 60px; height: 60px;" id="image-preview" src="<?php echo base_url('assets/images') ?>/default-profile.png">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Email</label>
                                                        <input type="email" class="form-control" placeholder="E-mail" id="email" name="email">
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label>Confirm Password</label>
                                                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required>
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

                            <div class="modal fade" id="update_user_modals" tabindex="-1" role="dialog" aria-labelledby="update_user_modals" aria-hidden="true">
                                <div class="modal-dialog" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Perbaharui User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="/User/update_user/" method="post" enctype="multipart/form-data">

                                            <div class="modal-body">
                                                
                                                <div class="row">
                                                    <input type="hidden" class="form-control" name="id" id="id_user">
                                                    <input type="hidden" class="form-control" name="userprofile" id="user_profile">
                                                    <div class="form-group col-md-8">
                                                        <label>Profile Picture</label>
                                                        <input type="file" class="form-control" name="profile" id="profile_upload">
                                                    </div>
                                                    <div class="form-group col-md-4 d-flex align-items-center justify-content-center">
                                                        <img src="<?php echo base_url('assets/images') ?>/default-profile.png" alt="profile" style="width: 60px; height: 60px;" id="image-preview">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" placeholder="E-mail" id="email" name="email">
                                                    </div>
                                                
                                                    <button type="button" class="btn btn-danger btn-sm ml-3" data-toggle="modal" data-target="#reset_password_modals"><i class="fas fa-key mr-2"></i>Reset Password</button> 
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

                        <!-- End - Modal Update data -->

                        <!-- Start - Modal View data -->

                            <div class="modal fade" id="view_user_modals" tabindex="-1" role="dialog" aria-labelledby="view_user_modals" aria-hidden="true">
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
                                        $('#update_user_modals #id_user').val($(this).data('id'));
                                        $('#update_user_modals #user_profile').val($(this).data('userprofile'));
                                        $('#update_user_modals #username').val($(this).data('username'));
                                        $('#update_user_modals #email').val($(this).data('email'));
                                    });
                                    $(document).on('click', '.btn-view', function() {
                                        $('#view_user_modals #date_created').val($(this).data('createdat'));
                                        $('#view_user_modals #date_updated').val($(this).data('updatedat'));
                                    });
                                    $(document).on('click', '#btn-close', function() {
                                        $('#insert_user_modals #username').val('');
                                        $('#insert_user_modals #email').val('');
                                        $('#insert_user_modals #password').val('');
                                        $('#insert_user_modals #confirm_password').val('');
                                    });
                                });

                            </script>

                            <script>

                                document.addEventListener('DOMContentLoaded', function() {

                                    var password = document.getElementById('password');
                                    var confirm_password = document.getElementById('confirm_password');

                                    function validatePassword() {

                                        if (password.value != confirm_password.value) {

                                            confirm_password.setCustomValidity('Please make sure its the correct password');

                                        } else {

                                            confirm_password.setCustomValidity('');

                                        }

                                    }

                                    password.addEventListener('change', validatePassword);
                                    confirm_password.addEventListener('keyup', validatePassword);

                                });

                                document.getElementById('profile_upload').onchange = function() {

                                    document.getElementById('image-preview').src = URL.createObjectURL(profile_upload.files[0])

                                }

                            </script>

                        <!-- End - Custom Script -->