
<?php
require('funktiot.php');
alusta_istunto();
?><!DOCTYPE HTML>

<html>
<head>
<title>Kauppa</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php valikko() ?>

<h1>Tuotteet</h1>
<table border="1">
<thead><tr><th>Tuotenro</th><th>Nimi</th><th>Hinta</th></tr></thead>

<tbody>
<?php
  // tulostetaan tuotteet yksi kerrallaan
  foreach($TUOTTEET as $nro => $tuote) {
    $hinta = number_format($tuote['hinta'], 2, ',', ' ');
    echo <<<LOMAKE
<tr><td>$nro</td>
<td>$tuote[nimi]</td>
<td>$hinta &euro;</td>

<td>
<form action="ostoskori.php" method="post">
<input type="hidden" name="toiminto" value="osta">
<input type="hidden" name="nro" value="$nro">
<input type="text" name="lkm" size="2" value="1">
<input type="submit" name="osta" value="Osta">
</form>
</td>
</tr>

LOMAKE;
  }
?>
</tbody>
</table>

<p>Ostoskori yhteensä: <?= number_format(kokonaissumma(), 2, ',', ' ') ?> &euro; </p>
</body>
</html>