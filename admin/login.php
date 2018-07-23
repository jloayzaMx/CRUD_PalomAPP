<?php 
require_once('./header.php');
require_once('../db_connect.php');
require_once('./tabla.php');


print '<h3 align="center">login</h3>';
?>

<div class="container">
    <div class="row" >
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3></h3>
            <br>



            

            <br>
            <form method="post" action="" align="center">
            <input type="text" name="usuario" value="" autocomplete="off" class="box"/><br /><br />
            <input type="password" name="contrasena" value="" autocomplete="off" class="box" /><br/><br />
            <input name="enviar" class="btn btn-danger" type="submit" value="loguear">&nbsp;&nbsp;&nbsp;
            <input name="enviar" class="btn btn-warning" type="button" onclick="location='../index.php'" value="Back">

<?php

if(isset($_POST['enviar'])){
    $usu = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    $sql = "select * FROM  administrador WHERE usuario = :usuario and contrasena = :contrasena";
    $sth = $pdo->prepare($sql);
    //echo $sql;
    $sth->bindValue(":usuario", $usu, PDO::PARAM_STR);
    $sth->bindValue(":contrasena", $contrasena, PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetchAll();
    
    //print_r($result);
    //die();
    if($result){
        $_SESSION['user_id'] = 'mx';
        $profile = $result[0]['usuario'];  
        switch ($profile){
        case 'mx':
            print "<script>location='../admi.php';</script>";
            break;
        default :
            print "<script>location='../usuario.php';</script>";
        }
        
        
    }else{
        print "<center>Error al ingresar!!</center><br><br>";
    }
}
?>

            </form>
        </div>
    <div>
</div>
                    <?php
require_once('./footer.php');
?>