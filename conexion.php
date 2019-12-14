<?php

$conexion = mysqli_connect("localhost", "root", "", "4");


// if (!$conexion){
//     echo 'Error al conectar a la base de datos<br>';
// }else{
//     echo 'Conexión exitosa a la base de datos<br>';
// }
if (isset($_REQUEST['peticion'])) {
    $peticion = $_REQUEST['peticion'];
    $numero = 0;
    if ($peticion == "categoria") {
        $arreglo = array();
        $resultado = mysqli_query($conexion, "SELECT id_categoria , nombre_categoria FROM categoria");

        while ($rows = mysqli_fetch_array($resultado)) {
            $numero++;
            $value = array(
                "id" => $numero,
                "categoria" => $rows[1]
            );

            array_push($arreglo, $value);
        }
        echo json_encode($arreglo);
    } else if ($peticion == "proveedor") {
        $arreglo = array();
        $resultado = mysqli_query($conexion, "SELECT id_proveedor , nombre_proveedor FROM proveedor");
        while ($rows = mysqli_fetch_array($resultado)) {
            $numero++;
            $value = array(
                "id" => $numero,
                "proveedor" => $rows[1]
            );

            array_push($arreglo, $value);
        }
        echo json_encode($arreglo);
    } else if ($peticion == "producto") {
        if (isset($_REQUEST['categoria'])) {
            $where = ' WHERE id_categoria = "' . $_REQUEST['categoria'] . '"';
        } else {
            $where = "";
        }
        $arreglo = array();
        $resultado = mysqli_query($conexion, "SELECT id_producto , nombre_producto ,precio_producto,id_categoria FROM producto" . $where);


        while ($rows = mysqli_fetch_array($resultado)) {
            $numero++;
            $value = array(
                "id" => $numero,
                "producto" => $rows[1]
            );

            array_push($arreglo, $value);
        }
        echo json_encode($arreglo);
    } else if ($peticion == "update_stock_producto") {
        if (isset($_REQUEST['nombre_producto'])) {
            if ($_REQUEST['nombre_producto'] != null) {
                $where = ' WHERE nombre_producto = "' . $_REQUEST['nombre_producto'] . '"';

                $resultado = mysqli_query($conexion, "update producto set stock_producto = stock_producto + " . $_REQUEST['stock'] . $where);
                echo $resultado;
                echo "Operacion realizada";
            } else {
                echo "Nombre producto nulo";
            }
        }
    } else if ($peticion == "categoria") {

        $resultado = mysqli_query($conexion, "SELECT id_categoria , nombre_categoria  FROM categoria");
        $arreglo = array();
        while ($rows = mysqli_fetch_array($resultado)) {
            $numero++;
            $value = array(
                "id" => $numero,
                "categoria" => $rows[1]
            );

            array_push($arreglo, $value);
        }
        echo json_encode($arreglo);
    } else if ($peticion == "producto_") {

        $resultado = mysqli_query($conexion, "SELECT id_producto, nombre_producto, stock_producto, precio_producto FROM producto");
        $arreglo = array();
        while ($rows = mysqli_fetch_array($resultado)) {
            $numero++;
            $value = array(
                "id" => $rows[0],
                "nombre" => $rows[1],
                "stock" => $rows[2],
                "precio" => $rows[3]
            );

            array_push($arreglo, $value);
        }
        echo json_encode($arreglo);
    } else if ($peticion == "update_producto") {

        if (isset($_REQUEST['nombre_producto'])) {
            if ($_REQUEST['nombre_producto'] != null) {
                $where = ' WHERE id_producto ='. $_REQUEST['id_producto'] ;
                $resultado = mysqli_query($conexion, "update producto set nombre_producto ='" . $_REQUEST['nombre_producto'] ."'". $where);
               
            }

            if (isset($_REQUEST['precio_producto'])) {
                if ($_REQUEST['precio_producto'] != null) {
                    $where = ' WHERE id_producto = ' . $_REQUEST['id_producto'] ;
                    $resultado = mysqli_query($conexion, "update producto set precio_producto =". $_REQUEST['precio_producto'].$where);
            
                    
                }
                echo "Operacion realizada ";
        }
        //     http://192.168.0.9/server/conexion.php?peticion=update_stock_producto&nombre_producto=fanta&stock=2";
    }
}

    else if ($peticion == "agregar_producto") {

        $resultado = mysqli_query($conexion, "insert into producto (nombre_producto,precio_producto,stock_producto,id_categoria ) values ('".$_REQUEST['nombre']."',".$_REQUEST['precio'].",".$_REQUEST['stock'].",".$_REQUEST['categoria'].");");
        //echo $conexion, "insert into producto (nombre_producto,precio_producto,stock_producto,id_categoria ) values ('".$_REQUEST['nombre']."',".$_REQUEST['precio'].",".$_REQUEST['stock'].",".$_REQUEST['categoria'].");";
        echo "Producto registrado";
    }

}
