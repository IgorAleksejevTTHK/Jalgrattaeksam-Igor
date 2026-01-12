<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["korras_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET ringtee=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["korras_id"]);
    $kask->execute();
}
if(!empty($_REQUEST["vigane_id"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET ringtee=2 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vigane_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi   FROM jalgrattaeksam WHERE teooriatulemus>=9 AND ringtee=-1");  $kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
?>
    <!doctype html>
    <html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Ringtee</title>
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
    <h1>Ringtee</h1>
    <table>
        <tr>
            <th>Eesnimi</th>
            <th>Perekonnanimi</th>
            <th>Õnnestus</th>
        </tr>
        <?php
        while($kask->fetch()){
            echo "
 <tr> 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td> 
 <a href='?korras_id=$id'>Korras</a> 
 <a href='?vigane_id=$id'>Ebaõnnestunud</a> 
 </td> 
</tr> 
 ";
        }
        ?>
    </table>
    </body>
    </html> <?php
