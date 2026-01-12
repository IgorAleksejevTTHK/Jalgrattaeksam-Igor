<?php
$serverinimi='localhost';
$kasutajanimi='igor';
$parool='1234';
$andmebaasinimi='igor';
$yhendus=new mysqli($serverinimi,$kasutajanimi,$parool,$andmebaasinimi);
$yhendus->set_charset('utf8');
