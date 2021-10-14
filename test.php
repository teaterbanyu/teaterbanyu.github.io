<?php
/**
 * Xls Test
 *
 * @author Janson
 * @create 2017-11-28
 */
require 'vendor/autoload.php';

//use Asan\PHPExcel;
$start = microtime(true);
$memory = memory_get_usage();

$reader = Asan\PHPExcel\Excel::load('tmp/data-sppt.xls', function(Asan\PHPExcel\Reader\Xls $reader) {
    //$reader->setRowLimit(5);
    //$reader->setColumnLimit(10);
    $reader->ignoreEmptyRow(true);
    //$reader->setSheetIndex(1);
});
foreach ($reader as $row) {
    if($row[0] == "NO") continue;
    $cek = $row[1];
   
}
echo $cek."<br>";
