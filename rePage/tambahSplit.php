                        <table id="aset" class="table table-bordered table-condensed" style="margin-bottom:5px">
                        <thead>
                            <tr>
                                <th style="width:75px">Nama</th>
                                <th style="width:150px">Divisi</th>
                                <th style="width:100px">Judul Karya</th>
                                <th style="width:175px">No Wa</th>
                            </tr>
                        </thead>
                        <tbody id="asetBody">
                            <tr>
                                <td style="padding:0"><input class="inputCell itemReq aPersil" type="text" placeholder="Capitalized Case" onkeyup='this.value=toTitleCase(this.value)'></td>
                                <td style="padding:0">
                                    <select class="inputCell itemReq aKategori" style="padding: 3.5px 0;">
                                        <option></option>
                                        <option>AKTOR</option>
                                        <option>RUPA</option>
                                        <option>TARI</option>
                                        <option>MUSIK</option>
                                        <option>MEDIA</option>
                                    </select>
                                </td>
                                <td style="padding:0"><input class="inputCell itemReq aKelas" type="text" ></td>
                                <td style="padding:0"><input class="inputCell itemReq aLuas" type="text"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align:center">
                        <p style="margin:0; font-size: 14px" class="text-warning">**Kelas Tanah Cukup Diisi Dengan Angka.</p>
                        <br>
                        <button class="btn btn-success" type="button" onclick="onPlus()"><strong>Tambah Baris</strong></button>
                        <button class="btn btn-default" type="button" onclick="reseter()"><strong>Reset</strong></button>
                       
                    </div>