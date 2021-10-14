<h3 style="text-align:center;"><strong><?php echo $title ?></strong></h3>
<table class="table table-bordered table-striped">
    <tr>
        <th style="width:75px">Persil</th>
        <th style="width:150px">Kategori</th>
        <th style="width:100px">Kelas</th>
        <th style="width:175px">Luas (m)</th>
    </tr>
<?php foreach ($tabForm as $ua): 
    $kelas = filter_var($ua['kelas'], FILTER_SANITIZE_NUMBER_INT);?>
    <tr>
        <td style="padding:0">
            <input class="inputCell" id="aPer" type="text" value="<?php echo $ua['persil']; ?>">
            <input id="aset_id" type="text" value="<?php echo $ua['aset_id']; ?>" hidden>
            <input id="warga_id" type="text" value="<?php echo $ua['warga_id']; ?>" hidden>
            <input id="asal_id" type="text" value="<?php echo $ua['asal_id']; ?>" hidden>
        </td>
        <td style="padding:0">
            <select class="inputCell" id="aKat" style="padding: 3.5px 0;">
                <option <?php if($ua['kategori'] == 'KERING') echo"selected"; ?>>KERING</option>
                <option <?php if($ua['kategori'] == 'BASAH') echo"selected"; ?>>BASAH</option>
            </select>
        </td>
        <td style="padding:0">
            <input class="inputCell aKelas" id="aKel" type="text" value="<?php echo $kelas; ?>">
        </td>
        <td style="padding:0">
            <input class="inputCell aLuas" id="aLu" type="text" value="<?php echo $ua['luas']; ?>">
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<div style="text-align:center">
    <button type="button" class="btn btn-default" onclick="destroy();"><strong>Kembali</strong></button>
    <button style="margin-left:20px" type="button" class="btn btn-primary" onclick="submited('<?php echo $sbm; ?>');"><strong>Simpan</strong></button>
</div>
