<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["teooriatulemus"])){
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET teooriatulemus=? WHERE id=?");
    $kask->bind_param("ii", $_REQUEST["teooriatulemus"], $_REQUEST["id"]); $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi   FROM jalgrattaeksam WHERE teooriatulemus=-1");
$kask->bind_result($id, $eesnimi, $perekonnanimi);
$kask->execute();
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
    while($kask->fetch()){
        echo " 
 <td>$eesnimi</td> 
 <td>$perekonnanimi</td> 
 <td><form action=''> 
 <input type='hidden' name='id' value='$id' /> 
 <input type='text' name='teooriatulemus' />
 <input type='submit' value='Sisesta tulemus' /> 
 </form> 
 </td> 
</tr> 
 ";
    }
    ?>
</table>
</body>
</html>