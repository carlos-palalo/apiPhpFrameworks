<?php
//include, require, include_once y require_once
//en general las 4 funciones hacen lo mismo, importar en un documento php, funciones o variables de otros documentos escritos en php
//include: mostrara un warning y continuara con la ejecucion
//require: mostrara un fatal error y parara la ejecucion
//La función require_once, include_once: se comporta de manera similar a require,include, con la única diferencia
// que si el código ha sido ya incluido, no se volverá a incluir.
require_once 'webconfig.php';  
  
class Conexion  
{  
  private static $dns       = DNS;  
  private static $username  = USERNAME;  
  private static $password  = PASSWORD;  
  private static $instance;  
      
  private function __construct() { }  
      
  /** 
   * Crea una instancia de la clase PDO 
   *  
   * @access public static 
   * @return object de la clase PDO 
   */  
  public static function getInstance()  
  {  
    if (!isset(self::$instance))  
    {  
    // self se utiliza para referenciar métodos staticos o atributos estaticos
    //this no puede referenciar a metodos estaticos
    //para acceder a metodos staticos fuera de la clase ::
      self::$instance = new PDO(self::$dns, self::$username, self::$password);  
      //PDO::FETCH_ASSOC: devuelve un array indexado por el nombre de campo de la tabla.
      //PDO::FETCH_BOTH: (por defecto): devuelve un array indexado por nombre de campo de la tabla y por número de campo.
      self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      //echo "Conexion creada correctamente"; 
    }  
    return self::$instance;  
  }  
      
      
 /** 
  * Impide que la clase sea clonada 
  *  
  * @access public 
  * @return string trigger_error 
  */  
  public function __clone()  
  {  
    trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);  
  } 
} 



		