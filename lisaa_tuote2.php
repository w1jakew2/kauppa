<?php
  // tallennustiedosto
  $tallennus = 'tuotteet.txt';
  // esikäsitellään lomake ja tutkitaan virheet
  // alustetaan tyhjillä arvoilla
  $tiedot = array('tunnus' => '', 'nimi' => '', 'hinta' => '');
  $kasitelty = false; 
  $virheet = false;
  if (lomake_lahetetty()) {
    hae_tiedot($tiedot);
    @$virheet = virheita($tiedot);
    if (!$virheet) {
      //lomakkeen tietojen käsittely, tallennus tiedostoon
      tallenna_tiedot($tiedot, $tallennus);
      // ja siirtyminen muualle
      header('Sijainti: tuoteluettelo.php');
      poistua;
    }
  }
?>
<!DOCTYPE HTML>
<html>
    <head>
    <title>Lisää tuotetta</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </head>
  <body>
    <h1>Lisää uusi tuote</h1>    
   
<form action="$_SERVER[PHP_SELF]" method="post">
  Tunnus: <input type="text" name="tunnus" value="$tiedot[tunnus]" maxlength="10" size="10"><br>
  Nimi: <input type="text" name="nimi" value="$tiedot[nimi]"><br>
  Hinta: <input type="text" name="hinta" value="$tiedot[hinta]" maxlength="10" size="10">€<br>
  <input type="submit" name="submit" value="Lähetä">
</form>
  </body>
</html>