<?php

namespace App;

/**
 * SQLite Create Table Demo
 */
class SQLiteQuerySelect
{
  /**
   * PDO object
   * @var \PDO
   */
  private $pdo;

  /**
   * connect to the SQLite database
   */
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  //get aktif
  public function getAkt()
  {
    $stmt =  $this->pdo->query("SELECT aktif from Akode");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "aktif" => $row["aktif"],
      ];
    }

    return $tables;
  }

  public function getAkt1()
  {
    $stmt =  $this->pdo->query("SELECT aktif from coba");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "aktif" => $row["aktif"],
      ];
    }

    return $tables;
  }

  public function getseri($ak){

    //baca id hardisk

 

    $kilab = $ak;
   
    //insert unik ke coba


    $idh8=(substr($kilab, 0, 9));//diambil 7
    $arr = str_split($idh8);//pecah per huruf

    $hur1 = ord($arr[0]);
    $hur2 = ord($arr[1]);
    $hur3 = ord($arr[2]);
    $hur4 = ord($arr[3]);
    $hur5 = ord($arr[4]);
    $hur6 = ord($arr[5]);
    $hur7 = ord($arr[6]);
    $hur8 = ord($arr[7]);
    $hur9 = ord($arr[8]);




    $isi = $hur1."-".$hur2."-".$hur3."-".$hur4."-".$hur5."-".$hur6."-".$hur7."-".$hur8."-".$hur9;

    //MEMECAH HURUF

    $io = array($hur1,$hur2,$hur3,$hur4,$hur5,$hur6,$hur7,$hur8,$hur9);
    $n="";
    for($i=0;$i<9;$i++){
    $a = str_split($io[$i]);
    $b =end($a);
    $n .= $b;
    }

    //BATAS KELOLA PER HURUP

    $arr2 = str_split($n);

    $metu1 = chr("7{$arr2[0]}");  
    $metu2 = chr("7{$arr2[1]}");
    $metu3 = chr("7{$arr2[2]}");  
    $metu4 = chr("7{$arr2[3]}");  
    $metu5 = chr("7{$arr2[4]}");
    $metu6 = chr("7{$arr2[5]}");
    $metu7 = chr("7{$arr2[6]}");
    $metu8 = chr("7{$arr2[7]}");
    $metu9 = chr("7{$arr2[8]}");


    $isi2 = $metu1.$metu2.$metu3."-".$metu4.$metu5.$metu6."-".$metu7.$metu8.$metu9;
    


    $tables[] = [
      "reg" => $isi2,
    ];

    return $tables;

  }
  //get user
  public function getUser()
  {
    $stmt =  $this->pdo->query("SELECT * from users");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "desa" => $row["desa"],
        "username_id" => $row["username_id"],
        "password_id" => $row["password_id"],
        "kepala" => $row["kepala"],
        "kab" => $row["kabupaten"],
      ];
    }

    return $tables;
  }
  

   //get user by username
   public function getUserByus($username)
   {
     $stmt =  $this->pdo->query("SELECT * from users where username_id = '$username' ");
     $tables = [];
     while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
       $tables[] = [
         "desa" => $row["desa"],
         "username_id" => $row["username_id"],
         "password_id" => $row["password_id"],
       ];
     }
 
     return $tables;
   }

  
  public function getDesa()
  {
    $stmt = $this->pdo->query("SELECT *
                                FROM users");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "desa" => $row["desa"],
        "kepala" => $row["kepala"],
        "user" => $row["user"],
        "pass" => $row["pass"],
      ];
    }

    return $tables;
  }


  /**
   * get the  list in the database
   * 
   * 
   
   * 
   */ 
  public function getSpptKini()
  {
    $stmt = $this->pdo->query("SELECT noi ,
    nop ,    
    no_induk ,
    nama_wp ,
    alamat_wp ,
    alamat_op ,
    pajak_t   
                                   FROM sppt
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
      ];
    }

    return $tables;
  }

  public function getSppthap($th)
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM sppt_terhapus WHERE th_hapus = '$th'
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
        "th_hapus" => $row["th_hapus"],
      ];
    }
    return $tables;
  }

  public function getSppthapSem()
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM sppt_terhapus 
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
        "th_hapus" => $row["th_hapus"],
      ];
    }
    return $tables;
  }


  public function getSpptbar($th)
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM sppt_baru where tahun = '$th'
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [     
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "nama" => $row["nama"],
      ];
    }

    return $tables;
  }

  public function getSpptubah($th)
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM perubahan_sppt where tahun = '$th'
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [     
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "perubahan" => $row["perubahan"],
      ];
    }

    return $tables;
  }


  public function getSpptbarSem()
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM sppt_baru 
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [     
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "nama" => $row["nama"],
      ];
    }

    return $tables;
  }


  public function getSpptubahSem()
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM perubahan_sppt 
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [     
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "perubahan" => $row["perubahan"],
      ];
    }

    return $tables;
  }


  public function getSpptByNop($Nop)
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM sppt WHERE nop = '$Nop'
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
      ];
    }

    return $tables;
  }

  public function getSpptByNopMin($Nop)
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM sppt_terhapus where nop = '$Nop'
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
      ];
    }

    return $tables;
  }

  public function getSpptByRiwayatNop($Nop)
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM perubahan_sppt where nop = '$Nop'
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "nop" => $row["nop"],
        "perubahan" => $row["perubahan"],
        "tahun" => $row["tahun"],
       
      ];
    }

    return $tables;
  }

  public function getSpptMaxTh()
  {
    $stmt = $this->pdo->query("SELECT max(tahun) as tahun
                                   FROM tahun
                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [    
        "tahun" => $row["tahun"],
       
      ];
    }

    return $tables;
  }
  public function getSpptSearchBYno($g)
  {
    $stmt = $this->pdo->query("SELECT noi ,
    nop ,    
    no_induk ,
    nama_wp ,
    alamat_wp ,
    alamat_op ,
    pajak_t   
                                   FROM sppt WHERE nop LIKE '%$g%'                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
      ];
    }

    return $tables;
  }

  public function getSpptSearchBYnam($g)
  {
    $stmt = $this->pdo->query("SELECT noi ,
    nop ,    
    no_induk ,
    nama_wp ,
    alamat_wp ,
    alamat_op ,
    pajak_t   
                                   FROM sppt WHERE nama_wp LIKE '$g%'                                  ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
      ];
    }

    return $tables;
  }


  /**
   * get the wargabanyu list in the database
   */
  public function getWargabanyuList()
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM anggota
                                   ORDER BY  nit");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "nit" => $row["nit"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
        "divisi" => $row["divisi"],
        "domisili" => $row["domisili"],
        "nomor_wa" => $row["nomor_wa"],
      ];
    }

    return $tables;
  }


  /**
   * get the warga list in the database
   */
  public function getWargaList()
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM wargaC
                                   ORDER BY nama");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }

  /**
   * get the petikan list in the database
   */
  public function getPetikanList()
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM petikanC
                                   ORDER BY nama");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }
