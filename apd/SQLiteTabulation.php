<?php

namespace App;

/**
 * PHP SQLite Insert Demo
 */
class SQLiteTabulation
{
  /**
   * PDO object
   * @var \PDO
   */
  private $pdo;

  /**
   * Initialize the object with a specified PDO object
   * @param \PDO $pdo
   */
  
  public function __construct($pdo)
  {
    $this->pdo = $pdo;
    $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
  }
  public function createtable()
  {
    $sql =
      "CREATE TABLE sppt_terhapus (
        [no]      VARCHAR (10),
        tahun     CHAR (4),
        nop       VARCHAR (25)  PRIMARY KEY
                                NOT NULL,
        no_induk  VARCHAR (10),
        nama_wp   VARCHAR (70),
        alamat_wp VARCHAR (100),
        alamat_op VARCHAR (100),
        pajak_t   VARCHAR (15),
        th_hapus  CHAR (5) 
    )";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
  }
  public function insertRegist($desa,$username_user,$password_user3,$namabaru,$kabupaten)
  {
    $sql =
      "INSERT INTO  users(desa,username_id,password_id,kepala,kabupaten) VALUES(:desa, :username_id, :password_id, :kepala, :kabupaten)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([

      ":desa" => $desa, 
      ":username_id" => $username_user, 
      ":password_id" => $password_user3,
      ":kepala" => $namabaru,
      ":kabupaten" => $kabupaten,
     
    ]);
  }

  public function insertAkode($akode)
  {
    $sql = 
      "INSERT INTO Akode(aktif)values(:akode)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":akode" => $akode
    ]);
  }

  public function insertAkodecoba($akode)
  {
    $sql = 
      "INSERT INTO coba(aktif)values(:akode)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":akode" => $akode
    ]);
  }
  
  public function insertWarga($noC, $namaWarga, $alamatWarga)
  {
    $sql =
      "INSERT INTO wargaC(warga_id, nama, alamat) VALUES(:no_c, :nama_warga, :alamat_warga)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":no_c" => $noC,
      ":nama_warga" => $namaWarga,
      ":alamat_warga" => $alamatWarga,
    ]);
  }


  public function inputtahunsek($tahun)
  {
    $sql =
            "INSERT INTO tahun(tahun) VALUES(:tahun)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
     
      ":tahun" => $tahun,
    
     
    ]);
  
    }

  public function insertSppt($no, $tahun, $nop, $no_induk, $nama_wp, $alamat_wp, $alamat_op, $pajak_t )
  {
    $sql =
            "INSERT INTO sppt(noi, tahun,  nop, no_induk, nama_wp, alamat_wp, alamat_op, pajak_t) VALUES(:noi, :tahun, :nop, :no_induk, :nama_wp, :alamat_wp, :alamat_op, :pajak_t)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":noi" => $no,
      ":tahun" => $tahun,
      ":nop" => $nop,
      ":no_induk" => $no_induk,
      ":nama_wp" => $nama_wp,
      ":alamat_wp" => $alamat_wp,
      ":alamat_op" => $alamat_op,
      ":pajak_t" => $pajak_t,
    ]);
  }

  public function inputHapus($no, $tahun, $nop, $no_induk, $nama_wp, $alamat_wp, $alamat_op, $pajak_t, $th_hapus )
  {
    $sql =
            "INSERT INTO sppt_terhapus(noi, tahun,  nop, no_induk, nama_wp, alamat_wp, alamat_op, pajak_t, th_hapus) VALUES(:noi, :tahun, :nop, :no_induk, :nama_wp, :alamat_wp, :alamat_op, :pajak_t, :th_hapus)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":noi" => $no,
      ":tahun" => $tahun,
      ":nop" => $nop,
      ":no_induk" => $no_induk,
      ":nama_wp" => $nama_wp,
      ":alamat_wp" => $alamat_wp,
      ":alamat_op" => $alamat_op,
      ":pajak_t" => $pajak_t,
      ":th_hapus" => $th_hapus,
    ]);
  }

  

  public function insertSpptbaru($tahun, $nop, $nama_wp )
  {
    $sql =
            "INSERT INTO sppt_baru(tahun,  nop, nama) VALUES(:tahun, :nop, :nama_wp)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
     
      ":tahun" => $tahun,
      ":nop" => $nop,
      ":nama_wp" => $nama_wp,
     
    ]);
  
    }
  public function insertpraha($nop_pra)
  {
    $sql =
    "INSERT INTO sppt_pra_terhapus (nop) VALUES (:nop_pra);";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
            ":nop_pra" => $nop_pra,
    ]);
  }

  //"UPDATE sppt SET  nama_wp ='$namabaru' WHERE nop = '$nop'"
 
  public function updateSpptNama($nama_wp, $nop)
  {
    $sql =
      "UPDATE  sppt SET  nama_wp = :nama_wp WHERE nop = :nop";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":nama_wp" => $nama_wp,
      ":nop" => $nop,
      ]);
  }

  public function updateSpptPajak($pajak, $nop)
  {
    $sql =
      "UPDATE  sppt SET  pajak_t = :pajak WHERE nop = :nop";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":pajak" => $pajak,
      ":nop" => $nop,
      ]);
  }

  
  public function insertperu($nop, $namak1, $tahun)
  {
    $sql =
    "INSERT INTO perubahan_sppt (nop, perubahan, tahun) VALUES (:nop , :namak1 ,:tahun )";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
            ":nop" => $nop,
            ":namak1" => $namak1,
            ":tahun" => $tahun,
    ]);
  }

  public function HapusSppt($nop)
  {
    $stmt = $this->pdo->prepare('delete from sppt where nop = :nopi');
    $stmt->execute([":nopi" => $nop]);
  }

  public function BuatTabPraha()
  {
    $stmt = $this->pdo->prepare('CREATE TABLE sppt_pra_terhapus ( nop       VARCHAR (50)  PRIMARY KEY );');
    $stmt->execute();
  }

  public function HapusTabPraha()
  {
    $stmt = $this->pdo->prepare('DROP TABLE sppt_pra_terhapus');
    $stmt->execute();
  }

  public function updateWarga($wargaId, $namaPetikan, $alamatPetikan)
  {
    $sql =
      "UPDATE petikanC SET nama = :nama, alamat = :alamat WHERE warga_id = :warga_id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":warga_id" => $wargaId,
      ":nama" => $nama,
      ":alamat" => $alamat,
    ]);
  }

  public function upUser($kep,$user,$pasbar,$desa)
  {
    $sql =
      "UPDATE users SET username_id = :user, kepala = :kepala, password_id = :pas WHERE desa = :desa";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
     ":kepala" => $kep,
      ":user" =>$user,
     ":pas" => $pasbar,
      ":desa" => $desa,
     
    ]);
  }

  public function upUser1($kep,$user,$desa)
  {
    $sql =
      "UPDATE users SET username_id = :user, kepala = :kepala  WHERE desa = :desa";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
     ":kepala" => $kep,
      ":user" =>$user,
      ":desa" => $desa,
     
    ]);
  }


  public function deleteWarga($wargaId)
  {
    $sql = 'DELETE FROM wargaC
                WHERE warga_id = :warga_id';

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([":warga_id" => $warga_id]);
  }

  public function insertPetikan($petikan_id, $wargaId, $namaPetikan, $alamatPetikan)
  {
    $sql =
      "INSERT INTO petikanC(petikan_id,warga_id, nama, alamat) VALUES(:petikan_id, :warga_id, :nama_petikan,:alamat_petikan)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":petikan_id" =>$petikan_id, //belum ai dan unik
      ":warga_id" => $wargaId,
      ":nama_petikan" => $namaPetikan,
      ":alamat_petikan" => $alamatPetikan,
    ]);

    return $this->pdo->lastInsertId();
  }

  public function updatePetikan($petikanId, $namaPetikan, $alamatPetikan)
  {
    $sql =
      "UPDATE petikanC SET nama = :nama, alamat = :alamat WHERE petikan_id = :petikan_id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":petikan_id" => $petikanId,
      ":nama" => $nama,
      ":alamat" => $alamat,
    ]);
  }

  public function deletePetikan($petikanId)
  {
    $sql = 'DELETE FROM petikanC
                WHERE petikan_id = :petikan_id';

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([":petikan_id" => $petikanId]);
  }

  public function insertRiwayat($asalId, $persil, $kelas, $luas, $sebab, $dari, $ke, $tgl
  ) {
    $sql =
      "INSERT INTO riwayat(asal_id, persil, kelas, luas, sebab, dari, ke, tgl) VALUES(:asal_id, :persil, :kelas, :luas, :sebab, :dari, :ke, :tgl)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":asal_id" => $asalId,
      ":persil" => $persil,
      ":kelas" => $kelas,
      ":luas" => $luas,
      ":sebab" => $sebab,
      ":dari" => $dari,
      ":ke" => $ke,
      ":tgl" => $tgl,
    ]);

    return $this->pdo->lastInsertId();
  }

  public function daleteRiwayat($riwayatId)
  {
    $sql = 'DELETE FROM riwayat
                WHERE riwayat_id = :riwayat_id';

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([":riwayat_id" => $riwayatId]);
  }

