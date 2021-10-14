        <div id="bottomLeft" style="left: 24px; bottom: 25px; z-index:10">
            <a href="#z" data-toggle="tab" class="btn btn-info btn-lg bS" style="background-color:#0066cc; color:white">Tambah Aset</a>
            <a href="#d" data-toggle="tab" class="btn btn-info btn-lg bS" style="background-color:#9900ff; color:white">Cetak Letter C</a>
        </div>
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
                  <?php ?> 


                    <?php 
                    require_once ('assets/phpqrcode/qrlib.php');
                   
                    foreach ($warga as $ws): ?>
                        <div class="panel panel-info">
                            <div class="panel-heading">Nomor C</div>
                            <div class="panel-body" id="cAsal">
                                <?php echo $ws['warga_id']; ?>
                            </div>
                            <div class="panel-heading">Nama</div>
                            <div class="panel-body">
                                <?php echo $ws['nama']; ?>
                            </div>
                            <div class="panel-heading">Alamat</div>
                            <div class="panel-body">
                                <?php echo $ws['alamat']; ?>
                            </div>
                        </div>
                    <?php 
                     $qrisi = $ws['warga_id']."-".$ws['nama']."-".$ws['alamat']."";
                 QRcode::png($qrisi,"qr".$ws['warga_id'].".png","M", 2,2);
                endforeach; ?>
                <img src='qr<?php echo $ws['warga_id'];?>.png'><br>
                
                </div>
                <div class="col-md-9" style="float:right">
                    <ul class="nav nav-tabs">
                        <!--<li onclick="reseter()"><a href="#z" data-toggle="tab" style="background-color:#0066cc; color: white">Tambah Aset</a></li>
                        <li onclick="reseter()" style="float:right"><a href="#d" data-toggle="tab" style="background-color:#9900ff; color:white">Cetak Letter C</a></li>-->

                        <li onclick="reseter()" ><a href="#e" data-toggle="tab">Galeri</a></li>
                        <li onclick="reseter()" ><a href="#b" data-toggle="tab" id="as">Data Aset</a></li>
                        <li onclick="reseter()" ><a href="#c" data-toggle="tab">Petikan Aset</a></li>
                        <li onclick="reseter()" class="active" ><a href="#a" data-toggle="tab">Periwayatan Tanah</a></li>
                    </ul>

                    <div class="tab-content" id="children">
                        <div class="tab-pane" id="z" style="margin-top:-10.5px; margin-bottom:-30px">
                        <form id="WAform">
                        <h3 style="text-align:center; font-weight: bold; margin-bottom: 5px;">TAMBAH ASET TANAH</h3>
                        <?php
                            $pageIt = "aset";
                            include_once('rePage/tambahSplit.php'); ?>
                        </form>
                        </div>
                        <div class="tab-pane active" id="a">
                            <?php include_once('rePage/tabRiwayatAset.php'); ?>
                        </div>
                    
                        <div class="tab-pane" id="b">
                            <table class="table table-bordered table-striped" id="tabAset">
                                <thead>
                                    <tr>
                                        <th style="width:15%">Persil</th>
                                        <th style="width:15%">Kelas</th>
                                        <th style="width:18%">Luas (m)</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(count($aset)>0){
                                foreach ($aset as $as):
                                    if($as['petikan_id'] == ''){
                                ?>
                                    <tr >
                                        <td style="text-align:center; color:blue; font-weight:bold; cursor:pointer; vertical-align:middle" onclick="window.location='base.php?page=riwayat&q=<?php echo $as['asal_id']?>'"><?php echo $as['persil']; ?></td>
                                        <td style="text-align:center; vertical-align:middle"><?php echo $as['kelas']; ?></td>
                                        <td style="text-align:center; vertical-align:middle"><?php echo $as['luas']; ?></td>
                                        <td style="text-align:center; vertical-align:middle">
                                            <div class="btn-group">
                                               <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <strong>Pindahkan Aset</strong> <span class="caret"></span>
                                                    </button>
                                                        <ul class="dropdown-menu" style="right:0; min-width: 100px">
                                                            <li onclick="getForm(<?php echo $as['aset_id'] ?>,'convert');"><a href="#">Ke Nomor C</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li onclick="getForm(<?php echo $as['aset_id'] ?>,'petikan');"><a href="#">Ke Petikan</a></li>
                                                        </ul>
                                            </div>
                                            
                                            <div class="btn-group">
                                               <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <strong>Cetak Surat</strong> <span class="caret"></span>
                                                    </button>
                                                        <ul class="dropdown-menu" style="right:0; min-width: 150px">
                                                            <li onclick="getForm(<?php echo $as['aset_id'] ?>,'suhi');"><a href="#">Surat Hibah</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li onclick="getForm(<?php echo $as['aset_id'] ?>,'suju');"><a href="#">Surat Jual-Beli</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li onclick="getForm(<?php echo $as['aset_id'] ?>,'super');"><a href="#">Surat Pernyataan</a></li>
                                                        </ul>
                                            </div><!--
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <strong>Cetak Surat</strong> <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" style="min-width: 100px;">
                                                    <li><a href="#">Pernyataan</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="#">Jual/Beli</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="#">Hibah</a></li>
                                                </ul>
                                            </div>-->
                                            <button type="button" class="btn btn-danger" onclick="getForm(<?php echo $as['aset_id'] ?>,'update');"><strong>Perbaiki Data Aset</strong></button>
                                        </td>
                                    </tr>
                                <?php } endforeach;
                                }else{
                                ?>
                                <tr><td style="text-align:center" colspan=4>Tidak Ada Catatan Aset</td></tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div id="insetForm" style="display:none;"></div>
                        </div>

                        <div class="tab-pane" id="c">
                        
                            <table class="table table-bordered table-striped" id="tabAsetPet">
                                <thead>
                                    <tr>
                                        <th style="width:18%">Nama</th>
                                        <th>Alamat</th>
                                        <th style="width:120px">Luas (m)</th>
                                        <th style="width:80px">Persil</th>
                                        <th style="width:80px">Kelas</th>
                                        <th style="width:35%">#</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                <?php
                                if(count($petikan)>0){
                                foreach ($petikan as $ptk): ?>
                                    <tr>
                                        <td style="vertical-align:middle"><?php echo $ptk['nama']; ?></td>
                                        <td style="vertical-align:middle"><?php echo $ptk['alamat']; ?></td>
                                        <td style="text-align:center; vertical-align:middle"><?php echo $ptk['luas']; ?></td>
                                        <td style="text-align:center;color:blue; font-weight:bold; cursor:pointer; vertical-align:middle" onclick="window.location='base.php?page=riwayat&q=<?php echo $ptk['asal_id'];?>'"><?php echo $ptk['persil']; ?></td>
                                        <td style="text-align:center; vertical-align:middle"><?php echo $ptk['kelas']; ?></td>
                                        <td style="text-align:center">
                                            <div class="btn-group">
                                               <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <strong> Cetak Surat</strong> <span class="caret"></span>
                                                    </button>
                                                        <ul class="dropdown-menu" style="right:0; min-width: 150px">
                                                            <li onclick="getFormpet(<?php echo $ptk['aset_id'] ?>,'suhi','<?php echo $ptk['nama'].'space'.$ptk['petikan_id'] ;?>');"><a href="#">Surat Hibah</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li onclick="getFormpet(<?php echo $ptk['aset_id'] ?>,'suju','<?php echo $ptk['nama'].'space'.$ptk['petikan_id'] ;?>');"><a href="#">Surat Jual-Beli</a></li>
                                                            <li role="separator" class="divider"></li>
                                                            <li onclick="getFormpet(<?php echo $ptk['aset_id'] ?>,'super','<?php echo $ptk['nama'].'space'.$ptk['petikan_id'] ;?>');"><a href="#">Surat Pernyataan</a></li>
                                                        </ul>
                                            </div>
                                            <button type="button" class="btn btn-danger" onclick="getFormpet(<?php echo $ptk['aset_id'] ;?>,'petikan-p','<?php echo $ptk['nama'].'space'.$ptk['petikan_id'] ;?>');"><strong>Pindah ke petikan</strong></button>
                                        </td>
                                    </tr>                                   
                                <?php endforeach; 
                                }else{
                                    ?>
                                    <tr><td style="text-align:center" colspan=6>Tidak Ada Catatan Petikan</td></tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div id="insetFormPet" style="display:none;"></div>
                        </div>
                        <div class="tab-pane" id="d" style="margin-top:-10.5px; margin-bottom:-30px">
                            <iframe src="domba.php?q=<?php echo $q ?>" title="Letter C digital" style="width:100%; height:430px;"></iframe>
                            <!--<embed src="domba.php?q=<?php //echo $q ?>" type="application/pdf" height="99%" width="100%" />-->
                        </div>
                        <div class="tab-pane" id="e" style="text-align:center;">
                            <div class="gallery">
                            <?php foreach ($images as $img): ?>
		                        <a href="<?php echo $img['img'] ?>" data-fancybox>
			                        <img src="<?php echo $img['img'] ?>" alt="first">
                                </a>
                            <?php endforeach ?>               
                            <form method="POST" id="uploadImg" enctype="multipart/form-data" class="form-file">
                                <input type="file" class="inputfile" name="imagin" id="img1" onchange="readURL(this);"  multiple />
                                <input type="hidden" class="inputfile" name="idImg" value="<?php echo $q ?>" />
                                <button type="submit" value="Submit" style="visibility:hidden" id="submitImg"></button>
                                <label for="img1">
                                    <figure>
                                        <i class="glyphicon glyphicon-send" style="font-size:75px; margin-bottom: 3px; color:#669999; margin-left:-15px "></i>
                                    </figure>
                                    <span class="file-button" id="err" >Upload Foto<br>(max. 1mb)</span>
                                    <!--<span class="file-button" id="prog" >
                                        <div class="progress" style="display:none; margin-top:15px; margin-bottom:0">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 100%">
                                            </div>
                                        </div>
                                    </span>-->
                                </label>
                            </form>
	                        </div>                            
                        </div>
                    </div>                    
                </div>
            </div>
        <script>
        
            /*lightbox.option({
                "albumLabel" : "Gambar %1 dari %2",
                "wrapAround" : true
            });*/
// Step 1/3 - Create template for the button
// =========================================
$.fancybox.defaults.btnTpl.print = '<button data-fancybox-print class="fancybox-button fancybox-button--print" title="Print">' +
  '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129"><path d="m10.5,105h22.9v13.5c0,2.3 1.8,4.1 4.1,4.1h54c2.3,0 4.1-1.8 4.1-4.1v-13.5h22.9c2.3,0 4.1-1.8 4.1-4.1v-72.8c0-2.3-1.8-4.1-4.1-4.1h-22.9v-13.5c0-2.3-1.8-4.1-4.1-4.1h-54c-2.3,0-4.1,1.8-4.1,4.1v13.5h-22.9c-2.3,0-4.1,1.8-4.1,4.1v72.8c0,2.2 1.9,4.1 4.1,4.1zm76.9,9.4h-45.8v-33.8h45.8v33.8zm-45.8-99.8h45.8v9.4h-45.8v-9.4zm-27,17.6h22.9 54 22.9v64.6h-18.8v-16.2h7.3c2.3,0 4.1-1.8 4.1-4.1s-1.8-4.1-4.1-4.1h-11.4-54-11.3c-2.3,0-4.1,1.8-4.1,4.1s1.8,4.1 4.1,4.1h7.3v16.2h-18.9v-64.6z"/<path d="m86.2,53.3h10.6c2.3,0 4.1-1.8 4.1-4.1s-1.8-4.1-4.1-4.1h-10.6c-2.3,0-4.1,1.8-4.1,4.1s1.8,4.1 4.1,4.1z"/></svg>' +
  '</button>';

// Step 2/3 - Make button clickable
// ================================
$('body').on('click', '[data-fancybox-print]', function() {
  /*function printElement(e) {
    var ifr = document.createElement('iframe');
    //ifr.style='height: 0px; width: 0px; position: absolute'
    document.body.appendChild(ifr);

    $(e).clone().appendTo(ifr.contentDocument.body);
    ifr.contentWindow.print();

    ifr.parentElement.removeChild(ifr);
  }

  var instance = $.fancybox.getInstance();
  if (instance) {
    printElement(instance.current.$content)
  }*/
  var win=null;
  var content = $('.fancybox-content');
    win = window.open("width=200,height=200");
      self.focus();
      win.document.open();
      win.document.write('<'+'html'+'><'+'head'+'><'+'style'+'>');
      win.document.write('body, td { font-family: Verdana; font-size: 10pt;}');
      win.document.write('<'+'/'+'style'+'><'+'/'+'head'+'><'+'body'+'>');
      win.document.write(content.html());
      win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
    //  win.document.close();
      win.print();
    //  win.close();
});


// Step 3/3 - Customize options
// ============================
$( '[data-fancybox]' ).fancybox({
  toolbar : true,
  smallBtn : false,
  buttons : [
    'print',
    'close'
  ]
});
            function readURL(input) {
                var filePath = $("#img1").val();
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
              
                if (!allowedExtensions.exec(filePath)) { 
                    $("#err").html("Gagal !!<br>File Salah");
                    return false; 
                }  
                if (input.files && input.files[0]) {
                    const size = (input.files[0].size / 1024 / 1024).toFixed(2);
                    if (size > 1) {
                        $("#err").html("Gagal !!<br>File > 1mb");
                    }else{
                        $('#submitImg').trigger('click'); 
                    }                 
                }
            }
            $("#uploadImg").on('submit',(function(e) {
                e.preventDefault();
		        $.ajax({
        	        url: "trigger.php?s=bolob",
			        type: "POST",
			        data:  new FormData(this),
			        contentType: false,
    	            cache: false,
                    processData:false,
			        success: function(data)
		            {
                        $(".gallery").prepend(data);
                        
		            }      
	            });
	        }));
            function display(id,nm,al){
                var nm1 = nm.split("-");
                var nm2 = nm1.length;
                var nm3 = String.fromCharCode(39);
                var namabaru = "" ;
                for(i=0;i<nm2-1;i++){

                    namabaru = namabaru + String.fromCharCode(nm1[i]) ;
                }
             
                document.getElementById('nc').value = id;
                document.getElementById('nm').value = namabaru ;
                document.getElementById('al').value = al;
                document.getElementById("search").style.display="none";
            }
            function getResult(str) {
                if (str.length==0) {
                    document.getElementById("search").style.display="none";
                    document.getElementById('nm').value = "";
                    document.getElementById('al').value = "";
                    return;
                }
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                        document.getElementById("search").style.display="block";
                        document.getElementById("livesearch").innerHTML=this.responseText;
                    }
                }
                var val = $(".filter:checked").val();
                xmlhttp.open("GET","liveSearch.php?p=0&q="+str+"&f=warga_id",true);
                xmlhttp.send();
            }
            function getForm(aId,pg){
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                        document.getElementById("insetForm").style.display="block";
                        document.getElementById("tabAset").style.display="none";
                        document.getElementById("insetForm").innerHTML=this.responseText;
                        $('.aKelas').inputmask("9{1,5}");
                        $('.aLuas').inputmask("9{1,10}");
                        $('#tgl').inputmask("dd-mm-yyyy", {
                            "placeholder": "__-__-____",
                            onincomplete: function() {
                                $(this).val('');
                            }
                        });
                        $('#tgl1').inputmask("dd-mm-yyyy", {
                            "placeholder": "__-__-____",
                            onincomplete: function() {
                                $(this).val('');
                            }
                        });
                    }
                }
                
                var desaku = <?php echo json_encode($desaku); ?> ;
                var kepala = <?php echo json_encode($kepala); ?> ;
                var kab = <?php echo json_encode($kab); ?> ;
                xmlhttp.open("GET","child.php?form="+pg+"&ref="+aId+"&des="+desaku+"&kep="+kepala+"&kab="+kab,true);
                xmlhttp.send();
            }
            function getFormpet(aId,pg,petid){
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                        document.getElementById("insetFormPet").style.display="block";
                        document.getElementById("tabAsetPet").style.display="none";
                        document.getElementById("insetFormPet").innerHTML=this.responseText;
                        $('.aKelas').inputmask("9{1,5}");
                        $('.aLuas').inputmask("9{1,10}");
                        $('#tgl').inputmask("dd-mm-yyyy", {
                            "placeholder": "__-__-____",
                            onincomplete: function() {
                                $(this).val('');
                            }
                        });
                    }
                }
                var desaku = <?php echo json_encode($desaku); ?> ;
                var kepala = <?php echo json_encode($kepala); ?> ;
                var kab = <?php echo json_encode($kab); ?> ;
                
                xmlhttp.open("GET","child.php?form="+pg+"&ref="+aId+"&petid="+petid+"&des="+desaku+"&kep="+kepala+"&kab="+kab,true);
                xmlhttp.send();
            }
            function destroy(){
                document.getElementById("insetForm").style.display="none";
                document.getElementById("insetFormPet").style.display="none";
                document.getElementById("insetForm").innerHTML = '';
                document.getElementById("insetFormPet").innerHTML = '';
                document.getElementById("tabAset").style.display="table";
                document.getElementById("tabAsetPet").style.display="table";
            }
            function submited(sbm){
                if(sbm !== 'upd'){
                    if(!validate()) return false;
                }
                var asal_id = $('#asal_id').val();
                var aset_id = $('#aset_id').val();
                var warga_id = "<?php echo $q ?>";
                var petasal = $('#petasal').val();

                var aPersil = $('#aPer').val();
                var aKategori = $('#aKat').val();
                var aKelas = $('#aKel').val();;
                var aLuas = $('#aLu').val();

                var nc = $('#nc').val();
                var nm = $('#nm').val();
                var al = $('#al').val();
                var sb = $('#sb').val();
                var tgl = $('#tgl').val();

                var nPersil = [];
                var nKategori = [];
                var nKelas = [];
                var nLuas = [];

                $('.aPersil').each(function(){
                    nPersil.push($(this).val());
                });
                $('.aKategori').each(function(){
                    nKategori.push($(this).val());
                });
                $('.aKelas').each(function(){
                    nKelas.push($(this).val());
                });
                $('.aLuas').each(function(){
                    nLuas.push($(this).val());
                });
                
                var dataArray;
                switch(sbm){
                    case "upd":
                        dataArray = {asal_id:asal_id, aset_id:aset_id, aKategori:aKategori, aKelas:aKelas, aLuas:aLuas, aPersil:aPersil, warga_id:warga_id};
                        
                        break;
                    case "cnv":
                        dataArray = {asal_id:asal_id, aset_id:aset_id, cAsal:warga_id, nc:nc, nm:nm, al:al, aPersil:aPersil, aKategori:aKategori, aKelas:aKelas, aLuas:aLuas, sb:sb, tgl:tgl};
                        break;
                    case "aset":
                        dataArray = {wNoC:warga_id, nPersil:nPersil, nKategori:nKategori, nKelas:nKelas, nLuas:nLuas};
                        break;
                    case "pet":
                        dataArray = {asal_id:asal_id, aset_id:aset_id, cAsal:warga_id, nm:nm, al:al, aPersil:aPersil, aKategori:aKategori, aKelas:aKelas, aLuas:aLuas, sb:sb, tgl:tgl, petasal:petasal};
                        break;
                    case "petC":
                        dataArray = {asal_id:asal_id, aset_id:aset_id, cAsal:warga_id, nc:nc, nm:nm, al:al, aPersil:aPersil, aKategori:aKategori, aKelas:aKelas, aLuas:aLuas, sb:sb, tgl:tgl, petasal:petasal};
                        break;
                }

                $.ajax({
                    url:"trigger.php?s="+sbm,
                    method:"POST",
                    data:dataArray,
                    success: function(response){
                        //alert(response);
                        window.location='base.php?page=profiling&q='+warga_id+'&r=1';
                    }
                });/**/

                
    }

        </script>
    </body>
</html>
