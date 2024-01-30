                <div class="main-panel">
                    <div class="content-wrapper">

                        <form action="/User/insert_userData" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-4 grid-margin">
                                    <div class="card">
                                        <img class="card-img-top" id="image_preview" src="<?= base_url('assets/images/items') ?>/arch.png" alt="profile">
                                        <div class="card-body">

                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm" placeholder="Username" aria-label="Username" name="username" focus required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-sm" placeholder="Email" aria-label="Email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-sm" placeholder="Password" aria-label="Password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="level">

                                                    <option selected disabled>Level</option>

                                                    <?php foreach($level as $data) { ?>

                                                        <option value="<?php echo $data -> id_level ?>"><?php echo ucwords($data -> nama_level) ?></option>

                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="file" class="form-control form-control-sm" placeholder="Profile" aria-label="Profile" name="profile" id="profile_input" accept=".png, .jpeg, .svg, .jpg, .webp">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">Create new account</h4>
                                            <p class="card-description mb-1">Date : <?php $date = new DateTime('now', new DateTimeZone('Asia/Jakarta')) ?> <?php echo $date -> format('l, j F Y, H:i:s A'); ?></p>
                                            <p class="card-description">By : <?php echo ucwords(session() -> username) ?></p>
                                            
                                                <div class="form-row ml-3">

                                                    <div class="col-md-4 form-group">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Nama Depan" name="nama_depan" required>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Nama Belakang" name="nama_belakang">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <select class="form-control form-control-sm" name="jenis_kelamin">

                                                            <option selected disabled>Jenis kelamin</option>
                                                            <option value="laki-laki">Laki-Laki</option>
                                                            <option value="perempuan">Perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="date" class="form-control form-control-sm" name="tanggal_lahir">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Tempat Lahir" name="tempat_lahir">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" class="form-control form-control-sm" placeholder="+62 8XX-XXXX-XXXX" name="nomor_handphone" pattern="8[0-9]{2}-[0-9]{4}-[0-9]{4,5}" maxlength="16">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Alamat" name="alamat">
                                                    </div>
                                                </div>
                                                
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-block btn-success btn-sm font-weight-medium">Create Account</button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </form>

                        <script>

                            document.getElementById("profile_input").onchange = function() {

                                document.getElementById("image_preview").src = URL.createObjectURL(profile_input.files[0]);

                            }

                        </script>