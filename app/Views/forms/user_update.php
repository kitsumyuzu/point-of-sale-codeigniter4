                <div class="main-panel">
                    <div class="content-wrapper">

                    <?php if ($karyawanData -> _level == '1') { ?> 

                        <form action="/User/update_userData" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-4 grid-margin">
                                    <div class="card">
                                        <img class="card-img-top" id="image_preview" src="<?= base_url('assets/images/'.($karyawanData -> profile ? $karyawanData -> profile : 'arch.png')) ?>" alt="profile">
                                        <div class="card-body">

                                            <input type="hidden" name="userId" value="<?php echo $karyawanData -> id_user ?>">
                                            <input type="hidden" name="userDiD" value="<?php echo $karyawanData -> _user ?>">
                                            <input type="hidden" name="userProfile" value="<?php echo $karyawanData -> profile ?>">

                                            <div class="form-group">
                                                <input type="text" value="<?php echo $karyawanData -> username ?>" class="form-control form-control-sm" placeholder="Username" aria-label="Username" name="username" focus required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" value="<?php echo $karyawanData -> email ?>" class="form-control form-control-sm" placeholder="Email" aria-label="Email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="level">

                                                    <option selected disabled>Level</option>

                                                    <?php foreach($level as $data) { ?>

                                                        <option value="<?php echo $data -> id_level ?>" <?php echo $karyawanData -> _level == $data -> id_level ? 'selected' : '' ?>><?php echo ucwords($data -> nama_level) ?></option>

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
                                                        <input type="text" value="<?php echo $karyawanData -> nama_depan ?>" class="form-control form-control-sm" placeholder="Nama Depan" name="nama_depan" required>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" value="<?php echo $karyawanData -> nama_belakang ?>" class="form-control form-control-sm" placeholder="Nama Belakang" name="nama_belakang">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <select class="form-control form-control-sm" name="jenis_kelamin">

                                                            <option selected disabled>Jenis kelamin</option>
                                                            <option value="laki-laki" <?php echo $karyawanData -> jenis_kelamin == 'laki-laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                                            <option value="perempuan" <?php echo $karyawanData -> jenis_kelamin == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="date" value="<?php echo $karyawanData -> tanggal_lahir ?>" class="form-control form-control-sm" name="tanggal_lahir">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" value="<?php echo $karyawanData -> tempat_lahir ?>" class="form-control form-control-sm" placeholder="Tempat Lahir" name="tempat_lahir">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" value="<?php echo substr($karyawanData -> no_handphone, 4) ?>" class="form-control form-control-sm" placeholder="+62 8XX-XXXX-XXXX" name="nomor_handphone" pattern="8[0-9]{2}-[0-9]{4}-[0-9]{4,5}" maxlength="16">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <input type="text" value="<?php echo $karyawanData -> alamat ?>" class="form-control form-control-sm" placeholder="Alamat" name="alamat">
                                                    </div>
                                                </div>
                                                
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-block btn-success btn-sm font-weight-medium">Update Account</button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </form>

                    <?php } else if ($karyawanData -> _level == '2') { ?>

                        <form action="/User/update_userData" method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-lg-4 grid-margin">
                                    <div class="card">
                                        <img class="card-img-top" id="image_preview" src="<?= base_url('assets/images/'.($pelangganData -> profile ? $pelangganData -> profile : 'arch.png')) ?>" alt="profile">
                                        <div class="card-body">

                                            <input type="hidden" name="userId" value="<?php echo $pelangganData -> id_user ?>">
                                            <input type="hidden" name="userDiD" value="<?php echo $pelangganData -> _user ?>">
                                            <input type="hidden" name="userProfile" value="<?php echo $pelangganData -> profile ?>">

                                            <div class="form-group">
                                                <input type="text" value="<?php echo $pelangganData -> username ?>" class="form-control form-control-sm" placeholder="Username" aria-label="Username" name="username" focus required>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" value="<?php echo $pelangganData -> email ?>" class="form-control form-control-sm" placeholder="Email" aria-label="Email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control form-control-sm" name="level">

                                                    <option selected disabled>Level</option>

                                                    <?php foreach($level as $data) { ?>

                                                        <option value="<?php echo $data -> id_level ?>" <?php echo $pelangganData -> _level == $data -> id_level ? 'selected' : '' ?>><?php echo ucwords($data -> nama_level) ?></option>

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
                                                        <input type="text" value="<?php echo $pelangganData -> nama_depan ?>" class="form-control form-control-sm" placeholder="Nama Depan" name="nama_depan" required>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" value="<?php echo $pelangganData -> nama_belakang ?>" class="form-control form-control-sm" placeholder="Nama Belakang" name="nama_belakang">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <select class="form-control form-control-sm" name="jenis_kelamin">

                                                            <option selected disabled>Jenis kelamin</option>
                                                            <option value="laki-laki" <?php echo $pelangganData -> jenis_kelamin == 'laki-laki' ? 'selected' : '' ?>>Laki-Laki</option>
                                                            <option value="perempuan" <?php echo $pelangganData -> jenis_kelamin == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="date" value="<?php echo $pelangganData -> tanggal_lahir ?>" class="form-control form-control-sm" name="tanggal_lahir">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" value="<?php echo $pelangganData -> tempat_lahir ?>" class="form-control form-control-sm" placeholder="Tempat Lahir" name="tempat_lahir">
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <input type="text" value="<?php echo substr($pelangganData -> no_handphone, 4) ?>" class="form-control form-control-sm" placeholder="+62 8XX-XXXX-XXXX" name="nomor_handphone" pattern="8[0-9]{2}-[0-9]{4}-[0-9]{4,5}" maxlength="16">
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <input type="text" value="<?php echo $pelangganData -> alamat ?>" class="form-control form-control-sm" placeholder="Alamat" name="alamat">
                                                    </div>
                                                </div>
                                                
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-block btn-success btn-sm font-weight-medium">Update Account</button>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </form>

                    <?php } ?>

                        <script>

                            document.getElementById("profile_input").onchange = function() {

                                document.getElementById("image_preview").src = URL.createObjectURL(profile_input.files[0]);

                            }

                        </script>