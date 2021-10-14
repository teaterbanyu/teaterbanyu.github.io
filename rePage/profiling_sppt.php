       
        <script>
        $(document).ready(function(){
            var ref = "<?php echo $r ?>";
            if(ref == 1){
                $('#as').trigger('click');
            }
            $('.aKelas').inputmask("9{1,5}");
            $('.aLuas').inputmask("9{1,10}");
        });
        $('.bS').on('click', function () {
            $('.nav-tabs li').removeClass('active');
        });
        </script>
            <div class="row">
                <div class="col-md-3" style="height:100%; overflow-x: hidden; position:fixed">
                    <h2 style="text-align: center; font-weight:bold"> DATA PERSONAL</h2>
                    <?php foreach ($Sppt as $ws): ?>
                        <div class="panel panel-info">
                            <div class="panel-heading">Tahun : <?php echo $ws['tahun']; ?></div>
                           
                            <div class="panel-body">Nop :  <?php echo $ws['nop']; ?></div>
                            
                            <div class="panel-heading">No induk :   <?php echo $ws['no_induk']; ?></div>
                         
                            <div class="panel-body">Nama Wp :  <?php echo $ws['nama_wp']; ?></div>
                        
                            <div class="panel-heading">Alamat Wp : <?php echo $ws['alamat_wp']; ?></div>
                          
                            <div class="panel-body">Alamat Op :  <?php echo $ws['alamat_op']; ?></div>
                            <div class="panel-heading">Pajak : <?php echo $ws['pajak_t']; ?></div>
                           
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-9" style="float:right">
                   

                   
                        <div class="tab-pane" id="b">
                            <table class="table table-bordered table-striped" id="tabAset">
                                <thead>
                                    <tr>
                                        <th style="width:15%">Nop</th>
                                        <th style="width:15%">Perubahan</th>
                                        <th style="width:20%">Tahun</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(count($riwayatSppt)>0){
                                foreach ($riwayatSppt as $as):
                                   
                                ?>
                                    <tr>
                                        <td style="text-align:center; vertical-align:middle"><?php echo $as['nop']; ?></td>
                                        <td style="text-align:center; vertical-align:middle"><?php echo $as['perubahan']; ?></td>
                                        <td style="text-align:center; vertical-align:middle"><?php echo $as['tahun']; ?></td>
                                     
                                    </tr>
                                <?php  endforeach;
                                }else{
                                ?>
                                <tr><td style="text-align:center" colspan=4>Tidak Ada Catatan Aset</td></tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div id="insetForm" style="display:none;"></div>
                        </div>

                                   
                        </div>
                    </div>                    
                </div>
            </div>
      
    </body>
</html>