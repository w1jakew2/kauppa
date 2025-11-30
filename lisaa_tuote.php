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
      header('Location: tuoteluettelo.php');
      exit;
    }
  }
?><!DOCTYPE HTML">

<html>
  <head>
    <title>Lisää tuote</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  </head>

  <body>
    <h1>Lisää uusi tuote</h1>
    <?php
      if ($virheet) {
         // tulostetaan mahdolliset virheilmoitukset ennen lomaketta
        echo "<p><strong>Virheet</strong>:<br>" . 
             implode('<br>', $virheet) . "<p>\n";
      }
      tulosta_lomake($tiedot);
    ?>

  </body>
</html>
<?php
function lomake_lahetetty() {
  // jos lomakkeen submit-painiketta on painettu
  return isset($_POST['submit']);
}

// ahetaan lomakkeen tiedot parametrina annettuun taulukkoon
function hae_tiedot(&$tiedot) {
  if (isset($_POST['tunnus'])) {
    $tiedot['tunnus'] = htmlspecialchars($_POST['tunnus']);
  }
  if (isset($_POST['nimi'])) {
    $tiedot['nimi'] = htmlspecialchars($_POST['nimi']);
  }
  if (isset($_POST['hinta'])) {
    $tiedot['hinta'] = htmlspecialchars($_POST['hinta']);
  }
}

// tarkistetaan virheet
// palauttaa tyhjän taulukon, jos virheitä ei ole
function virheita($tiedot) {
  $virheet = array();
  if ($tiedot['tunnus'] == '') {
    $virheet[] = 'Tunnus on pakollinen!';
  }
  if ($tiedot['nimi'] == '') {
    $virheet[] = 'Nimi on pakollinen!';
  }
  if ($tiedot['hinta'] == '') {
    $virheet[] = 'Hinta on pakollinen!';
  }
  return $virheet;
}

// tallentaa tiedot tuotetiedoston loppuun
function tallenna_tiedot($tiedot, $tiedosto) {
  // avataan tiedosto 
  $viite = fopen($tiedosto, 'a');
  if ($viite) {
    // kirjoitetaan tiedot yhdelle riville
    fwrite($viite, $tiedot['tunnus'] . ';');
    fwrite($viite, $tiedot['nimi'] . ';');
    fwrite($viite, $tiedot['hinta'] . "\n");
    fclose($viite);
  }
}

// lomakkeen tulostus
// parametrina edellisellä kierroksella syötetyt arvot
function tulosta_lomake($tiedot) {
  // lomake ohjataan takaisin tälle sivulle, PHP-SELF
  echo <<<LOMAKE
<form action="$_SERVER[PHP_SELF]" method="post">
  Tunnus: <input type="text" name="tunnus" value="$tiedot[tunnus]" maxlength="10" size="10"><br>
  Nimi: <input type="text" name="nimi" value="$tiedot[nimi]"><br>

  Hinta: <input type="text" name="hinta" value="$tiedot[hinta]" maxlength="10" size="10">€<br>
  <input type="submit" name="submit" value="Lähetä">
</form>
LOMAKE;
}
?>