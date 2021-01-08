<?php
include_once'Conexion.php';
include_once'Framework.php';

function metodoGetId($id){
    try{
        $conexion = Conexion::getInstance();
        $sql="select * from frameworks where id=?";
        $sentencia=$conexion->prepare($sql);
        $sentencia->execute(array($id));
        //PDO::FETCH_ASSOC: devuelve un array indexado por el nombre de campo de la tabla.
      //PDO::FETCH_BOTH: (por defecto): devuelve un array indexado por nombre de campo de la tabla y por número de campo.
        $filas=$sentencia->fetch(PDO::FETCH_ASSOC);
        //desconectar();
        $conexion=null;
        return $filas;
    }catch(PDOException $e){
        echo Mensaje('Error en la consulta: ' . $e->getMessage(),true);
    }
}
function metodoGetAll(){
    try{
        $conexion = Conexion::getInstance();
        $sql="select * from Frameworks";
        $sentencia=$conexion->prepare($sql);
        $sentencia->execute();
        $filas=$sentencia->fetchAll();
        //desconectar();
        
        $conexion=null;
        return $filas;
        //return $listaFramework;
    }catch(PDOException $e){
        echo Mensaje('Error en la consulta: ' . $e->getMessage(),true);
    }
}

function metodoPost($framework){
    try{
        $conexion = Conexion::getInstance();
        $sql="INSERT INTO frameworks(nombre,lanzamiento,desarrollador) values(?,?,?)";
        $sentencia=$conexion->prepare($sql);
        # Este método devuelve true o false.
        $sentencia->execute(array($framework->getNombre(),$framework->getLanzamiento(),$framework->getDesarrollador()));
        // Como resultado de la ejecución tendríamos en $sentencia
        // un valor true o false indicado si la instrucción se ha ejecutado correctamente.
        
        //closeCursor()   libera la conexión al servidor, por lo que otras sentencias SQL podrían ejecutarse, 
        //pero deja la sentencia en un estado que la habilita para ser ejecutada otra vez.
        //pero no es necesario al cerrar la conexion
        //$sentencia->closeCursor();
        //desconectar();
        $conexion=null;
        return $sentencia;
    }catch(PDOException $e){
        echo Mensaje('Error en la insercion: ' . $e->getMessage(),true);
    }
}


function metodoPut($framework){
    try{
        $conexion = Conexion::getInstance();
        print_r((array)$framework);
        $sql="UPDATE frameworks SET nombre=?, lanzamiento=?, desarrollador=? WHERE id=?";
        $sentencia=$conexion->prepare($sql);
        # Este método devuelve true o false.
        $sentencia->execute(array($framework->getNombre(),$framework->getLanzamiento(),
                                  $framework->getDesarrollador(),$framework->getId()));
        // Como resultado de la ejecución tendríamos en $sentencia

        //desconectar();
        $conexion=null;
        return true;
    }catch(PDOException $e){
        echo Mensaje('Error en la modificacion: ' . $e->getMessage(),true);
    }
}

function metodoDelete($id){
    try{
        $conexion = Conexion::getInstance();
        $sql="DELETE FROM frameworks WHERE id=?";
        $sentencia=$conexion->prepare($sql);
        $sentencia->execute(array($id));
        //devuelve el número de filas que fueron eliminadas
        $filas_eliminadas = $sentencia->rowCount();
        $conexion=null;
        return $filas_eliminadas;
    }catch(PDOException $e){
        echo Mensaje('Error en el borrado: ' . $e->getMessage(),true);
    }
}

 

// JSON Format Converter Function
 function Mensaje($content, $status) {
    return json_encode(['message' => $content, 'error' => $status]);
  }
