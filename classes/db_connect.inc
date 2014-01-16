<?php 

DEFINE('DB_USER','Admin');
DEFINE('DB_PASSWORD','2jnydKg');
DEFINE('DB_HOST','localhost');
DEFINE('DB_NAME','mapy');

$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME);

mysql_query("SET NAMES 'utf8'");
//if($dbc) echo 'Połączono z bazą danych <br/>';
?>