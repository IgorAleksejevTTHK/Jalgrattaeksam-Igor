<?php
global $yhendus;
require_once("funktsioonid.php"); //

if (isset($_REQUEST["sisestusnupp"])) {
    $eesnimi = trim($_REQUEST["eesnimi"]);
    $perekonnanimi = trim($_REQUEST["perekonnanimi"]);


    if (registreerimine($eesnimi, $perekonnanimi)) {


        header("Location: Teooriaeksam.php?eesnimi=" . urlencode($eesnimi) . "&perekonnanimi=" . urlencode($perekonnanimi));
        exit();
    } else {

        header("Location: " . $_SERVER['PHP_SELF'] . "?viga=1");
    }


    $yhendus->close();
    exit();
}
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Kasutaja registreerimine</title>
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
<h1>Registreerimine</h1>
<?php
// Проверка на успешную регистрацию
if (isset($_REQUEST["lisatudeesnimi"])) {
    echo "Lisati $_REQUEST[lisatudeesnimi]";
}
?>

<form action="" method="post">
    <dl>
        <dt>Eesnimi:</dt>
        <dd><input type="text" name="eesnimi" required /></dd>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" required /></dd>
        <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>
    </dl>
</form>

</body>
</html>
