<?php
//obtiene todas las metas de las bases de datos

require 'Metas.php';

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    //manejar peticion GET
    $metas = Metas::getAll();
    
    if($metas){
        //$datos['estado']=1;//1=caso de exito
        //$datos['metas'] = $metas;//guardamos las metas en arry para luego pasarlo a json
        //print json_encode($datos);
        print json_encode($metas);
    }else{
        print json_encode(array(
            'estado'=>2,
            'mensaje'=>'Ha ocurrido un error'
        ));
    }
}
?>