/**
   * get the petikan list in the database berdasarkan asal untuk pindah petikan ke petikan
   */
  public function getPetikanP($id)
  {
    $stmt = $this->pdo->query("SELECT ke
                                   FROM  riwayat
                                   where asal_id = '$id'  ");
   $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
  
        $id1 = $row["ke"];
       
        $stmt1 = $this->pdo->query("SELECT *
                                         FROM  petikanC
                                       where petikan_id = '$id1' ");
             
             while ($row1 = $stmt1->fetch(\PDO::FETCH_ASSOC)) {
              $tables[] = [
                "petikan_id" => $row1["petikan_id"],
                "nama" => $row1["nama"]
              ];
        
              
            } 
    }return $tables;
}

  /**
   * get the aset list in the database
   */
  public function getAsetList()
  {
    $stmt = $this->pdo->query("SELECT *
                                   FROM aset 
                                   INNER JOIN regulator ON regulator.aset_id = aset.aset_id
                                   ");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "asal_id" => $row["asal_id"],
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
        "persil" => $row["persil"],
        "kelas" => $row["kelas"],
        "luas" => $row["luas"],
      ];
    }

    return $tables;
  }

  /**
   * get the aset count in the database
   */
  public function getAsetCount()
  {
    $stmt = $this->pdo->query('SELECT kategori, COUNT(*) as count
                                    FROM aset
                                   GROUP BY kategori;');
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "kategori" => $row["kategori"],
        "count" => $row["count"],
      ];
    }

    return $tables;
  }
  public function getcountriwayat()
  {
    $stmt = $this->pdo->query('SELECT COUNT(*) as count
                                    FROM riwayat;');
    //$stmt->execute();
    return $stmt->fetchColumn();
  }

  public function getAsetCountTotal()
  {
    $stmt = $this->pdo->query('SELECT COUNT(*) as count
                                    FROM aset;');
    //$stmt->execute();
    return $stmt->fetchColumn();
  }


  //sppt----------------------------------------------------------------------------
  public function getSpptCountTotal()
  {
    $stmt = $this->pdo->query('SELECT COUNT(*) as count
                                    FROM sppt;');
    //$stmt->execute();
    return $stmt->fetchColumn();
  }

  public function getPrahaCountTotal()
  {
    $stmt = $this->pdo->query('SELECT COUNT(*) as count
                                    FROM sppt_pra_terhapus;');
    //$stmt->execute();
    return $stmt->fetchColumn();
  }


  public function getNobar()
  {
    $satu = "1";
    $stmt = $this->pdo->query("SELECT noi FROM sppt where noi = '1' ");

    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],

      ];
    }

    return $tables;
  }
  

  public function getNop($nop)
  {
    $stmt = $this->pdo->query("SELECT  nop, pajak_t, nama_wp FROM sppt where nop = '$nop' ");
 
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "nop" => $row["nop"],
        "pajak_t" => $row["pajak_t"],
        "nama_wp" => $row["nama_wp"],
      ];
    }

    return $tables;
  }
  
