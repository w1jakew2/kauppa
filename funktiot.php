<?php
/* Kauppaesimerkkiin liittyvät kirjastofunktiot ja asetukset*/

/* Yleiset asetukset */
  $tiedosto = 'tuotteet.txt';  // tuotetiedot sisältävä tiedosto

/* Tuotetietojen käsittely */
  if (!file_exists($tiedosto)) die('Tuoteluetteloa ei löydy!');
  $TUOTTEET = lue_tuotteet($tiedosto);
  
  function lue_tuotteet($tied) {
    $tuotteet = array();
    // avataan tiedosto lukemista varten
    $viite = fopen($tied, 'r');
    // fgets palauttaa arvon FALSE, jos tiedosto on lopussa
    while ($rivi = fgets($viite, 1024)) {
      $rivi = trim($rivi);
      if ($rivi == '') continue;
      // jaetaan rivi taulukoksi
      $rivi = explode(';', trim($rivi));
      $tunnus = (int) $rivi[0];
      $nimi = $rivi[1];
      $hinta = (float) $rivi[2];
      // siirretään tiedot tuotetaulukkoon
      $tuotteet[$tunnus] = array('nimi' => $nimi, 'hinta' => $hinta);
    }
    return $tuotteet;
  }

/* Istunnon käsittely */
  session_start();
  // luodaan ostoskori
  if (!isset($_SESSION['ostoskori'])) {
    $_SESSION['ostoskori'] = array();
  }
  //luodaan käyttäjätiedot
  if (!isset($_SESSION['ostaja'])) {
    $_SESSION['ostaja'] = array();
  }
  
  // poistetaan istunnosta edellisen ostoksen tiedot
  function alusta_istunto() {
    unset($_SESSION['ostettu']);
  }

/* Navigointi */
  function valikko() {
    $valikko = array('index.php' => 'Tuotteet', 'ostoskori.php' => 'Ostoskori', 'kassa.php' => 'Kassalle');
    echo '<div class="valikko">';
    foreach($valikko as $tied => $otsikko) {
      $l = -1 - strlen($tied);
      if (substr($_SERVER['PHP_SELF'], $l) == '/'.$tied) {
        echo "[<strong>$otsikko</strong>] ";
      } else {
        echo "[<a href=\"$tied\">$otsikko</a>] ";
      }
    }
    echo '</div>';
  }

/* Ostoskorin käsittely */
  function kokonaissumma() {
    global $TUOTTEET;
    $summa = 0;
    foreach ($_SESSION['ostoskori'] as $tuotenro => $lkm) {
      $tuote = $TUOTTEET[$tuotenro];
      $hinta = $tuote['hinta'] * $lkm;
      $summa += $hinta;
    }
    return $summa;
  }
  
  function osta_tuote() {
    global $TUOTTEET;
    // onko ostos jo tehty
    if (isset($_SESSION['ostettu'])) {
      return false;
    }
    // onko määritelty ostettava tuote
    if (isset($_POST['nro']) and isset($_POST['lkm'])) {
      // onko numero oikein
      $tuotenro = (int) $_POST['nro'];
      $lkm = (int) $_POST['lkm'];
      if ($lkm > 0 and array_key_exists($tuotenro, $TUOTTEET)) {
        // tehdään ostos
        $edlkm = 0;
        if (isset($_SESSION['ostoskori'][$tuotenro])) {
          $edlkm = $_SESSION['ostoskori'][$tuotenro];
        }
        $_SESSION['ostoskori'][$tuotenro] = $edlkm + $lkm;
        // merkitään ostos tehdyksi istuntoon
        // ettei ostosta toisteta 'reload' painikkeella
        $_SESSION['ostettu'] = $tuotenro;
        return true;
      }
    }
    return false;
  }
  
  // muutetaan tuotteiden lukumäärää ostoskorissa
  function muuta_lkm() {
    $lkm = $_POST['lkm'];
    foreach ($lkm as $tuotenro => $lkm) {
      if (isset($_SESSION['ostoskori'][$tuotenro])) {
        $lkm = (int) $lkm;
        // jos lkm on nolla, poistetaan kokonaan
        if ($lkm <= 0) {
          unset($_SESSION['ostoskori'][$tuotenro]);
        } else {
          $_SESSION['ostoskori'][$tuotenro] = (int) $lkm;
        }
      }
    }
  }
?>
