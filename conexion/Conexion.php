<?php
class Conexion 
{
private static $instancia;//variable de instancia
private $con;//variable de conexion
    
private function __construct()
{
    try
    {
    
    $this->con = new PDO("sqlsrv:Server=;Database=",'','');
        
    $this->con->exec("SET CHARSET SET UTF-8");    
    }
    catch(PDOEception $e)
    {
        echo "Error:" . $e->getMessage();
        die();
    
  }
}
 public static function singleton_conexion()
    {
     if(!isset(self::$instancia))
     {
    $miclase = __CLASS__;
    self::$instancia = new $miclase;
    }
    return self::$instancia;
    }
public function __clone()
{
trigger_error('la clonacion no esta permitida', E_USER_ERROR);
}
public function prepare($sql)
{
return $this->con->prepare($sql);
}
}
?>