//insert aset
public function insertAnggota($nama, $divisi, $nomor_wa)
{
  $sql =
    "INSERT INTO anggota(nama,divisi,nomor_wa) VALUES(:nama,:divisi,:nomor_wa)";

  $stmt = $this->pdo->prepare($sql);
  $stmt->execute([
    ":nama" => $nama,
    ":divisi" => $divisi,
    ":nomor_wa" => $nomor_wa,
  ]);

  return $this->pdo->lastInsertId();
}
//inseert aset
  public function insertAset($kategori, $persil, $kelas, $luas)
  {
    $sql =
      "INSERT INTO aset(kategori,persil,kelas,luas) VALUES(:kategori,:persil,:kelas,:luas)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":kategori" => $kategori,
      ":persil" => $persil,
      ":kelas" => $kelas,
      ":luas" => $luas,
    ]);

    return $this->pdo->lastInsertId();
  }

  public function updateAset($asetId, $kategori, $kelas, $luas, $persil)
  {
    $sql =
      "UPDATE aset SET kategori = :kategori, kelas = :kelas, luas = :luas, persil = :persil WHERE aset_id = :aset_id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":aset_id" => $asetId,
      ":kategori" => $kategori,
      ":kelas" => $kelas,
      ":luas" => $luas,
      ":persil" => $persil,
    ]);
  }

  public function deleteAset($asetId)
  {
    $sql = 'DELETE FROM Aset
                WHERE aset_id = :aset_id';

    $stmt = $this->pdo->prepare($sql);

    $stmt->execute([":aset_id" => $asetId]);
  }

  public function insertRegulator($asetId, $asalId, $wargaId, $petikanId, $riw_id)
  {
    $sql =
      "INSERT INTO regulator( aset_id, asal_id, warga_id, petikan_id, riwayat_id ) VALUES(:aset_id, :asal_id, :warga_id, :petikan_id ,:riwayat_id)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":aset_id" => $asetId,
      ":asal_id" => $asalId,
      ":warga_id" => $wargaId,
      ":petikan_id" => $petikanId,
      ":riwayat_id" => $riw_id,
    ]);
  }

  public function updateRegulator($asetId, $wargaId, $petikanId, $riw_id)
  {
    $sql =
      "UPDATE regulator SET warga_id = :warga_id, petikan_id = :petikan_id, riwayat_id = :riwayat_id WHERE aset_id = :aset_id";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":aset_id" => $asetId,
      ":warga_id" => $wargaId,
      ":petikan_id" => $petikanId,
      ":riwayat_id" => $riw_id,
    ]);
  }

  public function insertKolektor($riwayatId, $wargaId, $petikanId)
  {
    $sql =
      "INSERT INTO kolektor(riwayat_id, warga_id, petikan_id) VALUES(:riwayat_id, :warga_id, :petikan_id)";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
      ":riwayat_id" => $riwayatId,
      ":warga_id" => $wargaId,
      ":petikan_id" => $petikanId,
    ]);
  }

  public function insertBlob($idImg, $pathToFile)
  {
    $sql = "INSERT INTO bolob(idImg, doc) VALUES(:idImg, :doc)";

    $stmt = $this->pdo->prepare($sql);

    $stmt->bindParam(":idImg", $idImg);
    $stmt->bindParam(":doc", $pathToFile);
    $stmt->execute();
  }
}
