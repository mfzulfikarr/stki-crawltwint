<?php
    $servername='localhost';
    $username="root";
    $password="";
    
    try{
        $connect=new PDO("mysql:host=$servername;dbname=dbtwint",$username,$password);
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo 'connected';
    }
    catch(PDOException $log){
        echo '<br>'.$log->getMessage();
    } 
?>