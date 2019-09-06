<?php
include_once 'Classe.php';
$usu1 = new Classe();

echo $nombregrupo = $_POST['nombregrupo'];




if(isset($_POST['id'])){
    $id = $_POST['id'];
}else{
	$id= null;
}
   

$usu1->set_gru($id, $nombregrupo);
$sql =$usu1->add_gru();
header("Location:../views/tabla_g.php");

    
