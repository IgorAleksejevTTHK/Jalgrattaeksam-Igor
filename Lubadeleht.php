<?php
require_once("konf.php");
global $yhendus;


if(!empty($_REQUEST["vormistamine_id"])){
    $kask = $yhendus->prepare(
        "UPDATE jalgrattaeksam SET luba=1 WHERE id=?"
    );
    $kask->bind_param("i", $_REQUEST["vormistamine_id"]);
    $kask->execute();
}


$kask = $yhendus->prepare(
    "SELECT id, eesnimi, perekonnanimi, teooriatulemus, slaalom, ringtee, t2nav, luba FROM jalgrattaeksam;"
);
$kask->execute();
$kask->store_result();
$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus, $slaalom, $ringtee, $t2nav, $luba);

if(isset($_REQUEST["kustuta"])) {
    $paring = $yhendus->prepare("DELETE FROM jalgrattaeksam WHERE id=?");
    $paring->bind_param("i", $_REQUEST["kustuta"]);
    $paring->execute();


    header("Location: $_SERVER[PHP_SELF]");
    exit();
}

function asenda($nr){
    if($nr == -1) { return "."; } //
    if($nr == 1) { return "korras"; }
    if($nr == 2) { return "ebaõnnestunud"; }
    return "Tundmatu number";
}
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Lõpetamine</title>
</head>
<body>
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
<h1>Lõpetamine</h1>
<table>
    <tr>
        <th>Eesnimi</th>
        <th>Perekonnanimi</th>
        <th>Teooriaeksam</th>
        <th>Slaalom</th>
        <th>Ringtee</th>
        <th>Tänavasõit</th>
        <th>Lubade väljastus</th>
        <th>Tegevused</th>
    </tr>
    <?php
    while($kask->fetch()){
        $kustuta = "<a href='?kustuta=$id'>Kustuta</a>";
        $asendatud_slaalom = asenda($slaalom);
        $asendatud_ringtee = asenda($ringtee);
        $asendatud_t2nav = asenda($t2nav);
        $loalahter = ".";

        if($luba == 1) {
            $loalahter = "Väljastatud";
        }

        if($luba == -1 && $t2nav == 1) {
            $loalahter = "<a href='?vormistamine_id=$id'>Vormista load</a>";
        }

        echo "
        <tr> 
            <td>$eesnimi</td> 
            <td>$perekonnanimi</td> 
            <td>$teooriatulemus</td> 
            <td>$asendatud_slaalom</td> 
            <td>$asendatud_ringtee</td> 
            <td>$asendatud_t2nav</td> 
            <td>$loalahter</td> 
            <td>$kustuta</td>
        </tr>";
    }
    ?>
</table>
</body>
</html>
