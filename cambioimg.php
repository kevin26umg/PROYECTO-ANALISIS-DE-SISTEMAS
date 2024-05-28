<?php
error_reporting(0);
$nombre = $_FILES['archivo']['name'];	
$directorio ='imagenes/'; 
move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
echo ($nombre);
    ?>