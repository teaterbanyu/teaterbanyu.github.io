<?php

namespace App;

/**
 * SQLite Create Table Demo
 */
class SQLiteCreateTable
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

  /**
   * create tables
   */
  public function createTables()
  {
    $commands = [
      'CREATE TABLE IF NOT EXISTS wargaC (
                        warga_id   VARCHAR (255) PRIMARY KEY,
                        nama VARCHAR (255) NOT NULL,
                        alamat  TEXT
                      )',
      'CREATE TABLE IF NOT EXISTS petikanC (
                    petikan_id VARCHAR (255) PRIMARY KEY,
                    warga_id VARCHAR (255) NOT NULL,
                    nama  VARCHAR (255) NOT NULL,
                    alamat  TEXT                    
                    )',
      'CREATE TABLE IF NOT EXISTS riwayat (
                riwayat_id INTEGER PRIMARY KEY,
                asal_id VARCHAR (255) NOT NULL,
                persil VARCHAR (255) NOT NULL,
                kelas  VARCHAR (255) NOT NULL,
                luas  VARCHAR (255) NOT NULL,
                sebab  VARCHAR (255) NOT NULL,                  
                dari  VARCHAR (255) NOT NULL,                  
                ke  VARCHAR (255) NOT NULL,                  
                tgl  VARCHAR (255) NOT NULL             
                )',
      'CREATE TABLE IF NOT EXISTS aset (
                aset_id INTEGER PRIMARY KEY,
                kategori  VARCHAR (255) NOT NULL,
                persil VARCHAR (255) NOT NULL,
                kelas  VARCHAR (255) NOT NULL,
                luas VARCHAR (255) NOT NULL                  
                )',
      'CREATE TABLE IF NOT EXISTS regulator (
                aset_id VARCHAR (255) NOT NULL UNIQUE,
                asal_id VARCHAR (255) NOT NULL,
                warga_id VARCHAR (255) NOT NULL,
                petikan_id VARCHAR (255) NOT NULL,
                FOREIGN KEY (aset_id)
                REFERENCES aset (aset_id) 
                    ON UPDATE CASCADE          
                    ON DELETE CASCADE          
                )',
      'CREATE TABLE IF NOT EXISTS kolektor (
        riwayat_id VARCHAR (255) NOT NULL UNIQUE,
        warga_id VARCHAR (255) NOT NULL,
        petikan_id VARCHAR (255) NOT NULL,
        FOREIGN KEY (riwayat_id)
        REFERENCES riwayat (riwayat_id) 
            ON UPDATE CASCADE          
            ON DELETE CASCADE          
        )',
      'CREATE TABLE IF NOT EXISTS bolob (
                    idImg VARCHAR (255) NOT NULL,
                    doc TEXT NOT NULL        
                    )',
      'CREATE TABLE IF NOT EXISTS users (
        desa	VARCHAR(255),
        kepala	VARCHAR(255),
        user	VARCHAR(255),
        pass	TEXT
      )',
    ];
    // execute the sql commands to create new tables
    foreach ($commands as $command) {
      $this->pdo->exec($command);
    }
  }

  /**
   * get the table list in the database
   */
  public function getTableList()
  {
    $stmt = $this->pdo->query("SELECT name
                                   FROM sqlite_master
                                   WHERE type = 'table'
                                   ORDER BY name");
    $tables = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      $tables[] = $row["name"];
    }

    return $tables;
  }
}
