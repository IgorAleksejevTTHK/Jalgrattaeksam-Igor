<?php
global $yhendus;
require_once("konf.php");

function registreerimine($eesnimi, $perekonnanimi)
{
global $yhendus;

if (empty($eesnimi) || empty($perekonnanimi) || is_numeric($eesnimi) || is_numeric($perekonnanimi)) {

    return false;
}


$kask = $yhendus->prepare(
    "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)"
);


$kask->bind_param("ss", $eesnimi, $perekonnanimi);

if ($kask->execute()) {
    return true;
} else {
    return false;
}
function teooriatulemus($id,$teooriatulemus)
{
    global $yhendus;
    $kask = $yhendus->prepare(
        "UPDATE jalgrattaeksam SET teooriatulemus = ? WHERE id = ?"
    );
    $kask->bind_param("ii", $teooriatulemus, $id);
    $kask->execute();
}}
function kuvatabel()
{
    global $yhendus;
$kask=$yhendus->prepare(
    "SELECT id, eesnimi, perekonnanimi, teooriatulemus FROM jalgrattaeksam WHERE teooriatulemus<10"
);
$kask->bind_result($id, $eesnimi, $perekonnanimi, $teooriatulemus);
$kask->execute();
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
}

function slaalomtabel()
{
    global $yhendus;
    $kask=$yhendus->prepare("SELECT id, eesnimi, perekonnanimi   FROM jalgrattaeksam WHERE teooriatulemus>=9 AND slaalom=-1");  $kask->bind_result($id, $eesnimi, $perekonnanimi);
    $kask->bind_result($id, $eesnimi, $perekonnanimi);
    $kask->execute();

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


}
function slaalomKorras($id){
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=1 WHERE id=?");
    $kask->bind_param("i", $id);
    $kask->execute();
}


function slaalomVigane($id)
{
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE jalgrattaeksam SET slaalom=2 WHERE id=?");
    $kask->bind_param("i", $id);
    $kask->execute();
}


?>

