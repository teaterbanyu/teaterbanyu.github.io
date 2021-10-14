<div class="preloader" id="dataLoad" style="display:none; background-color: rgb(255, 255, 255, 0.8">
    <div class="loading">
        <div class="spinner">
		    <div class="dot1"></div>
		    <div class="dot2"></div>
	    </div>
        <h3><strong>Memproses Data</strong></h3>
        <h3 style="margin-top:0"><span id="process_data">0</span> / <span id="total_data">0</span> Baris</h3>
        
    </div>
</div>
            <form id="WAform">
                <div class="col-md-4" style="margin-top: 50px">

                    <p style="margin:0; font-size: 14px" class="text-danger">*Nomor C, Nama, dan Alamat wajib Diisi !</p>                  
                </div>
                <div class="col-md-8">
                    <h3 style="text-align:center; font-weight: bold; margin-bottom: 5px;">DATA ASET TANAH</h3>
                    <?php 
                        $pageIt = "new";
                        include_once('rePage/tambahSplit.php'); 
                    ?>
                </div>
                <button class="btn btn-primary" type="button" onclick="submited('<?php echo $pageIt; ?>')"><strong>Simpan Data</strong></button>
            </form>
            <div id="bottomLeft" style="left: 50px">
                <button data-toggle="modal" data-target="#excel" class="btn btn-info" style="background-color:#9900ff; color:white; width: 300px">Unggah Excel</button>
                <!--<button data-toggle="modal" data-target="#database" class="btn btn-info" style="background-color:#9900ff; color:white">Unggah Database</button>-->
            </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="/*transform:translate(0,50%);*/">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom:0">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h1 class="modal-title text-center"><strong id="msg"></strong></h1>
      </div>
      <div class="modal-footer" id="foot"></div>
    </div>

  </div>
</div>

<!-- Modal Data Duplikat -->
<div id="dataDuplikat" class="modal fade" role="dialog">
  <div class="modal-dialog" style="/*transform:translate(0,50%);*/">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom:0">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 style="margin-top: 0"> Gagal Memproses <span id="duplikasi" style="font-weight:bold">0</span> Data : </h2>
      </div>
      <div class="modal-body" style="padding: 10px 15px;">
      
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width ="30%"> Nomor C</th>
                <th> Nama</th>
            </tr>
            </thead>
            <tbody id="datadub"></tbody>
        </table>
        <p> Silahkan periksa kembali dan pastikan untuk <b>menghapus data yang sudah berhasil diproses</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal"><strong>Oke!</strong></button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="excel" class="modal fade" role="dialog">
  <div class="modal-dialog" style="/*transform:translate(0,50%);*/">
    <!-- Modal content-->
    <form class="form-file" id="formExcel" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom:0">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title"><strong id="jdl"></strong></h2>
      </div>
      <div class="modal-body text-center">
        <input type="file" class="inputfile" name="excel" id="exl" onchange="readFile(this.value,'1');" multiple />
        <label for="exl" style="margin-bottom: -10px">
            <figure>
                <i class="glyphicon glyphicon-file" style="font-size:75px; margin-bottom: 10px; color:#669999; margin-left:5px "></i>
            </figure>
            <span class="file-button" id="imp1" >UPLOAD DATA EXCEL</span>
        </label>
            <h4 style="margin-top:20px; margin-bottom:-10px" id="fileName1">Tidak Ada File Yang Dipilih</h4>
      </div>
      <div class="modal-footer" id="fExcImport" style="padding-top:0">
        <button type="button" class="btn btn-info betonan" style="float:left;" data-dismiss="modal"><strong>Batal</strong></button>
        <button type="submit" class="btn btn-success betonan"><strong>Import</strong></button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- Modal -->
<div id="database" class="modal fade" role="dialog">
  <div class="modal-dialog" style="/*transform:translate(0,50%);*/">
    <!-- Modal content-->
    <form class="form-file" id="formDatabase" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header" style="padding-bottom:0">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <input type="file" class="inputfile" name="dbs" id="dbs" onchange="readFile(this.value,'2');" multiple />
        <label for="dbs" style="margin-bottom: -10px">
            <figure>
                <i class="glyphicon glyphicon-file" style="font-size:75px; margin-bottom: 10px; color:#669999; margin-left:5px "></i>
            </figure>
            <span class="file-button" >UPLOAD DATABASE</span>
            </label>
            <h4 style="margin-top:20px; margin-bottom:-10px" id="fileName2">Tidak Ada File Yang Dipilih</h4>
      </div>
      <div class="modal-footer" id="fDbImport" style="padding-top:0">
        <button type="button" class="btn btn-info betonan" style="float:left;" data-dismiss="modal"><strong>Batal</strong></button>
        <button type="submit" class="btn btn-success betonan"><strong>Import</strong></button>
      </div>
    </div>
    </form>
  </div>
