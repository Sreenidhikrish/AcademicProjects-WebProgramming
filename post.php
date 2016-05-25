<?php
session_start();
if(isset($_SESSION['name'])){
   $text = $_POST['text'];
  
    $ar = explode("--", $text);
       
   //Now we have $ar[0] --> arg1, $ar[1] --> $arg2, $ar[2] --> $arg3
 // $fname="log.html";
   $fp = fopen($ar[1], 'a');
   fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['name']."</b>: ".stripslashes(htmlspecialchars($ar[0]))."<br></div>");
   fclose($fp);
}
?>