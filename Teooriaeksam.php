<?php
require_once("funktsioonid.php");
global $yhendus;

// Если введён результат теории
if (!empty($_REQUEST["teooriatulemus"])) {
    teooriatulemus($_REQUEST["id"], $_REQUEST["teooriatulemus"]);
}
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Teooriaeksam</title>

</head>
<nav>
    <ul>
        <li><a href="main.php">Avaleht</a></li>
        <li><a href="registreerimine.php">Registreerimine</a></li>
        <li><a href="Teooriaeksam.php">Teooriaeksam</a></li>
        <li><a href="Slaalom.php">Slaloom</a></li>
        <li><a href="Ringtee.php">Ringtee</a></li>
        <li><a href="Tänav.php">Tänavasõit</a></li>
        <li><a href="Lubadeleht.php">Lubade leht</a></li>
    </ul>
</nav>
<body>

<table>
    <tr>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Tulemus</th>
    </tr>
    <?php
kuvatabel();
    ?>
</table>
</body>
</html>
