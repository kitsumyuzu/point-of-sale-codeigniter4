                <div class="main-panel">
                    <div class="content-wrapper">

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Karyawawn Data</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>#</th>
                                                        <th>Nama Depan</th>
                                                        <th>Nama Belakang</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Tanggal Lahir</th>
                                                        <th>Tempat Lahir</th>
                                                        <th>No. Handphone</th>
                                                        <th>Alamat</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;

                                                        foreach($pelanggandata as $data) {
                                                        
                                                    ?>

                                                        <tr style="text-align: center;">

                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $data -> nama_depan ? ucwords($data -> nama_depan) : 'none' ?></td>
                                                            <td><?php echo $data -> nama_belakang ? ucwords($data -> nama_belakang) : 'none' ?></td>
                                                            <td><?php echo $data -> jenis_kelamin ? ucwords($data -> jenis_kelamin) : 'none' ?></td>
                                                            <td><?php echo $data -> tanggal_lahir ? ucwords($data -> tanggal_lahir) : 'none' ?></td>
                                                            <td><?php echo $data -> tempat_lahir ? ucwords($data -> tempat_lahir) : 'none' ?></td>
                                                            <td><?php echo $data -> no_handphone ? ucwords($data -> no_handphone) : 'none' ?></td>
                                                            <td><?php echo $data -> alamat ? ucwords($data -> alamat) : 'none' ?></td>
                                                            
                                                        </tr>
                                                        
                                                    <?php } ?>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>