//getsemua isi tabel
  public function getSppt($nop)
  {
    $stmt = $this->pdo->query("SELECT  * FROM sppt where ROWID  = '$nop'");
  
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "noi" => $row["noi"],
        "tahun" => $row["tahun"],
        "nop" => $row["nop"],
        "no_induk" => $row["no_induk"],
        "nama_wp" => $row["nama_wp"],
        "alamat_wp" => $row["alamat_wp"],
        "alamat_op" => $row["alamat_op"],
        "pajak_t" => $row["pajak_t"],
      ];
    }

    return $tables;
  }
  
  //getpraha
  public function getPraha($nop)
  {
    $stmt = $this->pdo->query("SELECT  * FROM sppt_pra_terhapus where nop  = '$nop'");
   
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "nop" => $row["nop"],
      ];
    }

    return $tables;
  }

 
 
  /** $no_ubah ="SELECT  nop FROM sppt where nop = '$nop'";
   * get the aset sum by kategori in the database
   */
  public function getAsetSum()
  {
    $stmt = $this->pdo->query('SELECT kategori, SUM(luas) as sum
                                    FROM aset
                                   GROUP BY kategori;');
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "kategori" => $row["kategori"],
        "sum" => $row["sum"],
      ];
    }

    return $tables;
  }
  public function getAsetSumTotal()
  {
    $stmt = $this->pdo->query('SELECT SUM(luas) as sum
                                    FROM aset
                                   ;');
    return $stmt->fetchColumn();
  }

  /**
   * get the riwayat by warga in the database
   */
  public function getRiwayatByWarga($warga_id)
  {
    /*$stmt = $this->pdo->prepare("SELECT *
                                   FROM riwayat
                                   WHERE dari = :warga_id OR ke = :warga_id
                                   UNION
                                   SELECT *
                                   FROM riwayat
                                   WHERE dari = :cAsal OR ke = :cAsal
                                   ORDER BY persil");*/
    $stmt = $this->pdo->prepare("SELECT *
                                  FROM riwayat
                                  INNER JOIN kolektor ON kolektor.riwayat_id = riwayat.riwayat_id
                                  WHERE warga_id = :warga_id
                                  ORDER BY asal_id ASC");
    $stmt->execute([":warga_id" => $warga_id]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "asal_id" => $row["asal_id"],
        "persil" => $row["persil"],
        "kelas" => $row["kelas"],
        "luas" => $row["luas"],
        "sebab" => $row["sebab"],
        "dari" => $row["dari"],
        "ke" => $row["ke"],
        "tgl" => $row["tgl"],
      ];
    }

    return $tables;
  }



  /**
   * get the riwayat by aset in the database
   */
  public function getRiwayatByaset($asal_id)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM riwayat
                                   WHERE asal_id = :asal_id
                                   ORDER BY persil");
    $stmt->execute([":asal_id" => $asal_id]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "asal_id" => $row["asal_id"],
        "persil" => $row["persil"],
        "kelas" => $row["kelas"],
        "luas" => $row["luas"],
        "sebab" => $row["sebab"],
        "dari" => $row["dari"],
        "ke" => $row["ke"],
        "tgl" => $row["tgl"],
      ];
    }

    return $tables;
  }

  public function getRiwayatByid($id)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM riwayat
                                   WHERE riwayat_id = :id 
                                  ");
    $stmt->execute([":id" => $id]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "sebab" => $row["sebab"],
        "asal_id" => $row["asal_id"],
        "dari" => $row["dari"],
		"ke" => $row["ke"],
        "tgl" => $row["tgl"],
      ];
    }

    return $tables;
  }
  /**
   * get the aset by kategori in the database
   */
  public function getAsetByKategori($kategori)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM aset
                                   INNER JOIN regulator ON regulator.aset_id = aset.aset_id
                                   WHERE kategori = :kategori
                                   ORDER BY persil");
    $stmt->execute([":kategori" => $kategori]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "asal_id" => $row["asal_id"],
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
        "persil" => $row["persil"],
        "kelas" => $row["kelas"],
        "luas" => $row["luas"],
      ];
    }

    return $tables;
  }

  /**
   * get the aset by warga_id in the database
   */
  public function getAsetByWarga($wId)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM aset
                                   INNER JOIN regulator ON regulator.aset_id = aset.aset_id
                                   WHERE warga_id = :wId
                                   ORDER BY persil");
    $stmt->execute([":wId" => $wId]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "aset_id" => $row["aset_id"],
        "asal_id" => $row["asal_id"],
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
        "persil" => $row["persil"],
        "kategori" => $row["kategori"],
        "kelas" => $row["kelas"],
        "luas" => $row["luas"],
      ];
    }

    return $tables;
  }
 /**
   * get the wargabanyu by id in the database
   */
  public function getWargabanyuById($nit)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM anggota
                                   WHERE nit = :nit");
    $stmt->execute([":nit" => $nit]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "nit" => $row["nit"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }
  /**
   * get the wargabanyu by id in the database
   */
  public function getWargabanyuBynowa($nowa)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM anggota
                                   WHERE nomor_wa = :nomor_wa");
    $stmt->execute([":nomor_wa" => $nowa]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "nomor_wa" => $row["nomor_wa"],
      ];
    }

    return $tables;
  }
  /**
   * get the warga by id in the database
   */
  public function getWargaById($wargaId)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM wargaC
                                   WHERE warga_id = :warga_id");
    $stmt->execute([":warga_id" => $wargaId]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }
    /**
   * get the warga by id in the database
   */
  public function getPetikById($wargaId)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM petikanC
                                   WHERE petikan_id = :warga_id");
    $stmt->execute([":warga_id" => $wargaId]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }

  /**
   * get the aset by id in the database
   */
  public function getAsetById($aId)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM aset JOIN regulator ON regulator.aset_id = aset.aset_id
                                   WHERE aset.aset_id = :aId");
    $stmt->execute([":aId" => $aId]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "aset_id" => $row["aset_id"],
        "asal_id" => $row["asal_id"],
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
        "kategori" => $row["kategori"],
        "persil" => $row["persil"],
        "kelas" => $row["kelas"],
        "luas" => $row["luas"],
        "riwayat_id" => $row["riwayat_id"],
       // "lok" => $row["lok"],
      ];
    }

    return $tables;
  }

  /**
   * get the petikan by id in the database
   */
  public function getPetikanById($petikanId)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM petikanC
                                   WHERE petikan_id = :petikan_id");
    $stmt->execute([":petikan_id" => $petikanId]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "petikan_id" => $row["petikan_id"],
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }

  /**
   * get the petikan by id in the database
   */
  public function getPetikanByWargaId($petikanWargaId)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM petikanC 
                                   INNER JOIN regulator ON regulator.petikan_id = petikanC.petikan_id
                                   INNER JOIN aset ON aset.aset_id = regulator.aset_id
                                   WHERE petikanC.warga_id = :warga_id");
    $stmt->execute([":warga_id" => $petikanWargaId]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "petikan_id" => $row["petikan_id"],
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
        "luas" => $row["luas"],
        "persil" => $row["persil"],
        "aset_id" => $row["aset_id"],
        "asal_id" => $row["asal_id"],
        "kelas" => $row["kelas"],
      ];
    }

    return $tables;
  }
  /**
   * get the petikan by id in the database
   */
  public function getPetikanByAset($petikanAset)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM petikanC 
                                   INNER JOIN riwayat ON riwayat.petikan_id = petikanC.petikan_id
                                   WHERE petikanC.warga_id = :warga_id");
    $stmt->execute([":warga_id" => $petikanAset]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "petikan_id" => $row["petikan_id"],
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
        "luas" => $row["luas"],
        "persil" => $row["persil"],
        "asal_id" => $row["asal_id"],
      ];
    }

    return $tables;
  }
   /**
   * membuat id petikan
   */
  public function countpetik()
  {
    $stmt = $this->pdo->query('SELECT COUNT(*) as count
                                    FROM petikanC;');
    //$stmt->execute();
    return $stmt->fetchColumn();
  }
  /**
   * get the warga search BY id in the database
   */
  public function getWargaSearchBYid($like)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM wargaC
                                   WHERE warga_id = :islike");
    $stmt->execute([":islike" => "$like"]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }

  /**
   * get the warga search By nama in the database
   */
  public function getWargaSearchBYname($like)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM wargaC
                                   WHERE nama LIKE :islike");
    $stmt->execute([":islike" => "$like%"]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "warga_id" => $row["warga_id"],
        "nama" => $row["nama"],
        "alamat" => $row["alamat"],
      ];
    }

    return $tables;
  }

  /**
   * get the aset search By persil in the database
   */
  public function getAsetSearchBypersil($like)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM aset
                                   INNER JOIN regulator ON regulator.aset_id = aset.aset_id
                                   WHERE persil LIKE :islike");
    $stmt->execute([":islike" => "%$like%"]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
        "asal_id" => $row["asal_id"],
        "persil" => $row["persil"],
        "kelas" => $row["kelas"],
        "luas" => $row["luas"],
      ];
    }

    return $tables;
  }

  public function readBolob($idImg)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM bolob
                                   WHERE idImg = :idImg");
    $stmt->execute([":idImg" => $idImg]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "img" => $row["doc"],
      ];
    }

    return $tables;
  }

  public function readRegulator($idWarga)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM regulator
                                   WHERE warga_id = :idWarga");
    $stmt->execute([":idWarga" => $idWarga]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "aset_id" => $row["aset_id"],
        "asal_id" => $row["asal_id"],
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
      ];
    }

    return $tables;
  }

  public function readKolektor($idWarga)
  {
    $stmt = $this->pdo->prepare("SELECT *
                                   FROM kolektor
                                   WHERE warga_id = :idWarga");
    $stmt->execute([":idWarga" => $idWarga]);
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = [
        "riwayat_id" => $row["riwayat_id"],
        "warga_id" => $row["warga_id"],
        "petikan_id" => $row["petikan_id"],
      ];
    }

    return $tables;
  }

}
