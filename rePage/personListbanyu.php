            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                <h1 style="text-align:center; text-decoration:underline"><strong><?php echo $title; ?></strong></h1>
                    <table class="table table-bordered table-striped table-hocer">
                        <thead>
                            <tr>
                                <th style="width:20%">NIT</th>
                                <th style="width:30%">Nama</th>
                                <th style="width:30%">Divisi</th>
                                <th style="width:30%">Alamat</th>
                                <th>No wa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(count($tables)>0){
                        foreach ($tables as $tb): ?>
                            <tr style="cursor:pointer" onclick="window.location='base.php?page=profiling&q=<?php echo $tb['warga_id']?>&r=0'">
                                <td style="text-align:center;"><?php echo $tb['nit']; ?></td>
                                <td><?php echo $tb['nama']; ?></td>
                                <td><?php echo $tb['divisi']; ?></td>
                                <td><?php echo $tb['alamat']; ?></td>
                                <td><?php echo $tb['nomor_wa']; ?></td>
                            </tr>
                        <?php endforeach;
                        }else{
                        ?>
                            <tr><td style="text-align:center" colspan=4>Tidak Ada Catatan Letter C</td></tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>