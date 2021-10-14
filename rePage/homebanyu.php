            <div class="row" style="margin-top: 75px">
                <div class="col-md-8 col-md-offset-2">
                    <div style="text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 10px;">
                        Cari Berdasarkan :  
                        <label class="radio-inline" style="font-weight: bold; font-size: 18px; margin-left:30px;">
                            <input type="radio" name="filter" class="filter custom-radio" id="inlineRadio1" value="warga_id" checked> Nomor C
                        </label>
                        <label class="radio-inline" style="font-weight: bold; font-size: 18px; margin-left:40px;">
                            <input type="radio" name="filter" class="filter custom-radio" id="inlineRadio2" value="nama" > Nama 
                        </label>
                        <label class="radio-inline" style="font-weight: bold; font-size: 18px; margin-left:40px;">
                            <input type="radio" name="filter" class="filter custom-radio" id="inlineRadio3" value="persil"> Persil
                        </label>
                    </div>
                    <div class="input-group input-group-lg">
                        <input id="searching" type="text" class="form-control" placeholder="Form Pencarian Data Letter C. . ." onkeyup="showResult(this.value);" aria-describedby="sizing-addon1">
                        <span class="input-group-addon glyphicon glyphicon-search" aria-hidden="true" id="sizing-addon1"></span>
                    </div>
                    
                    <div id="search" style="padding:10px 12px 10px 5px; margin-top: -10px; position:absolute; width: calc(100% - 70px); z-index:1; display:none">
                        <div id="livesearch" style="padding:0;background-color: white;"></div>
                    </div>
                </div><!-- /.col-md-8 -->
            </div><!-- /.row -->
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-10 col-md-offset-1" style="text-align:center;">
                    <button class="btn btn-info btn-lg" type="button" onclick="window.location='base.php?page=warga'"><strong>Data Letter C</strong></button>
                    <!--<button class="btn btn-info btn-lg" type="button" onclick="window.location='base.php?page=petikan'"><strong>Data Petikan C</strong></button>-->
                    <button class="btn btn-info btn-lg" type="button" onclick="window.location='base.php?page=persil'"><strong>Data Aset Tanah</strong></button>
                    <button class="btn btn-success btn-lg"  type="button" onclick="window.location='base.php?page=populate'"><strong>Statistik Tanah</strong></button>
                </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <div class="col-md-10 col-md-offset-1" style="text-align:center;">
                    <button class="buttonPlus" type="button" onclick="location.href = './base.php?page=tambahkan';"><span style="font-size:32px; margin-bottom: 3px" class="glyphicon glyphicon-plus" aria-hidden="true"></span><br><strong>TAMBAH DATA</strong></button>
                </div>
            </div>
        
<script>
$('input[type="radio"][name=filter]').change(function() {
    $('#searching').val('');
    document.getElementById("search").style.display="none";
});
function showResult(str) {
  if (str.length==0) {
    document.getElementById("search").style.display="none";
    return;
  }
  var val = $(".filter:checked").val();
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
        document.getElementById("search").style.display="block";
        document.getElementById("livesearch").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","liveSearch.php?p=1&q="+str+"&f="+val,true);
  xmlhttp.send();
}
</script>