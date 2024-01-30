                <div class="main-panel">
                    <div class="content-wrapper">

                        <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Daftar Penjualan</h4>
                                        <button type="button" class="btn btn-link btn-sm"><i class="fas fa-cart-shopping mr-2"></i>Tambahkan Penjualan</button>
                                        <div class="table-responsive">
                                            <table class="table table-striped">

                                                <thead>
                                                    <tr style="text-align: center;">
                                                        <th>No.</th>
                                                        <th>Tanggal</th>
                                                        <th>Kode Member</th>
                                                        <th>Jumlah Penjualan</th>
                                                        <th>Total Harga</th>
                                                        <th>Diskon Penjualan</th>
                                                        <th>Total Pembayaran</th>
                                                        <th>Kasir</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $no = 1;
                                                    
                                                        foreach ($penjualan_data as $data) {

                                                    ?>

                                                        <tr style="text-align: center;">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $data -> tanggal ?></td>
                                                            <td><?php echo $data -> kode_member ?> </td>
                                                            <td><?php echo $data -> jumlah_penjualan ?></td>
                                                            <td><?php echo $data -> total_harga_penjualan ?></td>
                                                            <td><?php echo $data -> diskon_penjualan ?>%</td>
                                                            <td><?php echo $data -> total_pembayaran ?></td>
                                                            <td><?php echo ucwords($data -> username) ?></td>
                                                            <td>
                                                                <a href="">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-trash-can" style="color: #ff0000"></i></button>
                                                                </a>
                                                                <a href="">
                                                                    <button type="button" class="btn btn-link btn-sm"><i class="fas fa-square-pen" style="color: #f0ad4e"></i></button>
                                                                </a>
                                                            </td>
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