</div>
        <script>
            function readFile(f,g){
                $("#fileName"+g).html(f);
            }
            var clear_timer;
            $("#formExcel").on('submit',(function(e) {
                e.preventDefault();
		        $.ajax({
        	        url: "importir.php?s=excel",
			        type: "POST",
			        data:  new FormData(this),
                    dataType:"json",
			        contentType: false,
    	            cache: false,
                    processData:false,
                    beforeSend:function(){
                        $('#excel').modal('hide');
                        $('#dataLoad').show();
                    },
			        success: function(data){
                        //console.log(data);
                        if(data.success){
                            $('#total_data').html(data.total_line);
                            start_import();
                            clear_timer = setInterval(get_import_data, 1000);                        
                        }
                        if(data.error){
                            $('#dataLoad').hide();
                            $('#myModal').modal('show');
                            $('#msg').html('MAAF, TERJADI KESALAHAN tai !!');
                            $('#foot').html('<h2 style="text-align:center; margin-top:0">'+data.error+'</h2>');
                        }
                    },
                    complete: function () {
                        $('#formExcel')[0].reset(); // this will reset the form fields
                        $('#fileName1').html('Tidak Ada File Yang Dipilih');
                    }
	            });
	        }));
            function start_import(){
			    $.ajax({
				    url:"importir.php?s=progExcel",
                    dataType:"json",
				    success:function(echoing){
                        var galat = echoing.dno;
                        var tableGalat = document.getElementById('datadub');
                        tableGalat.innerHTML = "";
                        for(g=0; g<galat.length; g++){
                            var row = tableGalat.insertRow(-1);
                            var htm = "<td style='text-align:center'>"+galat[g][0]+"</td><td>"+galat[g][1]+"</td>";
                            row.innerHTML = htm;
                            
                        }
                       $('#duplikasi').html(echoing.duplikat);

                    }
			    });
		    }
            function get_import_data(){
                console.log("x"+clear_timer);
                var total_data = $('#total_data').text();
                var dup = $('#duplikasi').text();
			    $.ajax({
				    url:"importir.php?s=getCount&d="+dup+"&c=<?php echo $asetCount ?>",
                    dataType:"json",
				    success:function(data){
                        console.log(clear_timer);
					    var width = Math.round((data.proc/total_data)*100);
					    $('#process_data').html(data.proc);
                        var msx, fbt;
					    if(width >= 100){
                            
                            clearInterval(clear_timer);
                            console.log("z"+clear_timer);
                            $('#dataLoad').fadeOut();
                            if(data.duplikasi == 0){
                                $('#myModal').modal('show');
                                $('#msg').html('Total '+data.proc+' Data<br> Berhasil Diproses');
                                $('#foot').html('<button type="button" class="btn btn-info" data-dismiss="modal"><strong>Oke!</strong></button>');
                            }else{
                                $('#dataDuplikat').modal('show');
                            }
						    
						    
                            
					    }
				    }
			    })
		    }
            $("#formDatabase").on('submit',(function(e) {
                e.preventDefault();
		        $.ajax({
        	        url: "importir.php?s=dbs",
			        type: "POST",
			        data:  new FormData(this),
                    dataType:"json",
			        contentType: false,
    	            cache: false,
                    processData:false,
                    beforeSend:function(){
                        $('#excel').modal('hide');
                        $('#dataLoad').show();
                    },
			        success: function(data){
                        if(data.error){
                            $('#dataLoad').hide();
                            $('#myModal').modal('show');
                            $('#msg').html('MAAF, TERJADI KESALAHAN !!');
                            $('#foot').html('<h2 style="text-align:center; margin-top:0">'+data.error+'</h2>');
                        }
                    },
                    complete: function(){
                        $('#formDatabase')[0].reset(); // this will reset the form fields
                        $('#fileName2').html('Tidak Ada File Yang Dipilih');
                        $('#dataLoad').fadeOut();
                        $('#myModal').modal('show');
                        $('#msg').html('Data Berhasil Diproses');
                        $('#foot').html('<button type="button" class="btn btn-info" data-dismiss="modal"><strong>Oke!</strong></button>');
                    }
	            });/**/
	        }));

            function submited(sbm){
                if(!validate()) return false;
                

                var aPersil = [];
                var aKategori = [];
                var aKelas = [];
                var aLuas = [];

                $('.aPersil').each(function(){
                    aPersil.push($(this).val());
                });
                $('.aKategori').each(function(){
                    aKategori.push($(this).val());
                });
                $('.aKelas').each(function(){
                    aKelas.push($(this).val());
                });
                $('.aLuas').each(function(){
                    aLuas.push($(this).val());
                });
                //console.log(wNoC);
                //console.log(aTgl);

                $.ajax({
                    url:"trigger.php?s="+sbm,
                    method:"POST",
                    data:{ aPersil:aPersil, aKategori:aKategori, aKelas:aKelas, aLuas:aLuas},
                    beforeSend: function(){
                        // Show image container
                        $("#loadIt").show();
                    },
                    success: function(response){
                        $('#myModal').modal('show');
                        //$('#msg').html(response);
                        if(response == 0){
                            $('.modal-content').css('background-color','#e6ecff');
                            $('#msg').html('PENGOLAHAN DATA BERHASIL');
                            $('#foot').html('<button type="button" class="btn btn-info" style="float:left;" data-dismiss="modal"><strong>Tambah Data Lagi</strong></button>');
                            reseter();
                        }else{
                            $('.modal-content').css('background-color','#ffe6e6');
                            if(response == 1){
                                $('#msg').html('GAGAL MENGOLAH DATA');
                                $('#foot').html('<h2 style="text-align:center; margin-top:0">Nomor C Sudah Tersedia, Mohon Periksa Kembali !</h2>');
                            }else{
                                $('#msg').html('MAAF, TERJADI KESALAHAN !!');
                                $('#foot').html('<h2 style="text-align:center; margin-top:0">Mohon Segera Hubungi Pengembang</h2>');
                            
                            }
                        }
                        
                    },
                    complete:function(){
                    // Hide image container
                        $("#loadIt").hide();
                    }
                });/**/
            }
        </script>