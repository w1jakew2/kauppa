<?php
  require('funktiot.php');
/* Tehdään toiminnot */
  if ($_POST['toiminto'] == 'osta') {
    osta_tuote();
  } elseif ($_POST['toiminto'] == 'muuta_lkm') {
    muuta_lkm();
  }
?><!DOCTYPE HTML>
<html>
<head>
<title>Kauppa: Ostoskori</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php valikko() ?>

<h1>Ostoskori</h1>

<?php if (count($_SESSION['ostoskori']) == 0) { ?>

<p>Ostoskori on tyhjä!</p>

<?php } else { ?>
<form action="<?php $_SERVER[PHP_SELF] ?>" method="post">
<input type="hidden" name="toiminto" value="muuta_lkm">
<table border="1">
<thead>

<tr><th>Nimi</th><th>À</th><th>Kpl</th><th>Hinta</th></tr>
</thead>

<tbody>
<?php
  // lasketaan tähän kaikkien ostosten summa
  $summa = 0;
  foreach ($_SESSION['ostoskori'] as $tuotenro => $lkm) {
    $tuote = $TUOTTEET[$tuotenro];
    echo "<tr><td>$tuote[nimi]</td>";
    echo "<td>" . number_format($tuote['hinta'], 2, ',', ' ') . " &euro;</td>";
    echo "<td><input type=\"text\" name=\"lkm[$tuotenro]\" size=\"2\" value=\"$lkm\"></td>\n";
    $hinta = $tuote['hinta'] * $lkm;
    echo "<td>" . number_format($hinta, 2, ',', ' ') . " &euro;</td></tr>\n";
    $summa += $hinta;
  }
?>

<tr>
<td></td><td></td>
<td><input type="submit" value="Muuta"></td>
<td></td>
</tr>
</tbody>

</table>
</form>
<p>Yhteensä: <?= number_format($summa, 2, ',', ' ') ?> &euro;</p>
<?php } ?>
</body>
</html>