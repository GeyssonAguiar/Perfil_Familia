<?php 
require_once 'classes/Familia.php';

$id = Familia::get_proximo_id('familias');
echo $id;