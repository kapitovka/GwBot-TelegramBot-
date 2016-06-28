<?php
include("config.php");

$date = date("H");

while($date == true){
         delivery($dbhost,$dbuser,$dbpass,$dbname,$api,$reply_markup);
      sleep(3600);
}
       
       
?>