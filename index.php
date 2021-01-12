<?php
//codigos de respuesta
/*
1xx - informativo
2xx - Exito
3xx - Redireccion
4xx - Error del Cliente
5xx - Error del Servidor
*/
/*
Los que vamos a utilizar en este programa seran 

500 : Internal Server Error → Se ha producido un error interno
422 : Unprocessable Entity → Entidad no procesable
400 : Bad Request → La solicitud contiene sintaxis errónea y no debería repetirse
204 : No Content → La petición se ha completado con éxito pero su respuesta no tiene ningún contenido
*/
include_once 'Modelo/CRUD_Framework.php';
//include_once 'Modelo/Conexion.php'; 



// lineas para el CORS
//CORS son las siglas de "Cross-origin resource sharing" y es básicamente una restricción
// de acceso a recursos que están localizados en otros dominios
//por las restricciones de CORS, por motivos relacionados con la seguridad,
//NO se puede acceder a recursos (APIs) desde Javascript que se encuentren en otros dominios.

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Content-type: application/json; charset=utf-8");

//Un ejemplo de solicitud de origen cruzado: el código JavaScript frontend 
//de una aplicación web que es localizada en http://domain-a.com utiliza XMLHttpRequest
// para cargar el recurso http://api.domain-b.com/data.json.

//Por razones de seguridad, los exploradores restringen las solicitudes HTTP 
//de origen cruzado iniciadas dentro de un script. 
//Por ejemplo, XMLHttpRequest y la API Fetch siguen la política de mismo-origen. 
//Ésto significa que una aplicación que utilice esas APIs XMLHttpRequest 
//sólo puede hacer solicitudes HTTP a su propio dominio, 
//a menos que se utilicen cabeceras CORS.


//Como puedes apreciar, son varias cabeceras las que tenemos que configurar. 
//Algunas veces no te harán falta todas, pero no está de más colocarlas así, si es que quieres desactivar las restricciones CORS.


$api = $_SERVER['REQUEST_METHOD'];
//echo json_encode($api);
if($api=='GET'){
    if(isset($_GET['id'])){
        //si no he pasado id como parametro
        $resultado=metodoGetId(htmlspecialchars($_GET['id']));
        if ($resultado==false){//no se ha encontrado registro de ese id
            echo Mensaje('No se ha encontrado ningun registro con ese id!',true);
            //header("HTTP/1.1 204 No se ha encontrado ningun registro con ese id");
        }else{
             echo json_encode($resultado);
            //http_response_code(200); es lo mismo que la siguiente linea
            //header("HTTP/1.1 200 OK");
            }
    }else{
        
        $resultado=metodoGetAll();
        echo json_encode($resultado); 
        //http_response_code(200);
        //header("HTTP/1.1 200 OK");        
    }
    exit();
}

if($api=='POST'){
       
        //echo json_encode("insercion realizada");
        $framework= new Framework();    
        $framework->setNombre(htmlspecialchars(strip_tags($_POST['nombre'])));
		$framework->setLanzamiento(htmlspecialchars(strip_tags($_POST['lanzamiento'])));
		$framework->setDesarrollador(htmlspecialchars(strip_tags($_POST['desarrollador'])));
		//llama a la función  definida en el crud
        $resultado=metodoPost($framework);
        $framework=null;
        //echo json_encode($resultado);
        header("HTTP/1.1 200 OK");
        exit();
}

if($api=='PUT'){
         
        if (isset($_GET['id']))
        {   
            
            //cuando trabaje desde REACT
            //$JSONData=file_get_contents('php://input');
            //recogo un objeto y por tanto lo convierto en un array para trabajar mejor con
            $registro = (array)json_decode(file_get_contents("php://input"));
           
                        
            //la función json_decode() 
            //Esta función, según la documentación oficial de PHP, lo que hace es “Convierte un string codificado en JSON a una variable de PHP”. 
            //Básicamente convierte un JSON en un objeto Array.
            //$datos=json_decode($JSONData,true);
            
            $framework= new Framework();
            $id=htmlspecialchars($_GET['id']);
            $framework->setId($id);
            if (isset($registro['nombre']))
                $framework->setNombre(htmlspecialchars($registro['nombre']));
                //echo json_encode($datos['nombre']);
            if (isset($registro['lanzamiento']))
                $framework->setLanzamiento(htmlspecialchars($registro['lanzamiento']));
                //echo json_encode($datos['lanzamiento']);
            if (isset($registro['desarrollador']))
                $framework->setDesarrollador(htmlspecialchars($registro['desarrollador']));
                //echo json_encode($datos['desarrollador']);
           
              
            //llama a la función  definida en el crud en este caso la funcion put
           
            $resultado=metodoPut($framework);
            if ($resultado) {
                echo Mensaje('Registro Modificado  successfully!',false);
            } else {
                echo Mensaje('Failed to update an framework!',true);
            }
        } else {
         echo Mensaje('Usuario not found!',true);
        }
        
        //header("HTTP/1.1 200 OK");
        exit();

}//put

if($api=='DELETE'){
    //echo Mensaje("Estoy en delete!",false);
    if (isset($_GET['id']))
    {
        
        $id=htmlspecialchars($_GET['id']);
        
        $resultado=metodoDelete($id);
        echo json_encode($resultado);
        
        if ($resultado>0){
           //message es un metodo para codificar en json el error
                echo Mensaje("Registro Borrado Satisfactoriamente!",false);
               //header("HTTP/1.1 200 OK");
        }
            else{
                echo Mensaje('No se ha encontrado ese id registro para  borrarle',true);
                //header("HTTP/1.1 204 No se ha encontrado ese id registro para  borrarle");
            }
        
       
        exit();
    }
    
}

//header("HTTP/1.1 400 Bad Request");


