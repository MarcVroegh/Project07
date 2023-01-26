<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project07/db/db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Project07/functions/functions.php");
$con = new dbh();
$fun = new Functions();
$result = $fun->SelectRechten($_SESSION["hekkensluiterFunctie"]);
$result2 = $fun->SelectRechten2($_SESSION["hekkensluiterFunctie"]);
$result3 = $fun->SelectRechten3($_SESSION["hekkensluiterFunctie"]);
$result8 = $fun->SelectRechten8($_SESSION["hekkensluiterFunctie"]);
if(isset($_SESSION["hekkensluiterGebruikersnaam"])) {
$array2 = $fun->SelectFromLoginLog($_SESSION["hekkensluiterGebruikersnaam"]);
}
$mysql_timestamp = $array2['thistime'];
if(strtotime($mysql_timestamp) > strtotime("-15 minutes")) {
  if (isset($_SESSION["hekkensluiter"])){
    $fun->InsertIntoLoginLog($_SESSION["hekkensluiterNaam"], $_SESSION["hekkensluiterAchternaam"], $_SESSION["hekkensluiterGebruikersnaam"]);
  }
  else{
    header("Refresh:0; url=/Project07/pages/login.php");
  }
}
else{
  header("Refresh:0; url=/Project07/pages/login.php");
}

date_default_timezone_set("Europe/Amsterdam");
if (date('H') < 24) {
  $pre2pm = "Goedeavond";
}
if (date('H') < 17) {
  $pre2pm = "Goedemiddag";
}
if (date('H') < 12) {
  $pre2pm = "Goedemorgen";
}
if (date('H') < 7) {
  $pre2pm = "Goedenacht";
}
?>
<!DOCTYPE html>
<html>
<title>Klantenportaal</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,300,400,700">
<link rel="stylesheet" href="/project07/css/style.css">
<body>

<div class="sidebar" style="width:80px">
<a href="./uitlog.php">
         <img alt="log out" src="/Project07/images/loginb.png"
         width="30" height="27" style="position: absolute; bottom: 130px; left: 25px;">
</a>
<a href="/Project08/index.php">
         <img alt="back" src="/Project07/images/goback.png"
         width="30" height="30" style="position: absolute; bottom: 70px; left: 25px;">
</a>
</div>

<div style="margin-left:80px">

<div class="container" style="height:100px">
  <h1>Hekkensluiter</h1>
</div>

<div style="margin-top:100px">

<div class="con">
    <h1><?php echo $pre2pm;?> <?php if (isset($_SESSION["hekkensluiterNaam"])){ echo $_SESSION["hekkensluiterNaam"]; } ?>,</h1><br>
    <a href="./GedetineerdePaneel.php"><input type="submit" id="button1" <?php if($result['actiegedetineerde'] == 0) { echo "value=' '";  }else{ echo "value='Acties gedetineerde'"; }  ?>/></a>
    <a href="./BezoekersPaneel.php"><input type="submit" id="button2" <?php if($result2['actiebezoekers'] == 0) { echo "value=' '";  }else{ echo "value='Acties bezoekers'"; }  ?>/></a>
    <a href="./InformatieGedetineerdePaneel.php"><input type="submit" id="button1" <?php if($result3['infogedetineerde'] == 0) { echo "value=' '";  }else{ echo "value='Info gedetineerde'"; }  ?>/></a>
    <br>
    <a href="./celbezetting.php"><input type="submit" id="button2" <?php if($result8['celbezetting'] == 0) { echo "value=' '";  }else{ echo "value='Celbezetting'"; }  ?>/></a>
    <a href="./uitlog.php"><input type="submit" id="button1" value="Uitloggen"/></a>
    <a href=""><input type="submit" id="button2" value=" "/></a>
    <br><br>
</div>

      
</body>
</html>
