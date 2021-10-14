<h3>Search Client File</h3>
            <form  method="post" action="#"  id="searchform">
              Type the Image Code:<br><br>
                  <input  type="text" name="icode">
            <br>
      <input  type="submit" name="submit" value="Search">
            </form>  

<?php
     $fcode=$_POST["icode"];
 if (!empty($fcode))
   {

$file="db/$fcode.db";

     if (file_exists($file))
     {

       header('Content-Description: File Transfer');
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename='.basename($file));
       header('Content-Transfer-Encoding: binary');
       header('Expires: 0');
       header('Cache-Control: must-revalidate');
       header('Pragma: public');
       header('Content-Length: ' . filesize($file));
       ob_clean();
       ob_end_flush();
       readfile($file);

      }

      else
      {
        echo "The file $fcode.tif does not exist";
      } 
   }    

     else
     {
       echo "No Values";
     }

    ?>