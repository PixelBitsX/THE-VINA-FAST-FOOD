<?php

    /*En autoload se usa para crear dinámicamente la ruta de destino pero
    sólo de las clases que serán usadas, evitando así que tengamos que colocar
    tantos include o require dentro de cada uno de los archivos, y además
    proporcionando una experiencia más optima en la carga de nuestro sistema*/

    spl_autoload_register(function($clase){
        
        $archivo= __DIR__."/". $clase .".php"; /*Con esto obtenemos el directorio donde se está ejecutando el archivo */
        $archivo= str_replace("\\", "/", $archivo); /*Con esto cambiamos \ por / para que sea compatible con Linux */

        /*Con esta condicional simple preguntamos si el archivo existe se ejecuta, sino simplemente no se ejecuta */
        if(is_file($archivo)){
            require_once $archivo;
        }

    });
