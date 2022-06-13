<?php 

    //Conectar a Mysql
    //variable contenedora = funcion("servidor", "usuario", "base_de_datos")
    $con = mysqli_connect("localhost", "root", "", "crud");

    //Probar conexión
   /*  if(mysqli_connect_errno()){
        //errno define el tipo de error
        echo "Fallo al conectarse a Mysql: "  .mysqli_connect_error();
    }else{
        echo "Conectado correctamente";
    }   */