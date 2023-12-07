<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header></header>
    <main>

<?php
    echo "conecting...<br>";
    $db =pg_connect("host=lemuria dbname=medical_server user=cis4250 password=blibber");
    if ($db->connect_errno > 0){
      echo "<p>Error: Could not connect to database.<br></p>";
      exit;
    }
    else{
        echo "conected!";
    }
    ?>
    </main>
    <footer></footer>
  </body>
</html>
